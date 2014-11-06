<?php

namespace Solarium\Service;

use Solarium\Entity\AbstractEntity;
use Solarium\Client;
use Solarium\Entity\EntityInterface;

abstract class AbstractService {

	const RESPONSE_OK = "HTTP/1.1 200 OK";
	const ASC = "asc";
	const DESC = "desc";
	const SUGGESTER_COUNT = 5;

	private $client;
	private $update;
	public static $service;

	function __construct(){
		$config = $GLOBALS["solariumConfig"];
		$this->client = new Client($config);
		$this->update = $this->client->createUpdate();
		$this->init();
	}
    
	public function init(){}
	
	/**
	 * 
	 * @param EntityInterface $resource
	 */
	public function save(EntityInterface $resource)
	{    
	    $this->update->addDocument($resource);
		$this->update->addCommit();   
		
	    self::validateResponse($this->client->update($this->update));
	}
	
 	/**
 	 * 
 	 * @param EntityInterface $resource
 	 */
	public function delete(EntityInterface $resource)
	{
	    $this->update->addDeleteQuery("id:".$resource->getId());
	    $this->update->addCommit();
	    
	    self::validateResponse($this->client->update($this->update));
	    
	}
	
	/**
	 * 
	 * @param $result
	 * @throws \Exception
	 */
	private function validateResponse($result)
	{
	    $headerResponse = $result->getResponse()->getHeaders();
	     
	    if($headerResponse[0] != self::RESPONSE_OK){
	        var_dump($headerResponse[0]);
	        throw new \Exception($headerResponse[0]);
	    }
	}

	/**
	 * 
	 * @param array $config
	 * @return \Service\AbstractService
	 */
	public static function getSingleton()
	{
		$class = get_called_class();
		if(!self::$service instanceof $class){
			self::$service = new $class();
		}
		return self::$service;
	}

	/**
	 * 
	 * @param $expression
	 * @param string $fields
	 * @param array $sort
	 * @return Ambigous <NULL, \Solarium\Entity\AbstractEntity, multitype:\Solarium\Entity\AbstractEntity >
	 */
	public function findBy($expression, $fields = null, array $sort = null){
		$client = $this->client;
		$query = $this->client->createQuery($client::QUERY_SELECT);
		
		if($fields != null)
		{
		  $query->setFields($fields);    
		}
		if($sort != null)
		{
		    $query = self::addSort($query, $sort);
		}
		
		$query->setQuery($expression);

		$resultset = $client->execute($query);
		return self::formatAsEntities(json_decode($resultset->getResponse()->getBody(), true));
	}

	/**
	 * 
	 * @param $expression
	 * @param string $fields
	 * @param array $sort
	 * @return Ambigous <NULL, \Solarium\Entity\AbstractEntity, multitype:\Solarium\Entity\AbstractEntity >
	 */
	public function findOneBy($expression, $fields = null, array $sort = null){
		$client = $this->client;
		$query = $this->client->createQuery($client::QUERY_SELECT);
		$query->setQuery($expression);
		$query->setStart(2)->setRows(1);
        
		if($fields != null)
		{
		    $query->setFields($fields);
		}
		if($sort != null)
		{
		    $query = self::addSort($query, $sort);
		}
		
		$resultset = $client->execute($query);
		return self::formatAsEntities(json_decode($resultset->getResponse()->getBody(), true));
	}

	/**
	 * 
	 * @param $results
	 * @return NULL|\Solarium\Entity\AbstractEntity|multitype:\Solarium\Entity\AbstractEntity
	 */
	private function formatAsEntities($results){
		$entities = array();
		$results = $results['response']['docs'];
		
		if(count($results) == 0){
			return null;
		}
		elseif(count($results) == 1){
			return new AbstractEntity($results);
		}
		else{
			foreach ($results as $unformattedEntity) {
				$entity = new AbstractEntity($unformattedEntity);
				$entities[] = $entity;
			}
			return $entities;	
		}
	}
	
	/**
	 * 
	 * @param $query
	 * @param array $sort
	 * @return
	 */
	private function addSort($query, array $sort)
	{
	    foreach ($sort as $key => $value)
	    {
	        $query->addSort($key, $value);
	    }
	    return $query;
	}
}