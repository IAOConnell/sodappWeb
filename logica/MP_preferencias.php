<?php
// SDK de Mercado Pago
use MercadoPago\MercadoPagoConfig;
// Agrega credenciales
MercadoPagoConfig::setAccessToken("TEST-6029288139074599-110215-ef4c5b7e056bd8de51b4f11ecc0c3afa-476961876");
?>

          
<?php
$client = new PreferenceClient();
$preference = $client->create([
  "items"=> array(
    array(
      "title" => "Producto",
      "quantity" => 1,
      "currency_id" => "ARS",
      "unit_price" => 100
    )
  )
]);
?>