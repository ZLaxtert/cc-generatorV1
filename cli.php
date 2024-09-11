<?php

// DONT CHANGE THIS
/*==========> INFO 
 * CODE     : BY ZLAXTERT
 * SCRIPT   : CC GENERATOR
 * VERSION  : V1
 * TELEGRAM : t.me/zlaxtert
 * BY       : DARKXCODE
 */


//========> REQUIRE

require_once "function/function.php";
require_once "function/gangbang.php";
require_once "function/threesome.php";

//========> BANNER

echo banner();
echo banner2();

//========> GET COUNT

entercount:
echo "\n\n$WH [$GR+$WH]$WH How much you want to generate$WH ($DEF ex:$YL 200000$WH )$GR >> $WH";
$count = trim(fgets(STDIN));
if (!preg_match("/^[0-9]*$/", $count)) {
    echo "\n\n [$RD!$WH] PLEASE INPUT NUMBER ONLY [$RD!$WH]\n\n";
    goto entercount;
}

//=========> THREADS

reqemail:
echo "$WH [$GR+$WH] Threads ($YL Max 15 $WH) ($YL Recommended 5-10 $WH) $GR>> $WH";
$reqemail = trim(fgets(STDIN));
$reqemail = (empty($reqemail) || !is_numeric($reqemail) || $reqemail <= 0) ? 7 : $reqemail;
if ($reqemail > 15) {
    echo PHP_EOL . PHP_EOL . "$WH [$YL!$WH] $RD MAX 15$WH [$YL!$WH]$DEF" . PHP_EOL . PHP_EOL;
    goto reqemail;
}

//=========> TYPE

entergate:
echo "\n       $WH  [$GR+$WH]$YL GENERATE$WH [$GR+$WH] $WH
 [$GR 1 $WH]$WH VISA $WH       [$GR 2 $WH]$WH MASTERCARD $WH
 [$GR 3 $WH]$WH AMEX $WH       [$GR 4 $WH]$WH JCB $WH   
 [$GR 5 $WH]$WH DISCOVER  $WH  [$GR 6 $WH]$WH CUSTOM BIN  $WH
 [$GR 99 $WH]$WH EXIT  $WH

 [$GR+$WH]$WH CHOOSE$GR >> $WH";
$gateee = trim(fgets(STDIN));
if ($gateee == 1) {
    $gateWay = "visa";
} else if ($gateee == 2) {
    $gateWay = "mastercard";
} else if ($gateee == 3) {
    $gateWay = "amex";
} else if ($gateee == 4) {
    $gateWay = "jcb";
} else if ($gateee == 5) {
    $gateWay = "discover";
} else if ($gateee == 6) {
    $gateWay = "custom";
} else if ($gateee == 99) {
    echo "\n\n [$BL!$WH] THANKS FOR USING [$BL!$WH]\n\n";
    exit();
} else {
    echo "\n\n [$RD!$WH] CHOOSE NOT FOUND [$RD!$WH]\n\n";
    goto entergate;
}

//============> CUSTOM BIN
if ($gateWay == "custom") {
    enterBin:
    echo "\n$WH [$GR+$WH]$WH Custom BIN$WH ($DEF ex:$YL 440022$WH )$GR >> $WH";
    $binNYA = trim(fgets(STDIN));
    $hitungJumlahBin = strlen($binNYA);
    $angkaPertama = substr($binNYA, 0, 1);

    if($angkaPertama == 3){
        if($hitungJumlahBin > 10){
            echo "\n\n [$RD!$WH] PLEASE INPUT BIN MAX 10 DIGIT [$RD!$WH]\n\n";
            goto enterBin;
        }
    }else{
        if($hitungJumlahBin > 10){
            echo "\n\n [$RD!$WH] PLEASE INPUT BIN MAX 10 DIGIT [$RD!$WH]\n\n";
            goto enterBin;
        }
    }

    if (!preg_match("/^[0-9]*$/", $binNYA)) {
        echo "\n\n [$RD!$WH] PLEASE INPUT NUMBER ONLY [$RD!$WH]\n\n";
        goto enterBin;
    }
    if($hitungJumlahBin < 6){
        echo "\n\n [$RD!$WH] PLEASE INPUT BIN MIN 6 DIGIT [$RD!$WH]\n\n";
        goto enterBin;
    }
}else{
    $binNYA = "123456";
}

//=========> COUNT

$live = 0;
$die = 0;
$rto = 0;
$unknown = 0;
$limit = 0;
$no = 0;
echo "\n\n";

//========> LOOPING

$rollingCurl = new \RollingCurl\RollingCurl();

