<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @author mrhieusd
 * @ORM\Entity(repositoryClass="\Application\Repository\StockRepository")
 * @ORM\Table(name="stock_news",options={"collate"="utf8_unicode_ci", "charset"="utf8"}))
 */
class Stocknews
{
	/**
	* @ORM\Id
	* @ORM\Column(name="id")
	*/
	protected $id;
	/**
	* @ORM\Column(name="stockId")
	*/
	protected $stockId;
	/**
	* @ORM\Column(name="title")
	*/
	protected $title;
	/**
	* @ORM\Column(name="content")
	*/
	protected $content;
	/**
	* @ORM\Column(name="date")
	*/
	protected $date;
	public function getId(){
		return $this->id;
	}

	public function getStockId(){
		return $this->stockId;
	}

	public function getTitle(){
		return $this->title;
	}
	public function getContent(){
		return $this->content;
	}
	public function getDate(){
		return $this->date;
	}

	
}