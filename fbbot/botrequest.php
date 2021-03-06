<?php

$path = "www.sinhalaaruth.tk";

if($_SERVER['SERVER_NAME'] == "localhost"){
    $path = "localhost/SinhalaAruth";
}

$requestURl = "http://" . $path . "/request.php";
if (isset($_GET["m"])) {
    $method = $_GET["m"];
}
if (isset($_GET["w"])) {
    $word = $_GET["w"];
}
if (isset($_GET["w1"])) {
    $word1 = $_GET["w1"];
}

if (isset($_GET["r"])) {
    $recordid = $_GET["r"];
}

if (isset($_GET["a"])) {
    $meaning = $_GET["a"];
}
if (isset($_GET["e"])) {
    $example = $_GET["e"];
}
if (isset($_GET["en"])) {
    $english = $_GET["en"];
}


if ($method == "meaning") {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => str_replace ( ' ', '%20',$requestURl . "?m=meaning&w=" . $word1),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
    
//for($i = 0; $i < sizeof($result); $i+=3)
    $values = new stdClass();
    $jsonObj = new stdClass();
    if (sizeof($result) > 0) {
        $jsonObj->option = "found";
        $values->r = $result[0]->id;
        $values->meaning = $result[0]->meaning;
        $values->example = $result[0]->example;
        $values->up = (string)$result[0]->up;
        $values->down = (string)$result[0]->down;
        $values->english = $result[0]->english;
        $values->link = str_replace(' ', '%20',"www.sinhalaaruth.tk/?w=".$word1);
        
        
    }  else {
        $jsonObj->option = "not_found";
    }
    $values->w = $word1;
    $jsonObj->values = $values;
    echo json_encode($jsonObj);
}

if ($method == "voteup") {
    $response = "";

    if (isset($recordid)) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => str_replace ( ' ', '%20',$requestURl . "?m=voteup&s=plus&r=" . $recordid),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
    $values = new stdClass();
    $values->msg = $response;
    $jsonObj = new stdClass();
    $jsonObj->option = "done";
    if ($response == "error" | $response == "") {
        $jsonObj->option = "error";
    }
    $jsonObj->values = $values;
    echo json_encode($jsonObj);
}
if ($method == "votedown") {
    $response = "";

    if (isset($recordid)) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => str_replace ( ' ', '%20',$requestURl . "?m=votedown&s=plus&r=" . $recordid),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
    $values = new stdClass();
    $values->msg = $response;
    $jsonObj = new stdClass();
    $jsonObj->option = "done";
    if ($response == "error" | $response == "") {
        $jsonObj->option = "error";
    }
    $jsonObj->values = $values;
    echo json_encode($jsonObj);
}

if ($method == "reportMeaning") {
    $response = "";

    if (isset($recordid)) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => str_replace ( ' ', '%20',$requestURl . "?m=reportMeaning&r=" . $recordid),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
    $values = new stdClass();
    $values->msg = $response;
    $jsonObj = new stdClass();
    $jsonObj->option = "done";
    if ($response == "error" | $response == "") {
        $jsonObj->option = "error";
    }
    $jsonObj->values = $values;
    echo json_encode($jsonObj);
}

if ($method == "addWord") {
    if (isset($word) & isset($meaning) & isset($example) & isset($english)) {
        $tempURL_spaceRemoved = str_replace ( ' ', '%20',$requestURl . "?m=addWord&w=" . $word . "&a=" . $meaning . "&e=" . $example. "&en=" .  $english);
        $tempURL_newLineRemoved = str_replace(PHP_EOL, '%0D%0A', $tempURL_spaceRemoved);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  $tempURL_newLineRemoved,//str_replace ( ' ', '%20',$requestURl . "?m=addWord&w=" . $word . "&a=" . $meaning . "&e=" . $example. "&en=" .  $english),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
    //echo $response;
    $values = new stdClass();
    $values->msg = $response;
    $jsonObj = new stdClass();
    $jsonObj->option = "done";
    if ($response == "error" | $response == "") {
        $jsonObj->option = "error";
    }
    $jsonObj->values = $values;
    echo json_encode($jsonObj);
    //echo json_encode($jsonObj);
}
?>