<style>
    .pe-1 {
        padding-left: 1rem !important;
    }

    .fill-white {
        fill: #ffffff !important;
    }

    .tersedia.fill-white {
        fill: #ffffff !important;
    }

    .booking.fill-white {
        fill: #ffffff !important;
    }

    .terjual.fill-white {
        fill: #ffffff !important;
    }

    #siteplan {
        min-height: 450px;
        border-radius: 16px;
        margin-bottom: 2em;
        padding: 1em;
    }

    #siteplan svg {
        width: 100%;
        height: auto;
    }

    path:hover {
        fill: var(--background) !important;
        cursor: pointer;
    }

    .selected {
        fill: var(--dark-accent) !important;
    }

    .selected:hover {
        fill: var(--dark-accent) !important;
    }

    .tersedia {
        fill: var(--tersedia) !important;
    }


    .booking {
        fill: var(--booking) !important;
    }


    .terjual {
        fill: var(--terjual) !important;
    }
</style>
<div class="container-fluid pt-3">
    <!-- Static Layout Header -->
    <h4 class="text-start">Siteplan</h4>

    <!-- Content -->
    <?php if (isset($akm) && count($akm)) : ?>
        <div class="row gap-2">
            <?php foreach ($akm as $produk) : ?>
                <div class="col-md-4 card mb-3">
                    <a href="<?= base_url("siteplan/") ?><?= $produk->id ?>" class="" data-id="<?= $produk->id ?>" alt="<?= $produk->nama ?>">
                        <div class="p-3 row ">
                            <div class="col-4">
                                <img src="<?= base_url("") ?><?= $produk->gambar ?? '' ?>" alt="<?= $produk->nama ?? '' ?>" aria-describedby="<?= $produk->nama ?? '' ?>" class="img-fluid rounded">
                            </div>
                            <div class="col-8">
                                <p class="fs-5 mt-2 mb-1"><b><?= $produk->nama ?? '' ?></b></p>
                                <div class="me-3"><b class="text-primary"><?= $produk->deskripsi ?? '' ?></b></div>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endforeach ?>
        </div>
    <?php endif ?>

</div>