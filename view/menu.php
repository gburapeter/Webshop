<?php
/** @var string BASEURL */
/** @var MenuItem[] $menu */

ob_start();
?>
<ul class="navbar-nav mb-2 mb-md-0 ">
    <?php
    foreach ($menu as $item) {
        $active_class = $item->isActive() ? "active" : "" ;

        print('
<li class="nav-item">
   <a class="nav-link '.$active_class.'" href="' . BASEURL .'/'. $item->getPath() . '">' . $item->getCaption() . '</a>
</li>');

    }

    ?>

</ul>
<?php
$__MENU = ob_get_clean();
?>