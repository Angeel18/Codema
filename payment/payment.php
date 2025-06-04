<?php
session_start();
require_once '../config/bbdd_config.php';
include '../actions/apiRedsys.php';

$miObj = new RedsysAPI;
$pdo = createConnection();

$_SESSION['name']=$_POST['name'];
$_SESSION['email']=$_POST['email'];

$fuc = "999008881";
$terminal = "1";
$moneda = "978";
$trans = "0";
$url = "";
$urlKO = "https://codema.fun/payment/paymentKO.php";
$urlOK = "https://codema.fun/payment/paymentOK.php";

$id = str_pad($_SESSION['idOrder'], 12, '0', STR_PAD_LEFT);
$orderNumber = str_pad($id, 6, '0', STR_PAD_LEFT) . date('His');

$amount = (int) ($_SESSION['plan_price'] * 100);

$miObj->setParameter("DS_MERCHANT_AMOUNT", $amount);
$miObj->setParameter("DS_MERCHANT_ORDER", $orderNumber);
$miObj->setParameter("DS_MERCHANT_MERCHANTCODE", $fuc);
$miObj->setParameter("DS_MERCHANT_CURRENCY", $moneda);
$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE", $trans);
$miObj->setParameter("DS_MERCHANT_TERMINAL", $terminal);
$miObj->setParameter("DS_MERCHANT_MERCHANTURL", $url);
$miObj->setParameter("DS_MERCHANT_URLOK", $urlOK);
$miObj->setParameter("DS_MERCHANT_URLKO", $urlKO);

$version = "HMAC_SHA256_V1";
$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';

$params = $miObj->createMerchantParameters();
$signature = $miObj->createMerchantSignature($kc);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
   
</head>
<body>
  

    <form id="payment-form" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" >
        <input type="hidden" name="Ds_SignatureVersion" value="<?php echo $version; ?>">
        <input type="hidden" name="Ds_MerchantParameters" value="<?php echo $params; ?>">
        <input type="hidden" name="Ds_Signature" value="<?php echo $signature; ?>">
    </form>

    <script>
        window.onload = function () {
            document.getElementById('payment-form').submit();
        };
    </script>
</body>
</html>
