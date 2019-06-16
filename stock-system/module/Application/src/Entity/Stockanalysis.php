<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @author mrhieusd
 * @ORM\Entity(repositoryClass="\Application\Repository\StockRepository")
 * @ORM\Table(name="stock_analysis",options={"collate"="utf8_unicode_ci", "charset"="utf8"}))
 */
class Stockanalysis
{
	/**
	* @ORM\Id
	* @ORM\Column(name="stockId")
	*/
	protected $stockId;
	/**
	* @ORM\Column(name="graph")
	*/
	protected $graph;
	/**
	* @ORM\Column(name="news")
	*/
	protected $news;
	/**
	* @ORM\Column(name="report")
	*/
	protected $report;
	
	public function getStockId(){
		return $this->stockId;
	}

	public function getGraphHtml(){
		return $this->graph;
	}

	public function getNewsHtml(){
		return $this->news;
	}

	public function getReportHtml(){
		return $this->report;
	}
}