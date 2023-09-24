<!DOCTYPE html>
<html class="no-js" lang="en">
<?php $this->getThemeElement("page/html/head", $__forward); ?>

<body style="overflow-x: hidden;" class="bg-background">
	<!-- Page Wrapper -->
	<div id="page-wrapper" class="page-loading">
		<!-- Preloader -->
		<!-- <div class="preloader themed-background">
				<h1 class="push-top-bottom text-light text-center" >
                    <strong>rezza</strong>
                    <br><small>Loading...</small>
                </h1>
				<div class="inner">
					<h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
					<div class="preloader-spinner hidden-lt-ie10"></div>
				</div>
			</div> -->
		<!-- END Preloader -->

		<div id="page-container" class="header-fixed-top footer-fixed">
			<!-- Main Container -->
			<div id="main-container">
				<!-- Header -->
				<!-- END Header -->

				<div class="pt-md-5">
					<?php $this->getThemeContent(); ?>
				</div>
				<!-- Main Container End -->

				<!-- Footer -->
				<?php $this->getThemeElement("page/html/footer", $__forward); ?>
				<!-- End Footer -->
			</div>
			<!-- End Main Container -->

		</div>
		<!-- End Page Container -->

	</div>
	<!-- End Page Wrapper -->

	<!-- Foot -->
	<?php // $this->getThemeElement("page/html/foot",$__forward); 
	?>
	<!-- End Foot -->


	<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
	<?php $this->getJsFooter(); ?>

	<script type="module">
		// Import the functions you need from the SDKs you need
		import {
			initializeApp
		} from "https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js";
		import {
			getMessaging,
			getToken,
			onMessage
		} from "https://www.gstatic.com/firebasejs/10.4.0/firebase-messaging.js";
		import {
			getAnalytics
		} from "https://www.gstatic.com/firebasejs/10.4.0/firebase-analytics.js";
		// TODO: Add SDKs for Firebase products that you want to use
		// https://firebase.google.com/docs/web/setup#available-libraries

		// Your web app's Firebase configuration
		// For Firebase JS SDK v7.20.0 and later, measurementId is optional
		const firebaseConfig = JSON.parse('<?= json_encode($this->config->semevar->fcm) ?>');



		// Initialize Firebase
		const app = initializeApp(firebaseConfig);
		const analytics = getAnalytics(app);

		// Initialize Firebase Cloud Messaging and get a reference to the service
		const messaging = getMessaging(app);

		function displayNotification(payload) {
			console.log("Message received,", payload)
			if ('Notification' in window && Notification.permission === 'granted') {
				var body = payload.data.body;
				var image = payload.data.image;
				var title = payload.data.title;
				var link = payload.data.link;

				const notificationOptions = {
					body: body || 'Pesan dari <?= $this->config->semevar->site_name ?>',
					icon: '<?= base_url("media/notif_logo.png") ?>',
					image: image
				};

				const notification = new Notification(title, notificationOptions);

				notification.onclick = function() {
					// Handle the notification click event here, e.g., open a specific page.
					window.open(link);
					notification.close();
				};
			}
		}


		<?php if (isset($is_from_login) && $is_from_login) : ?>
			console.log('first login - permission notification');
			const permission = await Notification.requestPermission();
			if (permission === 'granted') {
				getToken(messaging, {
					vapidKey: 'BAFLt2QBitg-j1o8_ltnSNhU_9wdPdXRqlYkMREoVEU2Iuj1qBDO5zz2nbLfWyeqJKQIkFss-tJfJR7RaLb7Yts'
				}).then((currentToken) => {
					if (currentToken) {
						// Send the token to your server and update the UI if necessary
						// ...
						$.post("<?= base_url("api_front/user/update_token") ?>", {
							token: currentToken
						}).done(function(dt) {
							// console.log(dt.status, dt.message);
						})
					} else {
						// Show permission request UI
						console.log('No registration token available. Request permission to generate one.');
						// ...
					}
				}).catch((err) => {
					console.log('An error occurred while retrieving token. ', err);
					// ...
				});
			}
		<?php endif ?>

		onMessage(messaging, (payload) => {
			console.log('Message received. ', payload);
			displayNotification(payload);
			// ...
		});
	</script>

	<!-- Load and execute javascript code used only in this page -->
	<script>
		$(document).ready(function(e) {
			<?php $this->getJsReady(); ?>
			<?php //$this->getThemeElement('page/html/script',$__forward); 
			?>
		});
		<?php $this->getJsContent(); ?>
	</script>
</body>

</html>