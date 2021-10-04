<?php
ob_start();
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <title>Webshop megrendelés</title>
    </head>
    <body style="text-align: center; min-width: 640px; width: 100%; height: 100%; font-family: Arial, sans-serif; margin: 0; padding: 0;" bgcolor="#fafafa">
    <br>
    <table border="0" cellpadding="0" cellspacing="0" id="body" style="text-align: center; min-width: 640px; width: 100%; margin: 0; padding: 0;" bgcolor="#fafafa">
        <tbody>
        <tr>
            <td style="font-family: Arial, sans-serif;">
                <table border="0" cellpadding="0" cellspacing="0" class="wrapper" style="width: 640px; border-collapse: separate; border-spacing: 0; margin: 0 auto;">
                    <tbody>
                    <tr>
                        <td class="wrapper-cell" style="font-family: Arial, sans-serif; border-radius: 3px; overflow: hidden; padding: 18px 25px; border: 1px solid #ededed;" align="left" bgcolor="#fff">
                            <table border="0" cellpadding="0" cellspacing="0" class="content" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                <tbody>
                                <tr class="alert">
                                    <td style="font-family: Arial,sans-serif; border-radius: 3px; font-size: 14px; line-height: 1.3; overflow: hidden; color: #ffffff; padding: 10px;" align="center" bgcolor="#448822">
                                        <table border="0" cellpadding="0" cellspacing="0" class="img" style="border-collapse: collapse; margin: 0 auto;">
                                            <tbody>
                                            <tr>
                                                <td style="font-family: Arial,sans-serif; color: #ffffff;" align="center" valign="middle">
                                                    <span>Megrendelését az alábbi adatokkal sikeresen megkaptuk!</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="spacer">
                                    <td style="font-family: Arial,sans-serif; height: 18px; font-size: 18px; line-height: 18px;">
                                        &#160;
                                    </td>
                                </tr>
                                <tr class="section">
                                    <td style="font-family: Arial,sans-serif; border-radius: 3px; overflow: hidden; padding: 0 15px; border: 1px solid #ededed;">
                                        <table border="0" cellpadding="0" cellspacing="0" class="info" style="width: 100%;">
                                            <tbody>
                                            <tr>
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #8c8c8c; font-weight: 300; margin: 0; padding: 14px 0;">
                                                    Megrendelő:
                                                </td>
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #333333; font-weight: 400; width: 75%; margin: 0; padding: 14px 0 14px 5px;">
                                                    <?php print($order->getCustomerName())?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #8c8c8c; font-weight: 300; border-top-width: 1px; border-top-color: #ededed; border-top-style: solid; margin: 0; padding: 14px 0;">
                                                    Cím:
                                                </td>
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #333333; font-weight: 400; width: 75%; border-top-width: 1px; border-top-color: #ededed; border-top-style: solid; margin: 0; padding: 14px 0 14px 5px;">
                                                    <?php $s = "";
                                                    $s .= $order->getCustomerTown();
                                                    $s .= ', ';
                                                    $s .= $order->getCustomerAddress();
                                                    print($s);
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #8c8c8c; font-weight: 300; border-top-width: 1px; border-top-color: #ededed; border-top-style: solid; margin: 0; padding: 14px 0;">
                                                    Végösszeg
                                                </td>
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #333333; font-weight: 400; width: 75%; border-top-width: 1px; border-top-color: #ededed; border-top-style: solid; margin: 0; padding: 14px 0 14px 5px;">
                                                    <?php print($order->getTotal()) ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr class="spacer">
                                    <td style="font-family: Arial,sans-serif; height: 18px; font-size: 18px; line-height: 18px;">
                                        &#160;
                                    </td>
                                </tr>
                                <tr class="section">
                                    <td style="font-family: Arial,sans-serif; line-height: 1.4; overflow: hidden; padding: 0 15px;" align="left">
                                        <table border="0" cellpadding="0" cellspacing="0" class="img" style="border-collapse: collapse; width: 100%;">
                                            <tbody>
                                            <tr style="width: 100%;">
                                                <td style="font-family: Arial,sans-serif; font-size: 15px; line-height: 1.4; color: #8c8c8c; font-weight: 300; margin: 0; padding: 14px 0;" align="left">
                                                    <p>A rendelt termékek tételes listáját a csatolt megrendelési összesítőben találja.</p>
                                                    <p>Munkatársaink hamarosan felveszik Önnel a kapcsolatot a fizetés és szállítás egyeztetése céljából.</p>
                                                    <p>Köszönjük, hogy nálunk vásárolt.</p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <tr class="footer">
            <td style="font-family: Arial, sans-serif; font-size: 13px; line-height: 1.6; color: #5c5c5c; padding: 25px 0;">
                <div>
                    Ezt az emailt azért kapta, mert a megrendelést adott le a Webshopban.<br>
                    Kérjük, ne válaszoljon erre a levélre. Ha kérdése van, keressen minket az <a href="mailto:info@webshop">info@webshop</a> címen!
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    </body>
    </html>
<?php
$__MAIL_CONTENT = ob_get_clean();
?>