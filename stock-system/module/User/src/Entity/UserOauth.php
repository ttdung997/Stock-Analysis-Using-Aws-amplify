<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="bkcs_oauth_token")
 */
class UserOauth 
{
    // User status constants.
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="userId")  
     */
    protected $userId;
    
    /** 
     * @ORM\Column(name="token")  
     */
    protected $token;

   
     /** 
     * @ORM\Column(name="date")  
     */
    protected $date;
   
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets user ID. 
     * @param int $id    
     */
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * Returns userId.     
     * @return int
     */
    public function getUserId() 
    {
        return $this->$userId;
    }

    /**
     * Sets userId.     
     * @param int $userId
     */
    public function setUserId($userId) 
    {
        $this->userId = $userId;
    }
    
    /**
     * Returns token.
     * @return string     
     */
    public function getToken() 
    {
        return $this->token;
    }       

    /**
     * Sets token.
     * @param string $token
     */
    public function setToken($token) 
    {
        $this->token = $token;
    }
    /**
     * Returns date.
     * @return datetime     
     */
    public function getDate() 
    {
        return $this->date;
    }   
     /**
     * Sets date.
     * @param datetime $date
     */
    public function setDate($date) 
    {
        $this->date = $date;
    }
   
}



