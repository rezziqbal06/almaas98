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