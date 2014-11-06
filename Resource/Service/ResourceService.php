<?php

namespace Resource\Service;

use Solarium\Service\AbstractService;
use Solarium\Entity\AbstractEntity;
use Resource\Entity\ResourceEntity;
/**
 *
 * @author jdelahoz1
 *        
 */
class ResourceService extends AbstractService{

	/**
	 * 
	 * @param AbstractEntity $entity
	 * @return \Resource\Entity\ResourceEntity
	 */
	public function toResourceEntity(AbstractEntity $entity)
	{
		$resourceEntity = new ResourceEntity($entity->toArray());
		return $resourceEntity;
	}
	
	/**
	 * 
	 * @param string $expression
	 */
	public function findResourceBy($expression){
		$resultEntity = self::findBy($expression);
		if($resultEntity == null)
		{
			return null;
		}
		return self::toResourceEntity($resultEntity);
	}
}