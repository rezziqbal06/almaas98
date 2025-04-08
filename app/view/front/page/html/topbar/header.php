<style>
    #nav-menu {
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        z-index: 999;
        background-color: rgba(255, 255, 255, 0.5);
        /* box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1) !important; */
        border: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }


    #nav-menu.header-scrolled {
        background-color: rgba(255, 255, 255, 1);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
<header id="nav-menu" class=" <?= isset($this->current_page) && $this->current_page == "explore" ? 'd-none' : '' ?>" aria-label="navigation bar">
    <div class="container">
        <div class="nav-center">
            <a class="logo" href="<?= base_url() ?>">
                <img src="<?= base_url() . $this->config->semevar->site_logo->path ?>" width="50" height="" alt="<?= $this->config->semevar->site_name ?>" />
            </a>

        </div>

        <div class="nav-end">
            <nav class="menu">
                <ul class="menu-bar">
                    <li><a class="nav-link" href="<?= base_url() ?>explore">Cari</a></li>
                    <li><a class="nav-link" href="<?= base_url() ?>blog">Blog</a></li>
                </ul>
            </nav>

            <button id="hamburger" aria-label="hamburger" class="d-none" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>