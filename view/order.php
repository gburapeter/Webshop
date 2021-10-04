<?php
/** @var array $basket_contents */
ob_start();
?>

<main>

    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">

                <div class="row g-5">
                    <div class="col-md-7 col-lg-8">
                        <h1 class="fw-light">Kosárdasdads tartalma</h1>

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
                            foreach($basket_contents as $id => $row) {
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
                        <h1 class="fw-light">Megrendelés</h1>
                        <form class="needs-validation" novalidate="" id="order-form">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Név</label>
                                    <input type="text" class="form-control" id="name" placeholder="Vezetéknév Keresztnév" value="" required="" name="txt-name">
                                </div>


                                <div class="col-12">
                                    <label for="email" class="form-label">Email cím</label>
                                    <input type="email" class="form-control" id="email" placeholder="you@example.com" name="txt-email">
                                </div>

                                <div class="col-md-12">
                                    <label for="county" class="form-label">Megye</label>
                                    <select class="form-select" id="county" required="" name="cmb-county">
                                        <option value="">Válasszon...</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="town" class="form-label">Település / kerület</label>
                                    <select class="form-select" id="town" required="" name="cmb-town">
                                        <option value="">Válasszon...</option>
                                    </select>
                                </div>


                                <div class="col-12">
                                    <label for="address" class="form-label">Cím</label>
                                    <input type="text" class="form-control" id="address" placeholder="Kossuth utca 15." required="" name="txt-address">
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="accept-terms" name="chk-terms">
                                <label class="form-check-label" for="accept-terms">Elfogadom az <a href="terms.html">Általános Szerződési Feltételek</a>et</label>
                            </div>

                            <hr class="my-4">

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="newsletter-on" name="rad-newsletter" type="radio" class="form-check-input" value="on" required="">
                                    <label class="form-check-label" for="newsletter-on">Feliratkozom a hírlevélre</label>
                                </div>
                                <div class="form-check">
                                    <input id="newsletter-off" name="rad-newsletter" type="radio" class="form-check-input" value="off" checked="" required="">
                                    <label class="form-check-label" for="newsletter-off">Nem kérek hírlevelet</label>
                                </div>
                            </div>
                            <hr>

                            <div class="row gy-3">
                                <div class="col-12">
                                    <label for="txt-comment" class="form-label">Megjegyzés</label>
                                    <textarea class="form-control" id="txt-comment" placeholder="" required="" name="txt-comment"></textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button class="w-100 btn btn-primary btn-lg" type="submit">Megrendelem!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php
$__CONTENT = ob_get_clean();
?>