<?php
/** @var string $__ALL_PRODUCTS */

ob_start();
?>

    <main>

        <section id="product">
            <div class="album py-5 bg-gradient">
                <div class="container">
                    <h1 class="fw-light text-center">Termékeinkkk</h1>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">
                        <?php print($__ALL_PRODUCTS); ?>
                    </div>
                </div>
            </div>
        </section>

    </main>

<?php
$__CONTENT = ob_get_clean();
?>