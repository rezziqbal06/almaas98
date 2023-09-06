<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->
<?php $this->getThemeElement("page/html/head", $__forward); ?>

<style>
    img {
        width: 50%;
    }

    @media screen and (max-width:765px) {
        img {
            width: 100%;
        }
    }
</style>

<body>
    <div class="container-fluid pt-5">
        <div class="row text-center" style="vertical-align: middle;height:100px;">
            <div class="col-12">
                <img src="<?= base_url("media/401.svg") ?>" class="img-fluid" alt="">
                <h2 class="h3">Harap menunggu, Sedang dalam pengembangan.<br> Kembali ke <a href="<?= base_url(); ?>"><b class="text-primary">halaman utama</b></a></h2>
            </div>
        </div>
    </div>
</body>

</html>