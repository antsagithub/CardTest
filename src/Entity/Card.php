<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="card")
 */
class Card {
	
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	private $id;
  
	/**
	* @ORM\Column(type="string", length=100)
	* @Assert\NotBlank()
	*
	*/
	private $name;
  
	/**
	* @ORM\Column(type="text")
	* @Assert\NotBlank()
	*/
	private $description;
	
	/**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="card_group",
     *      joinColumns={@ORM\JoinColumn(name="card_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id", unique=false)}
     *      )
     */
    private $groups;
	
	
	public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }
  
	/**
	* @return mixed
	*/
	public function getId()
	{
		return $this->id;
	}
  
	/**
	* @param mixed $id
	*/
	public function setId($id)
	{
		$this->id = $id;
	}
  
	/**
	* @return mixed
	*/
	public function getName()
	{
		return $this->name;
	}
  
	/**
	* @param mixed $name
	*/
	public function setName($name)
	{
		if (\strlen($name) < 5) {
			throw new \InvalidArgumentException('Name needs to have more than 5 characters.');
		}
		$this->name = $name;
	}
	
	/**
	* @return mixed
	*/
	public function getDescription()
	{
		return $this->description;
	}
  
	/**
	* @param mixed $description
	*/
	public function setDescription($description)
	{
		if (\strlen($description) < 10) {
			throw new \InvalidArgumentException('Descriptions needs to have more than 10 characters.');
		}
		$this->description = $description;
	}
}