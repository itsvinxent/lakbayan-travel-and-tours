<?php 
include __DIR__.'/vendor/autoload.php';

use GuzzleHttp\Client;

function myFilter($var){
    return ($var !== NULL && $var !== FALSE && $var !== "");
}

function getAccreditation(string $region, string $DOT): string{
    $httpClient = new Client();
    $regions = array(
        array(
            "Region" => 'NCR', //PROPER
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=574014400',
            "Agency" => 2, 
            "DOT" => 9 
        ),
        array(
            "Region" => 'CAR', //PROPER
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=182359961',
            "Agency" => 2, 
            "DOT" => 6
        ),
        array(
            "Region" => 'REGI',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=698690618',
            "Agency" => 5, 
            "DOT" => 6 //NO Accreditation available in file
        ),
        array(
            "Region" => 'REGII',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=700982039',
            "Agency" => 2, 
            "DOT" => 6 //NO Accreditation available in file
        ),
        array(
            "Region" => 'REGIII', //PROPER
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=873770424',
            "Agency" => 1, 
            "DOT" => 11
        ),
        array(
            "Region" => 'REGIVA',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1315871731',
            "Agency" => 2, 
            "DOT" => 9
        ),
        array(
            "Region" => 'REGIVB',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1093964076',
            "Agency" => 3, 
            "DOT" => 2
        ),
        array(
            "Region" => 'REGV',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=940924894',
            "Agency" => 4, 
            "DOT" => 13
        ),
        array(
            "Region" => 'REGVI',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1866621462',
            "Agency" => 2, 
            "DOT" => 1
        ),
        array(
            "Region" => 'REGVII',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=2039088722',
            "Agency" => 2, 
            "DOT" => 6 //NO Accreditation available in file
        ),
        array(
            "Region" => 'REGVIII',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=372527395',
            "Agency" => 6, 
            "DOT" => 11
        ),
        array(
            "Region" => 'REGIX',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1424498742',
            "Agency" => 2, 
            "DOT" => 6
        ),
        array(
            "Region" => 'REGX',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1345142145',
            "Agency" => 5, 
            "DOT" => 2
        ),
        array(
            "Region" => 'REGXI',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1632282788',
            "Agency" => 5, 
            "DOT" => 4
        ),
        array(
            "Region" => 'REGXII',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1501434755',
            "Agency" => 3, 
            "DOT" => 7
        ),
        array(
            "Region" => 'REGXIII',
            "Link" => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=986568708',
            "Agency" => 3, 
            "DOT" => 7
        ),
        
    );

    $regionkey = array_search($region, array_column($regions, 'Region'));
    
    if(!is_null($regionkey)){
        $regions[$regionkey]['Link'];
    } else return 'Region Invalid';

    // print_r($regions);
    $response = $httpClient->get($regions[$regionkey]['Link']);
    // $response = $httpClient->get('https://docs.google.com/spreadsheets/d/e/2PACX-1vTtGgUSobqikBmsWRU-Lhe0wfH5ttk8jiT-bs44K7p7_7eSOJWxkffKMSRaqIbIm7-PL9TJh7Ky1J72/pubhtml/sheet?headers=false&gid=1424498742');
    $htmlString = (string) $response->getBody();
    libxml_use_internal_errors(true);

    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->loadHTML($htmlString);
    $xpath = new DOMXPath($doc);    


    // $numbers = $xpath->evaluate('//td',$accreditation);

    // $extracted = [];
    // foreach ($numbers as $number){
    //     $extracted = $number->textContent.PHP_EOL;
    //     echo $extracted;
    // }

    // $titles = $xpath->evaluate('//tbody//tr//td/following-sibling::*[6]');

    // $titles = $xpath->evaluate('//tbody//tr/th/following-sibling::*['.$regions[$regionkey]['DOT'].']'); //ACCRED
    // $names = $xpath->evaluate('//tbody//tr/th/following-sibling::*['.$regions[$regionkey]['Agency'].']'); //NAME

    $titles = $xpath->evaluate('//tbody//tr[td>0]/child::*[position()='.$regions[$regionkey]['DOT'].'+1]'); //ACCRED
    $names = $xpath->evaluate('//tbody//tr[td>0]/child::*[position()='.$regions[$regionkey]['Agency'].'+1]'); //NAME

    // $childtd = $xpath->query("//tbody//tr/*")->length;
    // echo $childtd;
    $extractedElements = array();

    // print_r($titles) ;

    foreach ($titles as $key => $title){
        // $extractedElements[] = $title->textContent.PHP_EOL;
        // $childtd = $xpath->query('//tbody//tr['.$key.']/child::*')->length;
        // echo($childtd);

        // if($key == 0)  continue;
        // else{
            array_push($extractedElements, array(
                "Accreditation" => $title->textContent,
                "Agency" => $names[$key]->textContent.PHP_EOL
            ));
        // }       
        // echo '<br>';
        // echo $title->textContent.' of '.$names[$key]->textContent;
    }



    // print_r($extractedElements);
    // $extractedElements = array_map('array_filter', $extractedElements);
    // print_r(array_values(array_filter($extractedElements)));

    // $names = $xpath->evaluate('//tbody//tr//th/following-sibling::*[2]');
    // $extractedNames = array();

    // foreach ($names as $name){
    //     $extractedNames[] = $name->textContent.PHP_EOL;
        
    // }

    // $filtered_name = array();
    // $filtered_name = array_values(array_filter(array_map('trim', $extractedNames)));
    // print_r($filtered_name);


    // $filtered_array = array();
    // $filtered_array = array_values(array_filter(array_map('trim',$extractedElements)));
    // print_r($filtered_array);

    $key = array_search($DOT, array_column($extractedElements, 'Accreditation'));
    
    if($key === false) $key = null;
    // echo $key;

    // echo '<pre>';
    // print_r($extractedElements);
    // echo '</pre>';


    if (!is_null($key)){
        // echo "FOUND";
        // $key = array_search("DOT-R09-HTL-00254-2021", $extractedElements);

        // echo $key;
        return $extractedElements[$key]['Agency'];
        // echo $filtered_name[$key];
    }else return "NOT FOUND";
}


if (isset($_POST['region']) and isset($_POST['accredNum'])) {
    echo getAccreditation((string) $_POST['region'], (string) $_POST['accredNum']);
} else {
    echo -1; // NOT SENT
}

?>