<?php
$PaymentId = $_POST["PaymentId"]; // recebe o retorno do PaymentId 
$cabeçalhos = ["Content-Type: application/json",'MerchantId: SEU MERCHANTID','MerchantKey: SEU MERCHANTKEY'];
$url = 'https://api.cieloecommerce.cielo.com.br/1/sales/'; // Alterar url para o sandbox
$ch = curl_init($url.'{'.$PaymentId.'}/capture');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $cabeçalhos);
curl_setopt($ch, CURLOPT_POSTFIELDS,false);
$resposta = curl_exec($ch);
curl_close($ch);
if (!$resposta){
	die("Error Curl: 'engine-transaction-cred-capture'");
}
else{
	$json_output = json_decode($resposta, true);
	print_r($json_output);
}
?>
