<?php

$config = array(
    'endpoint' => array(
        'localhost' => array(
            'host' => 'localhost',
            'port' => 8983,
            'path' => '/solr/',
        )
    )
);

$GLOBALS["solariumConfig"] = $config;
