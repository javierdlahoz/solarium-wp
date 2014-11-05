<?php

require(__DIR__."/config/module_loader.php");

use Solarium\Service\AbstractService;

$el['name'] = "juancho";
$personDocument = new Solarium\Entity\AbstractEntity($el);

$abstractService = AbstractService::getSingleton($config);
$abstractService->save($personDocument);

$results = $abstractService->findBy("*ja*");
foreach($results as $result)
{
	var_dump($result->getId());
	echo "<br>";
}