for ($i=0; $i < $count; $i++) {
    //API
    $api = "https://api.darkxcode.site/other/cc-generator/?submit=1&count=1&type=$gateWay&BIN=$binNYA&jum=$count";
    //CURL
    $rollingCurl->setOptions(array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_FOLLOWLOCATION => 1, CURLOPT_MAXREDIRS => 10, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 200))->get($api);

}

//==========> ROLLING CURL

$rollingCurl->setCallback(function (\RollingCurl\Request $request, \RollingCurl\RollingCurl $rollingCurl) use (&$results) {
    global $listname, $no, $total, $live, $die, $unknown, $limit, $rto, $count;
    $no++;
    parse_str(parse_url($request->getUrl(), PHP_URL_QUERY), $params);
    $count = $params["jum"];
    //RESPONSE
    $x = $request->getResponseText();
    $js = json_decode($x, TRUE);
    $msg = $js['data']['msg'];
    $list = $js['data']["lists"];
    $typeeee = $js['data']["type"];
    $jam = Jam();
    



    //============> COLLOR
    $BL = collorLine("BL");
    $RD = collorLine("RD");
    $GR = collorLine("GR");
    $YL = collorLine("YL");
    $MG = collorLine("MG");
    $DEF = collorLine("DEF");
    $CY = collorLine("CY");
    $WH = collorLine("WH");

    //============> RESPONSE

    if (strpos($x, '"status":"success"')) {
        $live++;
        save_file("result/$typeeee.txt", "$list");
        echo "[$RD$no$DEF/$GR$count$DEF][$CY$jam$DEF]$WH GENERATE$DEF =>$BL $list$DEF ./$WH BY$CY DARKXCODE$DEF (V1)" . PHP_EOL;
    } else if (strpos($x, '"status":"failed"')) {
        $die++;
        echo "[$RD$no$DEF/$GR$count$DEF][$CY$jam$DEF]$RD DIE$DEF | [$YL MSG$DEF: $MG$msg$DEF ] | BY$CY DARKXCODE$DEF (V1)" . PHP_EOL;
    } else if ($x == "") {
        $rto++;
        echo "[$RD$no$DEF/$GR$count$DEF][$CY$jam$DEF]$DEF TIMEOUT$DEF | [$YL MSG$DEF:$MG REQUEST TIMEOUT!$DEF ] | BY$CY DARKXCODE$DEF (V1)" . PHP_EOL;
    } else if (strpos($x, 'Request Timeout')) {
        $rto++;
        echo "[$RD$no$DEF/$GR$count$DEF][$CY$jam$DEF]$DEF TIMEOUT$DEF | [$YL MSG$DEF:$MG REQUEST TIMEOUT!$DEF ] | BY$CY DARKXCODE$DEF (V1)" . PHP_EOL;
    } else if (strpos($x, 'Service Unavailable')) {
        $rto++;
        echo "[$RD$no$DEF/$GR$count$DEF][$CY$jam$DEF]$DEF TIMEOUT$DEF | [$YL MSG$DEF:$MG REQUEST TIMEOUT!$DEF ] | BY$CY DARKXCODE$DEF (V1)" . PHP_EOL;
    } else {
        $unknown++;
        echo "[$RD$no$DEF/$GR$count$DEF][$CY$jam$DEF]$YL UNKNOWN$DEF | BY$CY DARKXCODE$DEF (V1)" . PHP_EOL;
    }
})->setSimultaneousLimit((int) $reqemail)->execute();

//============> END

echo PHP_EOL;
echo "================[DONE]================" . PHP_EOL;
echo " DATE             : " . $date . PHP_EOL;
echo " SUCCESS GENERATE : " . $live . PHP_EOL;
echo " FAILED GENERATE  : " . $die . PHP_EOL;
echo " TIMEOUT          : " . $rto . PHP_EOL;
echo " UNKNOWN          : " . $unknown . PHP_EOL;
echo " TOTAL GENERATE   : " . $count . PHP_EOL;
echo "======================================" . PHP_EOL;
echo "[+] RATIO SUCCESS GENERATE => $GR" . round(RatioCheck($live, $count)) . "%$DEF" . PHP_EOL . PHP_EOL;
echo "[!] NOTE : CHECK AGAIN FILE 'unknown.txt' or 'RTO.txt' [!]" . PHP_EOL;
echo "File saved in folder 'result/' " . PHP_EOL . PHP_EOL;

// ==========> FUNCTION

function collorLine($col)
{
    $data = array(
        "GR" => "\e[32;1m",
        "RD" => "\e[31;1m",
        "BL" => "\e[34;1m",
        "YL" => "\e[33;1m",
        "CY" => "\e[36;1m",
        "MG" => "\e[35;1m",
        "WH" => "\e[37;1m",
        "DEF" => "\e[0m"
    );
    $collor = $data[$col];
    return $collor;
}
?>