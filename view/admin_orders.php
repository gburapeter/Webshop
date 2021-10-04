<?php
/** @var Orders $orders */
ob_start();
?>

<main>

    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">

                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">
                        <h1 class="fw-light">Megrendelések</h1>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="col-8">Rendelés kódja</th>
                                <th scope="col" class="text-end">Időpont</th>
                                <th scope="col" class="text-end">Végösszeg</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            foreach($orders->getOrders() as $order) {

                                /** @var Order $order */
                                $total += $order->getTotal();


                                print('<tr>');
                                print('   <td class="col-8"><a href="' . BASEURL.'/track?order-id='. $order->getOrderId() . '">'.$order->getOrderId().'</a></td>');
                                print('   <td class="text-end">'.$order->getOrderDate().'</td>');
                                print('   <td class="text-end">'. number_format($order->getTotal(),0,'', " ") .' Ft</td>');
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
                </div>
            </div>
        </div>
    </section>

</main>
<?php
$__CONTENT = ob_get_clean();
?>