<?php
ob_start();
?>

<main>

    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">

                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">
                        <h1 class="fw-light">Megrendelés állapotának lekérdezése</h1>
                        <br>
                        <br>
                        <form action="<?php print(BASEURL);?>/track" id="tracking-form" method="get">
                            <div class="row g-3">
                                <div class="col-md-8 col-lg-6 offset-md-1 offset-lg-3">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">Megrendelési azonosító:</span>
                                        <input type="text" class="form-control" id="order-id" placeholder="" value="" required="" name="order-id">
                                        <button class="btn btn-success" type="submit">Mutasd!</button>
                                    </div>
                                </div>
                            </div>
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