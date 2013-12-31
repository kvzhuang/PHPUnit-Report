<?php 
//path to directory to scan
$directory = "/home/miii/workspace/test-report/";
 
$reports = glob($directory . "*.xml");
 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="">
<meta name="created" content="2013-12-31">
<title> Prototype</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/3.7.2/build/cssreset/reset-min.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/3.7.2/build/cssfonts/fonts-min.css">
<style type="text/css">

</style>
</head>
<body>
    <div>
<?php foreach ($reports as $report) { ?>
<?php 
$filename = substr($report, strripos($report,"/")+1, strlen($report)-strripos($report,"/"));
?>
<a href="/test-report/list.php?f=<?php echo $filename; ?>">
<?php echo $filename; ?>
<a>
<br>
<?php } ?>
    </div>
    <script>
    </script>
</body>
</html>

