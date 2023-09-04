<style>
  .fab {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: var(--dark-secondary-qc);
    color: white;
    font-size: 24px;
  }

  .d-flex {
    display: flex;
    justify-content: center;
  }
</style>

<div class="fixed-bottom p-2 bg-white">
  <div class="row bottom-nav">
    <div class="col-3 text-center">
      <a href="<?= base_url("") ?>"><img src="<?= base_url("media/home-menu.png") ?>" alt="home"></a>
    </div>
    <div class="col-3 text-center">
      <a href="<?= base_url("discover") ?>"><img src="<?= base_url("media/search-menu.png") ?>" alt="search"></a>
    </div>
    <div class="col-3 text-center">
      <a href="<?= base_url("leaderboard") ?>"><img src="<?= base_url("media/dashboard-menu.png") ?>" alt="dashboard"></a>
    </div>
    <div class="col-3 text-center">
      <a href="<?= base_url("account") ?>"><img src="<?= base_url("media/user-menu.png") ?>" alt="account"></a>
    </div>
  </div>
</div>