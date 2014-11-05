<?php

namespace Resource\Entity\Date;

/**
 * @author jdelahoz1       
 */
class DateEntity {
	
	/**
	 * 
	 * @var string
	 */
	private $year;
	
	/**
	 * 
	 * @var string
	 */
	private $month;
	
	/**
	 * 
	 * @var string
	 */
	private $day;
	
	/**
	 * 
	 * @param string $date
	 */
	function __construct($date = null){
		if($date != null){
			$this->setFromString($date);
		}
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getYear() {
		return $this->year;
	}
	
	/**
	 *
	 * @param $year
	 */
	public function setYear($year) {
		$this->year = $year;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getMonth() {
		return $this->month;
	}
	
	/**
	 *
	 * @param $month
	 */
	public function setMonth($month) {
		$this->month = $month;
		return $this;
	}
	
	/**
	 *
	 * @return the string
	 */
	public function getDay() {
		return $this->day;
	}
	
	/**
	 *
	 * @param $day
	 */
	public function setDay($day) {
		$this->day = $day;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function toString(){
		return $this->getMonth()."-".$this->getDay()."-".$this->getYear();
	}
	
	/**
	 * 
	 * @param string $date
	 */
	public function setFromString($date){
		$dateArray = explode("-", $date);
		$this->setMonth($dateArray[0]);
		$this->setDay($dateArray[1]);
		$this->setYear($dateArray[2]);
	}
	
}