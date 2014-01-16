<?php

$path = "/home/miii/workspace/test-report";

$latest_ctime = 0;

$files = glob($path."/*.xml");
$latest_filename='';
foreach ($files as $file) {
    $filepath = $file;
    if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
        $latest_ctime = filectime($filepath);
        $latest_filename = $filepath;
    }
}
echo $latest_filename;

$file = $latest_filename;
$filename = substr($file, strripos($file,"/")+1, strlen($file)-strripos($file,"/"));
$date = date_parse_from_format('Y_n_d_H', substr($filename, 0, 13));
$body = "";
$xml;
$error = 0;
$failures = 0;

if (file_exists($file))
{
    $xml = simplexml_load_string(file_get_contents($file));
}
//echo "<pre>"; print_r($xml);
foreach ($xml->children() as $testsuites)
{
    $error = intval($testsuites->attributes()->errors);
    $failures = intval($testsuites->attributes()->failures);
    if (true|$error !=0 || $failures != 0 )
    {
         $body = (string)$testsuites->attributes()->name ." Error:" . $error . ", Failures:" . $failures . ". \n";
         $body.= "http://devm1.corp.miiicasa.com/test-report/list.php?f=".$filename;
    }
}
if (true|$error != 0 || $failures != 0 )
{
    
    $now = date("Y-m-d h:i:s");
    $from_name = "noreply@miiicasa.com";
    $from_email ="noreply@miiicasa.com";
    $headers = "From:" . $from_email;
    $subject = $date["year"] . "/". $date["month"]."/".$date["day"]." ".$date["hour"].":00 - 測試報告";
    $to = "kevin_zhuang@miiicasa.com,richard_wang@miiicasa.com,hunter_wu@miiicasa.com";
    //$to = "kevin_zhuang@miiicasa.com";
    mail($to, $subject, $body, $headers);
}

?>
