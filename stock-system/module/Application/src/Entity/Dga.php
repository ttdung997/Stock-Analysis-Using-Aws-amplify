<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @author mrhieusd
 * @ORM\Entity(repositoryClass="\Application\Repository\DgaRepository")
 * @ORM\Table(name="bkcs_dga_domain")
 */
class Dga
{
	/**
	* @ORM\Id
	* @ORM\Column(name="id")
	* @ORM\GeneratedValue
	*/
	protected $id;
	/**
	* @ORM\Column(name="client_ip")
	*/
	protected $client_ip;
	/**
	* @ORM\Column(name="domain")
	*/
	protected $domain;
	/**
	* @ORM\Column(name="malware_id")
	*/
	protected $malware_id;
	/**
	* @ORM\Column(name="response")
	*/
	protected $response;
	/**
	* @ORM\Column(name="requested_time")
	*/
	protected $requested_time;
    /**
	* @ORM\Column(name="status")
	*/
	protected $status;
	/**
	* @ORM\Column(name="created_time")
	*/
	protected $created_time;

	public function getId(){
		return $this->id;
	}

	public function getClientIp(){
		return $this->client_ip;
	}

	public function getDomain(){
		return $this->domain;
	}
	public function getResponsedns(){
		return $this->response;
	}
	public function getRequestedTime(){
		return $this->requested_time;
	}

	public function getCreatedTime(){
		return $this->created_time;
	}
	public function getStatus(){
		return $this->status;
	}
	public function getMalwarename(){
		$malwareList = ['geodo','beebone', 'murofet', 'pykspa',  'padcrypt','ramnit','Volatile','ranbyus','qakbot','simda', 'ramdo', 'suppobox',  'locky','tempedreve', 'qadars', 'symmi', 'banjori', 'tinba','hesperbot', 'fobber',  'dyre', 'cryptowall','corebot','P', 'bedep', 'matsnu', 'ptgoz', 'necurs', 'pushdo', 'cryptolocker', 'dircrypt', 'shifu', 'bamital', 'kraken', 'nymaim', 'shiotob', 'virut'];
		return $malwareList[$this->malware_id];
	}
}