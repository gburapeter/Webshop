<?php
ob_start();
?>

<main>

    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">

                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">
                        <h1 class="fw-light">Hírlevél leiratkozás</h1>
                        <br>
                        <br>
                        <form action="<?php print(BASEURL);?>/unsubscribe" id="unsubscribe-form" method="get">
                            <div class="row g-3">
                                <div class="col-md-8 col-lg-6 offset-md-1 offset-lg-3">
                                    <div class="form-group m-2">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Email cím:</span>
                                            <input type="text" class="form-control" id="order-id" placeholder="" value="" required="" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group m-2">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">Leiratkozási kulcs:</span>
                                            <input type="text" class="form-control" id="order-id" placeholder="" value="" required="" name="token">
                                        </div>
                                    </div>
                                    <div class="form-group m-2">
                                        <button class="btn btn-primary btn-lg" type="submit">Küldés</button>
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