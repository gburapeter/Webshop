<?php
/** @var string BASEURL */
/** @var Product $product */
/** @var string $__PRODUCTS_RANDOM */

ob_start();
?>
    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">
                <h1 class="fw-light"><?php print($product->getName()); ?></h1>

                <div class="row g-5">

                    <div class="col-md-7 col-lg-8">
                        <img class="product-image" src="<?php print(BASEURL); ?>/resources/image/960x540/<?php print($product->getId()); ?>.png" alt="Termékfotó" width="100%">
                    </div>

                    <div class="col-md-5 col-lg-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="">Ár:</span>
                            <span class="text-primary"><?php print(number_format($product->getPrice(), 0, "", " "));?> Ft</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="">Készlet:</span>
                            <?php

                            if($product->getStock()) {
                                print('<span class="text-success">raktáron 15 db</span>');
                            } else {
                                print('<span class="text-warning">rendelésre</span>');
                            }

                            ?>
                        </h4>


                        <form class="p-2 row align-items-center">
                            <div class="col-md-6">
                                <div class="input-group mb-3 align-items-center">
                                    <input type="number" class="form-control" id="product-count" placeholder="db" value="1" min="1">
                                    <span class="input-group-text">db</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3  align-items-center">
                                    <button type="button" class="btn btn-primary btn-lg basket-add-count" data-product="<?php print($product->getId()); ?>">Kosárba teszem</button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <h5 class="text-muted">Kérdése van? Segítünk!</h5>
                        <p>Forduljon bizalommal ügyfélszolgálatunkhoz:</p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Telefonszámunk</div>
                                    +36 1 886 4700
                                </div>
                                <a class="btn btn-outline-secondary mt-1" href="tel:+3618864700" target="_blank"><i class="bi bi-telephone-fill"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Email címünk</div>
                                    info@example.com
                                </div>
                                <a class="btn btn-outline-secondary mt-1" href="mailto:info@example.com" target="_blank"><i class="bi bi-envelope-fill"></i></a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Üzletünk címe</div>
                                    1083 Budapest, Práter utca 50/A
                                </div>
                                <a class="btn btn-outline-secondary mt-1" href="https://goo.gl/maps/TRTpMjypbofQ78489" target="_blank"><i class="bi bi-pin-angle-fill"></i></a>
                            </li>
                        </ul>

                    </div>
                    <div class="col-12">
                        <h3 class="mt-md-2">Leírás</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce mollis sed risus ut dignissim. Cras ornare dolor tincidunt lacus placerat accumsan. Morbi vestibulum convallis nisl, in bibendum sem venenatis eget. Fusce volutpat vestibulum rutrum. Cras mollis, diam nec vestibulum mollis, diam magna hendrerit sapien, eu pharetra ipsum erat nec metus. Integer erat risus, facilisis eu tempus non, laoreet ac dui. Sed a tempus elit. Morbi venenatis elementum ante, sed cursus augue commodo eget. Duis sit amet nisi sit amet nisl sagittis auctor id vitae nibh. Nulla facilisi. Vivamus imperdiet velit id felis auctor, non faucibus tellus tempus. Phasellus tincidunt libero erat, eget congue mauris tempor et. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In finibus dignissim sapien, molestie convallis elit ullamcorper id.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section>
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">
                <h2 class="fw-light">További termékek</h2>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php print($__PRODUCTS_RANDOM); ?>
                </div>
            </div>
        </div>
    </section>

<?php
$__CONTENT = ob_get_clean();
?>