<?php
ob_start();
?>

<main>

    <section id="product">
        <div class="album py-5 bg-gradient bg-body">
            <div class="container">

                <main class="form-signin">
                    <form action="./admin" method="POST">
                        <h1 class="h3 mb-3 fw-normal">Azonosítás szükséges</h1>

                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInput" placeholder="user" name="username">
                            <label for="floatingInput">Felhasználó</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="password" name="password">
                            <label for="floatingPassword">Jelszó</label>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Belépés</button>
                    </form>
                </main>

            </div>
        </div>
    </section>

</main>
<?php
$__CONTENT = ob_get_clean();
?>