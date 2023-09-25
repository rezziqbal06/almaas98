<style>
    .bg-form {
        background-color: var(--white);
        border-radius: 32px;
        margin-bottom: 32px;
    }

    @media screen and (max-width: 765px) {
        .bg-form {
            background-color: var(--white);
            border-top-left-radius: 32px;
            border-top-right-radius: 32px;
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 0px;
            margin-bottom: 0px;
        }
    }
</style>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 text-center">
        <img src="<?= base_url("media/logo.png") ?>" alt="<?= $this->config->semevar->site_name ?>" class="img-fluid text-center mt-4 mb-5 p-5">
        <form id="form-login" class="p-4 bg-form">
            <h3 class="text-primary mb-3">Login</h3>

            <div class="mb-3">
                <input id="iusername" type="text" class="form-control" autofocus="true" placeholder="NIK/No HP/Email" aria-label="Username">
            </div>
            <div class="mb-3">
                <input id="ipassword" type="password" class="form-control" placeholder="password" aria-label="Password">
            </div>

            <a href="<?= base_url("forgot_password") ?>"><small>Lupa password</small></a>
            <div class="text-center mb-5">
                <button type="submit" class="btn btn-lg btn-lg bg-secondary w-100 mt-4 mb-0 btn-submit"><i class="icon-submit fa fa-login"></i> Masuk</button>
            </div>
            <a href="<?= base_url("register") ?>"><small>Belum punya akun? daftar</small></a>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>