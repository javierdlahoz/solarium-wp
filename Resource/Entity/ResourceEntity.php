<?php

namespace Resource\Entity;

require __DIR__.'/Multiselect/MultiselectEntity.php';
require __DIR__.'/Location/LocationEntity.php';
require __DIR__.'/Date/DateEntity.php';

use Resource\Entity\Multiselect\MultiselectEntity;
use Resource\Entity\Location\LocationEntity;
use Solarium\Entity\AbstractEntity;
use Resource\Entity\Date\DateEntity;

/**
 * @author jdelahoz1      
 */
class ResourceEntity extends AbstractEntity
{
	/**
	 * 
	 * @var LocationEntity
	 */
	private $location;
	
	/**
	 * 
	 * @var DateEntity
	 */
	private $date;
	
	/**
	 * 
	 * @var MultiselectEntity
	 */
	private $type;
	
	/**
	 *
	 * @var MultiselectEntity
	 */
	private $license;
	
	/**
	 *
	 * @var MultiselectEntity
	 */
	private $audience;
	
	/**
	 *
	 * @var MultiselectEntity
	 */
	private $format;
	
	
	/**
	 * 
	 * @param string $title
	 */
	public function setTitle($title){
		$this->setTitleS($title);
	}
	
	/**
	 * @return string
	 */
	public function getTitle(){
		return $this->getTitleS();
	}
	
	/**
	 * 
	 * @param string $description
	 */
	public function setDescription($description){
		$this->setDescriptionS($description);
	}
	
	/**
	 * @return string
	 */
	public function getDescription(){
		return $this->getDescriptionS();
	}
	
	/**
	 * 
	 * @param string $authors
	 */
	public function setAuthors($authors){
		$this->setAuthorsS($authors);
	}
	
	/**
	 * @return string
	 */
	public function getAuthors(){
		return $this->getAuthorsS();
	}
	
	/**
	 * 
	 * @param string $festivalName
	 */
	public function setFestivalName($festivalName){
		$this->setFestivalNameS($festivalName);
	}
	
	/**
	 * @return string
	 */
	public function getFestivalName(){
		return $this->getFestivalNameS();
	}
	
	/**
	 *
	 * @return the LocationEntity
	 */
	public function getLocation() {
		if(empty($this->location)){
			$this->location = new LocationEntity();
			$this->location->setFromString($this->getLocationS());
		}
		
		return $this->location;
	}
	
	/**
	 *
	 * @param LocationEntity $location        	
	 */
	public function setLocation(LocationEntity $location) {
		$this->location = $location;
		$this->setLocationS($location->toString());
	}
	
	/**
	 *
	 * @return the DateEntity
	 */
	public function getDate() {
		if(empty($this->date)){
			$this->date = new DateEntity();
			$this->date->setFromString($this->getDateS());
		}
		return $this->date;
	}
	
	/**
	 *
	 * @param DateEntity $date        	
	 */
	public function setDate(DateEntity $date) {
		$this->date = $date;
		$this->setDateS($date->toString());
	}
	
	/**
	 *
	 * @return the MultiselectEntity
	 */
	public function getType() {
		if(empty($this->type)){
			$this->type = new MultiselectEntity();
			$this->type->setOptions($this->getTypeSs());
		}
		return $this->type;
	}
	
	/**
	 *
	 * @param MultiselectEntity $type        	
	 */
	public function setType(MultiselectEntity $type) {
		$this->type = $type;
		$this->setTypeSs($type->getOptions());
	}
	
	/**
	 *
	 * @return the MultiselectEntity
	 */
	public function getAudience() {
		if(empty($this->audience)){
			$this->audience = new MultiselectEntity();
			$this->audience->setOptions($this->getAudienceSs());
		}
		return $this->audience;
	}
	
	/**
	 *
	 * @param MultiselectEntity $audience        	
	 */
	public function setAudience(MultiselectEntity $audience) {
		$this->audience = $audience;
		$this->setAudienceSs($audience->getOptions());
	}
	
	/**
	 *
	 * @return the MultiselectEntity
	 */
	public function getFormat() {
		if(empty($this->format)){
			$this->format = new MultiselectEntity();
			$this->format->setOptions($this->getFormatSs());
		}
		return $this->format;
	}
	
	/**
	 *
	 * @param MultiselectEntity $format        	
	 */
	public function setFormat(MultiselectEntity $format) {
		$this->format = $format;
		$this->setFormatSs($format->getOptions());
	}
	
	/**
	 *
	 * @return the MultiselectEntity
	 */
	public function getLicense() {
		if(empty($this->license)){
			$this->license = new MultiselectEntity();
			$this->license->setOptions($this->getLicenseSs());
		}
		return $this->license;
	}
	
	/**
	 *
	 * @param MultiselectEntity $licence        	
	 */
	public function setLicense(MultiselectEntity $license) {
		$this->license = $license;
		$this->setLicenseSs($license->getOptions());
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getUrl() {
		return $this->getUrlS();
	}
	
	/**
	 *
	 * @param $url
	 */
	public function setUrl($url) {
		$this->setUrlS($url);
	}	
	

}