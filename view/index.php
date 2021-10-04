<?php
/** @var string $__PRODUCTS_PROMO */
/** @var string $__PRODUCTS_NORMAL */

ob_start();
?>

<main>

    <section class="py-3 container" id="welcome">
        <div class="row py-lg-5 py-sm-5">

            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-3">
                    <h1 class="fw-light">Köszöntjük áruházunkban!</h1>
                    <p class="col-md-12 fs-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper id
                        mauris cursus sagittis. Vivamus ac metus eleifend, elementum ante id, maximus ipsum. Duis placerat
                        ac velit pulvinar sollicitudin. Praesent et velit ut lacus pretium tempor commodo maximus sem. Fusce
                        ac urna ligula. Morbi mattis lorem ipsum, at aliquet sapien aliquam eu. Sed tempor ligula non turpis
                        scelerisque ultricies. Sed rhoncus accumsan mi, ac venenatis mi venenatis eget. Nam ut varius mi, et
                        accumsan urna.
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="album py-5 bg-gradient bg-dark">
            <div class="container">
                <h1 class="fw-light text-light text-center">Akciós termékeink</h1>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                    <?php print($__PRODUCTS_PROMO); ?>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">
                <h1 class="fw-light">További termékeink</h1>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php print($__PRODUCTS_NORMAL); ?>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
$__CONTENT = ob_get_clean();
?>