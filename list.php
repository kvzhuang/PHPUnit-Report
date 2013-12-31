<?php
$file = "/home/miii/workspace/test-report/".$_GET["f"];
if (file_exists($file))
{
    $xml = simplexml_load_string(file_get_contents($file));
}
?>
<html>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <style>
        .suite { margin-left: 1em; clear: both;}
        .testCase, h2 { clear: both; }        
        .tcName, .tcFile, .tsTests, .tsAssertions, .tsTime { float: left;        }
        .tcAssertions, .tcTime, .tsErrors, .tsFailures { float: right;        }
        .tcName { width: 30%; }
        .tcFile { width: 35%; }
        .tcAssertions { width: 5%; }
        .tcTime { width: 10%; }
        .tsTests, .tsAssertions, .tsTime, .tsErrors, .tsFailures { width: 15%; }

        pre { clear: both; margin-left: 1em; padding-left: 1em;}        
        pre.failure { border-left: 5px solid red; }
        pre.error { border-left: 5px solid black; }

        .status { float: right; width: 5%; }
        .failureB { background-color: red; color: red; }
        .errorB { background-color: black; color: black; }
        .okB { background-color: green; color: green; }                
                
        </style>
    <body>
        <h1>PHPUnit - Report</h1>
<?php foreach ($xml->children() as $testsuites) { ?>
        <div class="suite $class">
            <h2><?php echo (string)$testsuites->attributes()->name; ?></h2>

            <div class="testSuiteInfo">
                    <div class="tsTests">Tests: <?php echo (string)$testsuites->attributes()->tests; ?></div>
                    <div class="tsAssertions">Assertions: <?php echo (string)$testsuites->attributes()->assertions; ?></div>
                    <div class="tsTime">Time: <?php echo (string)$testsuites->attributes()->time; ?></div>
                    <div class="tsErrors">Errors: <?php echo (string)$testsuites->attributes()->errors; ?></div>
                    <div class="tsFailures">Failures: <?php echo (string)$testsuites->attributes()->failures; ?></div>
            </div>
<?php 
foreach ($testsuites->children() as $testsuite ) { 
    foreach ($testsuite->children() as $testcase) {
?>
            <div class="testCase">
                    <div class="tcName"><?php echo (string)$testcase->attributes()->name ; ?></div>
                    <div class="tcFile"><?php echo (string)$testcase->attributes()->file ; ?></div>
<?php if (isset($testcase->failure)) { ?>
                            <div class="status failureB">X</div>
                            <pre class="failure">
                                    <xsl:value-of select="failure" />
                            </pre>
<?php } else if (isset($testcase->error)) { ?>
                            <div class="status errorB">X</div>
                            <pre class="error">
                                    <xsl:value-of select="error" />
                            </pre>
<?php } else { ?>
                            <div class="status okB">X</div>
<?php } ?>
                    <div class="tcAssertions"> Assertions:<?php echo (string)$testcase->attributes()->assertions ; ?></div>
                    <div class="tcTime">Times:<?php echo (string)$testcase->attributes()->time ; ?></div>
            </div>
<?php           
            }
        } 
?>
        </div>
<?php } ?>
    </body>
</html>



