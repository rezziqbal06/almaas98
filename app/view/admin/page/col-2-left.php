<!DOCTYPE html>
<html class="no-js" lang="en">
<?php $this->getThemeElement("page/html/head", $__forward); ?>

<body class="g-sidenav-show bg-background  bg-gray-100">
	<div class="min-height-300 bg-primary position-absolute w-100"></div>

	<?php if ($this->admin_login) $this->getThemeElement("page/html/sidebar", $__forward); ?>
	<main class="main-content position-relative border-radius-lg ">
		<?php $this->getThemeElement("page/html/header", $__forward); ?>
		<div class="container-fluid py-4">
			<?php $this->getThemeContent(); ?>
			<!-- Main Container End -->

			<!-- Footer -->
			<?php $this->getThemeElement("page/html/footer", $__forward); ?>
			<!-- End Footer -->
		</div>
	</main>


	<!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
	<?php $this->getJsFooter(); ?>


	<!-- Load and execute javascript code used only in this page -->
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
						$.post("<?= base_url("api_admin/akun/pegawai/update_token") ?>", {
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
	<script>
		var from_user_id = '';
		var from_user_nama = '';
		var to_user_id = '';
		var to_user_nama = '';
		var chat_active = 1;
		var last_pesan_id = 0;
		var iterator = 1;
		var base_url = '<?= base_url_admin() ?>';
		$(document).ready(function(e) {
			<?php $this->getJsReady(); ?>
			<?php $this->getThemeElement('page/html/script', $__forward); ?>
			<?php $this->getJsContent(); ?>
		});
	</script>
</body>

</html>