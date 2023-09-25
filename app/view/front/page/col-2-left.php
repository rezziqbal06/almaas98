<!DOCTYPE html>
<html class="no-js" lang="en">
<?php $this->getThemeElement("page/html/head", $__forward); ?>

<body class="bg-background">
	<!-- Page Wrapper -->
	<div id="page-wrapper" class="page-loading">
		<!-- Preloader -->
		<div class="preloader themed-background">
			<h1 class="push-top-bottom text-light text-center">
				<strong><?= $this->current_reseller->nama ?></strong>
				<br><small>Loading...</small>
			</h1>
			<div class="inner">
				<h3 class="text-light visible-lt-ie10"><strong>Loading..</strong></h3>
				<div class="preloader-spinner hidden-lt-ie10"></div>
			</div>
		</div>
		<!-- END Preloader -->

		<div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
			<!-- Alternative Sidebar -->
			<?php $this->getThemeElement("page/html/sidebar_alt", $__forward); ?>
			<!-- END Alternative Sidebar -->

			<!-- Main Sidebar -->
			<?php $this->getThemeElement("page/html/sidebar", $__forward); ?>
			<!-- END Main Sidebar -->

			<!-- Main Container -->
			<div id="main-container">
				<!-- Header -->
				<?php $this->getThemeElement("page/html/header", $__forward); ?>
				<!-- END Header -->

				<!-- Main Container -->

				<!-- Global Message -->
				<?php $this->getThemeElement("page/html/global_message", $__forward); ?>
				<!-- Global Message -->

				<?php $this->getThemeContent(); ?>
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
	<?php $this->getThemeElement("page/html/foot", $__forward); ?>
	<!-- End Foot -->

	<div id="modal-preloader" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog slideInDown animated">
			<div class="modal-content" style="background-color: #000;color: #fff;">
				<!-- Modal Header -->
				<div class="modal-header text-center" style="border: none;">
					<h2 class="modal-title"><i class="fa fa-spin fa-refresh"></i> Loading...</h2>
				</div>
				<!-- END Modal Header -->
			</div>
		</div>
	</div>

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
		var from_user_id = '';
		var from_user_nama = '';
		var to_user_id = '';
		var to_user_nama = '';
		var chat_active = 1;
		var last_pesan_id = 0;
		var iterator = 1;

		function gritter(pesan, judul = "info") {
			$.bootstrapGrowl(pesan, {
				type: judul,
				delay: 2500,
				allow_dismiss: true
			});
		}

		$(document).ready(function(e) {
			<?php $this->getJsReady(); ?>
			<?php //$this->getThemeElement('page/html/script',$__forward); 
			?>
			feather.replace();
		});
		<?php $this->getJsContent(); ?>
	</script>
</body>

</html>