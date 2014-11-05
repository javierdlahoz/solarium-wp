<?php


$dirPath = __DIR__."/../Solarium/";
$dirResource = __DIR__."/../Resource/";

/**it loads all files in folders **/
require($dirPath."vendor/solarium/solarium/examples/init.php");
require $dirPath."Entity/EntityInterface.php";
require $dirPath."Entity/AbstractEntity.php";
require $dirPath."Service/AbstractService.php";

require $dirResource."Service/ResourceService.php";
require $dirResource."Entity/ResourceEntity.php";