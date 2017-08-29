<?php
$HrefConfirm = $_POST['HrefConfirm']; //URL DE RETORNO DA TRANSAÇÃO JUNTO COM O PAYMENT ID
$cabeçalhos = ["Content-Type: application/json",'MerchantId: SEU MERCHANTID','MerchantKey: SEU MERCHANTKEY'];
$url = $HrefConfirm;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $cabeçalhos);
curl_setopt($ch, CURLOPT_POSTFIELDS,false);
$resposta = curl_exec($ch);
curl_close($ch);
if (!$resposta){
	die("Error Curl: 'engine-transaction-cred-consult'");
}
else{
	$json_output = json_decode($resposta, true);
	print_r($json_output);
}
?>
