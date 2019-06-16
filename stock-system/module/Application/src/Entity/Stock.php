<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @author mrhieusd
 * @ORM\Entity(repositoryClass="\Application\Repository\StockRepository")
 * @ORM\Table(name="stock",options={"collate"="utf8_unicode_ci", "charset"="utf8"}))
 */
class Stock
{
	/**
	* @ORM\Id
	* @ORM\Column(name="stockId")
	*/
	protected $stockId;
	/**
	* @ORM\Column(name="name")
	*/
	protected $name;
	/**
	* @ORM\Column(name="trend")
	*/
	protected $trend;
	
	public function getStockId(){
		return $this->stockId;
	}

	public function getName(){
		return $this->name;
	}

	public function getTrend(){
		return $this->trend;
	}
}