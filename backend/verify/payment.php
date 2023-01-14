
<?php
require_once('vendor/autoload.php');


function generatePaymentLink(int $totalAmount, ?int $bookingID = null): array{
  $client = new \GuzzleHttp\Client();
  $totalAmount = $totalAmount*100;
  $response = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
    'body' => '{"data":
                      {"attributes":
                        {"amount":'.$totalAmount.',
                          "redirect":
                          {"success":"http://localhost:3000/backend/verify/payment_success.php?orderID='.$bookingID.'",
                            "failed":"http://localhost:3000/backend/verify/payment_failed.php?orderID='.$bookingID.'"},
                            "type":"gcash",
                            "currency":"PHP"}}}',
    'headers' => [
      'accept' => 'application/json',
      'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
      'content-type' => 'application/json',
    ],
  ]);

 return json_decode($response->getBody(), true);
  // echo '<br>';
  // echo $src_id = $content['data']['id'];
  // echo '<br>';
  // echo $src_amount = $content['data']['attributes']['amount'];
  // echo '<br>';
  // echo $src_url = $content['data']['attributes']['redirect']['checkout_url'];

}

function generatePaymongoLink(int $totalAmount): array {
  $client = new \GuzzleHttp\Client();
  $totalAmount = $totalAmount*100;
  $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
    'body' => '{"data":
                      {"attributes":
                        {"amount": '.$totalAmount.',
                                "description":"Payment to Lakbayan",
                                "remarks":"Keep this for proof of payment"}}}',
    'headers' => [
      'accept' => 'application/json',
      'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
      'content-type' => 'application/json',
    ],
  ]);

  return json_decode($response->getBody(), true);
}

function getPaymongoLink(string $linkReference): array{
  $client = new \GuzzleHttp\Client();
  $response = $client->request('GET', 'https://api.paymongo.com/v1/links/'.$linkReference.'', [
    'headers' => [
      'accept' => 'application/json',
      'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
      'content-type' => 'application/json',
    ],
  ]);

  return json_decode($response->getBody(), true);
}

function generateRefund($amount, $payment_id, $reason, $notes){
  $amount = $amount * 100;
  $client = new \GuzzleHttp\Client();
  $response = $client->request('POST', 'https://api.paymongo.com/refunds', [
    'body' => '{"data":
                    {"attributes":
                               {"amount": '.$amount.',
                                "payment_id": "'.$payment_id.'",
                                "reason": "'.$reason.'",
                                "notes": "'.$notes.'"}}}',
    'headers' => [
      'accept' => 'application/json',
      'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
      'content-type' => 'application/json',
    ],
  ]);
}


// TEST ENVIRONMENT ====================================================================================================================
// $generated = generatePaymentLink(173);
// echo $generated['data']['attributes']['redirect']['checkout_url'];

// $client = new \GuzzleHttp\Client();


// $response = $client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
//   'body' => '{"data":{"attributes":{"type":"paymaya"}}}',
//   'headers' => [
//     'Content-Type' => 'application/json',
//     'accept' => 'application/json',
//     'authorization' => 'Basic cGtfdGVzdF9tdWRjUFZkWEpNamRMVkN3SjNKTTkzMTI6',
//   ],
// ]);

//Create Payment Methods
// $response1 = $client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
//   'body' => '{"data":{"attributes":{"details":{"card_number":"4343434343434345","exp_month":12,"exp_year":22,"cvc":"343","bank_code":"test_bank_one"},"billing":{"name":"Testing Payment","email":"test@gmail.com","phone":"09952001867"},"type":"card"}}}',
//   'headers' => [
//     'Content-Type' => 'application/json',
//     'accept' => 'application/json',
//     'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
//   ],
// ]); //pm_j6DEa3VtGmmHS1tWV35muhM7

//Create Source
// $response2 = $client->request('POST', 'https://api.paymongo.com/v1/sources', [
//   'body' => '{"data":
//                     {"attributes":
//                       {"amount":15000,
//                         "redirect":
//                         {"success":"http://localhost:3000/backend/verify/payment_success.php",
//                           "failed":"http://localhost:3000/backend/verify/payment_failed.php"},
//                           "type":"gcash",
//                           "currency":"PHP"}}}',
//   'headers' => [
//     'accept' => 'application/json',
//     'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
//     'content-type' => 'application/json',
//   ],
// ]);

//Create Link
// $response = $client->request('POST', 'https://api.paymongo.com/v1/links', [
//   'body' => '{"data":
//                     {"attributes":
//                       {"amount":150000,
//                               "description":"Payment to package",
//                               "remarks":"A proof of payment"}}}',
//   'headers' => [
//     'accept' => 'application/json',
//     'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
//     'content-type' => 'application/json',
//   ],
// ]);

// $responselink = $client->request('GET', 'https://api.paymongo.com/v1/links/', [
//   'headers' => [
//     'accept' => 'application/json',
//     'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
//     'content-type' => 'application/json',
//   ],
// ]);

//
// $response3 = $client->request('GET', 'https://api.paymongo.com/v1/sources/src_wEPJzemwebmx81fviXrpxkgk', [
//   'headers' => [
//     'accept' => 'application/json',
//     'authorization' => 'Basic c2tfdGVzdF9MS212a29xM241N2FTRXRqNnpRR1lYUjM6',
//     'content-type' => 'application/json',
//   ],
// ]);


// $decode = getPaymongoLink('qG4CS3g');

// echo $decode['data']['attributes']['payments'][0]['data']['attributes']['source']['type'];

// $last_key = end($decode['data']['attributes']['payments']);
// $ctr = 0;
// foreach ($decode['data']['attributes']['payments'] as $key => $decodes){
//   if($ctr === count($decode['data']['attributes']['payments'])-1){
//   echo '<pre>';
//   print_r($decodes['data']['id']);
//   print_r($decodes['data']['attributes']['status']);
//   echo '</pre>';}
//   $ctr = $ctr+1;
// }




// generatePaymentLink(900200);


// $decode = json_decode($responselink->getBody(), true);

// echo '<pre>';
// print_r($decode);
// echo '</pre>';


//LINK STATUS
// echo $decode['data']['attributes']['status'];

// echo $decode['data']['attributes']['reference_number'];

// echo $decode['data']['attributes']['checkout_url'];