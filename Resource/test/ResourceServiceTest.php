<?php

require_once __DIR__.'/../../Solarium/vendor/phpunit/phpunit/src/Framework/TestCase.php';
require(__DIR__."/../../config/module_loader.php");


use Resource\Entity\ResourceEntity;
use Resource\Service\ResourceService;
use Resource\Entity\Multiselect\MultiselectEntity;
use Resource\Entity\Location\LocationEntity;
use Resource\Entity\Date\DateEntity;

/**
 * ResourceServiceTest test case.
 */
class ResourceServiceTest extends PHPUnit_Framework_TestCase
{
    const ID = 1234;
    const TITLE = "My Science Festival";
    const DESCRIPTION = "blablablabla";
    const AUTHOR = "Javier De la Hoz";
    const FESTIVAL_NAME = "The Javier's festival";
    const LON = "-75,3";
    const LAT = "44";
    const DATE = "10-10-2014";
    const LICENSE = "Free access";
    const TYPE = "Planning tools";
    const AUDIENCE = "Public";
    const RESOURCE = "Audio";
    const URL = "http://localhost";

    
    /**
     * 
     * @var ResourceService
     */
    private $resourceService;
    
    /**
     * 
     * @var ResourceEntity
     */
    private $resourceEntity;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        $this->resourceService = new ResourceService();
        $this->resourceEntity = new ResourceEntity();
        
        $this->resourceEntity->setId(self::ID);
        $this->resourceEntity->setTitle(self::TITLE);
        $this->resourceEntity->setAuthors(self::AUTHOR);
        $this->resourceEntity->setDescription(self::DESCRIPTION);
        $this->resourceEntity->setFestivalName(self::FESTIVAL_NAME);
        $this->resourceEntity->setUrl(self::URL);
        
        $location = new LocationEntity(self::LAT, self::LON);
        $this->resourceEntity->setLocation($location);
        
        $date = new DateEntity(self::DATE);
        $this->resourceEntity->setDate($date);
        
        $license = new MultiselectEntity();
        $license->addOption(self::LICENSE);
        $this->resourceEntity->setLicense($license);
        
        $type = new MultiselectEntity();
        $type->addOption(self::TYPE);
        $this->resourceEntity->setType($type);
        
        $audience = new MultiselectEntity();
        $audience->addOption(self::AUDIENCE);
        $this->resourceEntity->setAudience($audience);

        $format = new MultiselectEntity();
        $format->addOption(self::RESOURCE);
        $this->resourceEntity->setFormat($format);
       
    }
    
    public function testSaveResource()
    {   
        $this->resourceService->save($this->resourceEntity);
        $resultEntity = $this->resourceService->findResourceBy("id:".self::ID);
        
        $this->assertInstanceOf("Resource\Entity\ResourceEntity", $resultEntity);
        
        if($resultEntity instanceof Resource\Entity\ResourceEntity){
        	$this->assertEquals(self::TITLE, $resultEntity->getTitle());
        	$this->assertEquals(self::DESCRIPTION, $resultEntity->getDescription());
        	$this->assertEquals(self::AUTHOR, $resultEntity->getAuthors());
        	$this->assertEquals(self::FESTIVAL_NAME, $resultEntity->getFestivalName());
        	$this->assertEquals(self::URL, $resultEntity->getUrl());
        	$this->assertEquals(self::LAT, $resultEntity->getLocation()->getLatitude());
        	$this->assertEquals(self::LON, $resultEntity->getLocation()->getLongitude());
        	$this->assertEquals(self::DATE, $resultEntity->getDate()->toString());
        	$this->assertEquals(array(self::LICENSE), $resultEntity->getLicense()->getOptions());
        	$this->assertEquals(array(self::TYPE), $resultEntity->getType()->getOptions());
        	$this->assertEquals(array(self::AUDIENCE), $resultEntity->getAudience()->getOptions());
        	$this->assertEquals(array(self::RESOURCE), $resultEntity->getFormat()->getOptions());
        }
    }
    
    public function testDeleteResource()
    {   
        $this->resourceService->delete($this->resourceEntity);
        $resultEntity = $this->resourceService->findResourceBy("id:".self::ID);
        
        $this->assertNull($resultEntity);
    }
}

