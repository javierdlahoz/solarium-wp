<?php

namespace Resource\Entity\Multiselect;

class MultiselectEntity
{
	
	/**
	 * 
	 * @var array
	 */
	private $options;
	
	/**
	 * 
	 * @param array $options
	 */
	function __construct($options = null){
		if($options == null){
			$this->options = array();
		}
		else{
			$this->setOptions($options);
		}
	}
	
	/**
	 *
	 * @return the array
	 */
	public function getOptions() {
		return $this->options;
	}
	
	/**
	 *
	 * @param array $options        	
	 */
	public function setOptions(array $options) {
		$this->options = $options;
		return $this;
	}
	
	/**
	 * 
	 * @param string $option
	 */
	public function addOption($option){
		$this->options = array_merge($this->options, array($option));
	}

	/**
	 * clears the options array
	 */
	public function clearOptions(){
		$this->options = array();
	}
	
}