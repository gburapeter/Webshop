<?php
/** @var string $__INFO_TITLE */
/** @var string $__INFO_APOLOGY */

ob_start();
?>

<main>

    <section class="py-3 container" id="welcome">
        <div class="row py-lg-5 py-sm-5">

            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading"><?php print($__INFO_TITLE); ?></h4>
                <p><?php print($__INFO_APOLOGY); ?></p>
            </div>

        </div>
    </section>

</main>

<?php
$__CONTENT = ob_get_clean();
?>