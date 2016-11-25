<?php
/**
*引入Parser类，用get接受一个md文档，将md格式转换为html
*/
require_once("./lib/Parser.php");
$apiFileName = $_GET['apiFileName'];

$apiFileContent = file_get_contents('./api/api-admin/'.$apiFileName, 'rb');

$parser = new HyperDown\Parser;
//$htmlFileContent = "## 你好\n\n **hello**\n";
echo $parser->makeHtml($apiFileContent);

unset($apiFileContent);
?>
