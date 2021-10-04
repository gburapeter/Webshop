<?php
/** @var Order $order */
ob_start();
?>

<main>

    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">

                <div class="row g-5">
                    <div class="col-md-7 col-lg-8">
                        <h1 class="fw-light">Megrendelés tartalma</h1>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="col-8">Termék</th>
                                <th scope="col" class="text-end">Mennyiség</th>
                                <th scope="col" class="text-end">Ár</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            foreach($order->getBasketContents() as $id => $row) {
                                /** @var Product $prod */
                                $prod = $row["prod"];

                                /** @var integer $pcs */
                                $pcs  = $row["pcs"];

                                $price = $prod->getPrice() * $pcs;
                                $total += $price;

                                print('<tr>');
                                print('   <td class="col-8"><a href="' . BASEURL.'/products/'. $prod->getId() . '">'.$prod->getName().'</a></td>');
                                print('   <td class="text-end">'.$pcs.' db</td>');
                                print('   <td class="text-end">'. number_format($price,0,'', " ") .' Ft</td>');
                                print('</tr>');
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="table-col-product" scope="col">Összesen</th>
                                <th class="text-end" scope="col" colspan="2"><?php print(number_format($total,0,'', " ")); ?> Ft</th>
                            </tr>
                            </tfoot>
                        </table>


                    </div>

                    <div class="col-md-5 col-lg-4">
                        <h1 class="fw-light">Részletek</h1>

                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="">Azonosító:</span>
                            <span class="text-primary"><?php print($order->getOrderId());?></span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="">Leadva:</span>
                            <span class="text-primary"><?php print($order->getOrderDate());?></span>
                        </h4>

                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="">Állapot:</span>
                            <span class="text-primary"><?php print($order->getOrderStatus());?></span>
                        </h4>

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
                </div>
            </div>
        </div>
    </section>

</main>
<?php
$__CONTENT = ob_get_clean();
?>