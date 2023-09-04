<header id="nav-menu" class="bg-primary <?= isset($this->current_page) && $this->current_page == "explore" ? 'd-none' : '' ?>" aria-label="navigation bar">
    <div class="container">
        <div class="nav-center">
            <a class="logo" href="<?= base_url() ?>">
                <img src="<?= base_url() . $this->config->semevar->site_logo->path ?>" width="35" height="35" alt="<?= $this->config->semevar->site_name ?>" />
            </a>
            <nav class="menu">
                <ul class="menu-bar">
                    <li><a class="nav-link" href="<?= base_url() ?>explore">Explore</a></li>
                    <li><a class="nav-link" href="<?= base_url() ?>blog">Blog</a></li>
                </ul>
            </nav>
        </div>

        <div class="nav-end">
            <!-- <div class="right-container">
                <form class="search" role="search">
                    <input type="search" name="search" placeholder="Search" />
                    <i class="bx bx-search" aria-hidden="true"></i>
                </form>
                <a href="#profile">
                    <img src="https://github.com/Evavic44/responsive-navbar-with-dropdown/blob/main/assets/images/user.jpg?raw=true" width="30" height="30" alt="user image" />
                </a>
                <button class="btn btn-primary">Create</button>
            </div> -->

            <button id="hamburger" aria-label="hamburger" class="d-none" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>