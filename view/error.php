<?php
/** @var string $__ERROR_CODE */
/** @var string $__ERROR_TITLE */
/** @var string $__ERROR_APOLOGY */

ob_start();
?>

<main>

    <section class="py-3 container" id="welcome">
        <div class="row py-lg-5 py-sm-5">

            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"><?php print($__ERROR_CODE); ?> &ndash; <?php print($__ERROR_TITLE); ?></h4>
                <p><?php print($__ERROR_APOLOGY); ?></p>
            </div>

        </div>
    </section>

</main>

<?php
$__CONTENT = ob_get_clean();
?>