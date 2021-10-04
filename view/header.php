<?php
/** @var string $__MENU */

ob_start();
?>
<header>
    <nav class="navbar navbar-expand-md  fixed-top navbar-dark bg-dark" aria-label="Webshop címsor">
        <div class="container">
            <a class="navbar-brand" href="<?php print(BASEURL); ?>">Webshop</a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar"
                    aria-controls="mainNavbar"
                    aria-expanded="false" aria-label="Navigációs menü">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <?php print($__MENU); ?>
            </div>
        </div>
    </nav>
</header>
<?php
$__HEADER = ob_get_clean();
?>