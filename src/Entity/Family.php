<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @ORM\Table(name="family")
 */
class Family {
	
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
     * One Family has One Group.
     * @ORM\OneToOne(targetEntity="Group", mappedBy="family")
     */
    private $group;
  
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