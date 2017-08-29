<?php

$cabeçalhos = [
	"Content-Type: application/json",
	'MerchantId: SEU MERCHANTID',
	'MerchantKey:  SEU MERCHANTKEY'
];

$corpo = [
	"MerchantOrderId" => "201411173454307",
	"Customer" => [
		"Name" => $NameBuyer,
		"Email" => $EmailBuyer,
		"Birthdate" => $BirthdateYear."-".$BirthdateMonth."-".$BirthdateDay,
		"Identity" => $Identity,
		"IdentityType" => $IdentityType
	],
	"Address" =>[
		"Street" => $AddressStreet,
		"Number" => $AddressNumber,
		"Complement" => $AddressComplement,
		"ZipCode" => $AddressZipCode,
		"City" => $AddressCity,
		"State" => $AddressState,
		"Country" => $AddressCountry
	],
	"DeliveryAddress" => [
		"Street" => $DeliveryAddressStreet,
		"Number" => $DeliveryAddressNumber,
		"Complement" => $DeliveryAddressComplement,
		"ZipCode" => $DeliveryAddressZipCode,
		"City" => $DeliveryAddressCity,
		"State" => $DeliveryAddressState,
		"Country" => $DeliveryAddressCountry
	],
	"Payment" => [
		"Type" => "CreditCard",
		"Amount" => $Amount,
		"ServiceTaxAmount" => 0,
		"Installments" => 1,
		"SoftDescriptor" => "IMPRESSO*BOLETO",
		"Interest" => "ByMerchant", //Tipo de parcelamento - Loja (ByMerchant) ou Cartão (ByIssuer).
		"Capture" => false,
		"Authenticate" => false,
		"ReturnUrl" => "http://seuretorno/engine-transaction-cred.php",
		"CreditCard" => [
			"CardNumber" => $CardNumberPartOne.$CardNumberPartTwo.$CardNumberPartThree.$CardNumberPartFour,
			"Holder" => $Holder,
			"ExpirationDate" => $ExpirationDateMonth."/".$ExpirationDateYear,
			"SecurityCode" => $SecurityCode,
			"SaveCard" => false, //false ou true para guardar os dados do cartão
			"Brand" => $Brand
		]
	],
	"FraudAnalysis" => [
		"Sequence" => "AuthorizeFirst",
		"SequenceCriteria" => "Always",
		"FingerPrintId" => "",
		"Browser" => [
			"CookiesAccepted" => false,
			"Email" => $EmailBuyer,
			"HostName" => "ubuntu1604dev-Virtual-Machine",
			"IpAddress" => "xxx.xxx.xxx.xx",
			"Type" => "Chrome"
		]
	],
	"Cart" => [
		"IsGift" => false,
		"ReturnsAccepted" => true,
		"Items"=>[
			"GiftCategory" => "Undefined",
			"HostHedge" => "Off",
			"NonSensicalHedge" => "Off",
			"ObscenitiesHedge" => "Off",
			"PhoneHedge" => "Off",
			"Name" => "ItemTeste",
			"Quantity"=>1,
			"Sku" => "201411170235134521346",
			"UnitPrice" => 100,
			"Risk" => "High",
			"TimeHedge" => "Normal",
			"Type" => "AdultContent",
			"VelocityHedge" => "High",
			"Passenger" => [
				"Email" => $EmailBuyer,
				"Identity" => $Identity,
				"Name" => $NameBuyer,
				"Rating" => "Adult",
				"Phone" => "19717171711",
				"Status" => "Accepted"
			]
		]
	],
	"MerchantDefinedFields" => [
		"Id" => 95,
		"Value" => "Eu defini isso"
	],
	"Shipping" => [
		"Addressee" => $NameBuyer,
		"Method" => "LowCost",
		"Phone" => "19717171711"
	],
	"Travel" => [
		"DepartureTime" => "2010-01-02",
		"JourneyType" => "Ida",
		"Route" => "MAO-RJO",
		"Legs" => [
				"Destination" => "GYN",
				"Origin" => "VCP"
		]
	]
];

$ch = curl_init();
curl_setopt_array($ch, [
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_URL => 'https://api.cieloecommerce.cielo.com.br/1/sales/', //alterar para url do sandbox
	CURLOPT_HTTPHEADER => $cabeçalhos,
	CURLOPT_POSTFIELDS => json_encode($corpo),
	CURLOPT_RETURNTRANSFER => true
]);

$resposta = curl_exec($ch);
curl_close($ch);
$json_output = json_decode($resposta, true);
print_r($json_output);

?>
