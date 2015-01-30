<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="dictionary")
 * @ORM\Entity(repositoryClass="Softlogo\CMSBundle\Repository\DictionaryRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"parameter" = "Parameter", "dictionary" = "Dictionary", "site" = "Site"})
 */
class Dictionary
{

	public function castToClass($class, $object)
	{
		return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
	}
	public function __toString()
	{
		return $this->getName() ? $this->getName() : "";
	}
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="is_main", type="boolean", nullable=false, options={"default" = true})
	 */
	private $isMain;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="itemorder", type="integer", nullable=true)
     */
    private $itemorder;

    /**
     * @ORM\ManyToOne(targetEntity="Dictionary")
     */
    private $dictionary;

	/**
	 * @var \Dictionary
	 *
	 * @ORM\OneToMany(targetEntity="Dictionary", mappedBy="dictionary",cascade={"all"}, orphanRemoval=true)
	 * @ORM\OrderBy({"itemorder" = "ASC"})
	 */

	private $dictionaries;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
	}
    /**
     * Set name
     *
     * @param string $name
     * @return Dictionary
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }   

    /**
     * Set description
     *
     * @param string $description
     * @return Dictionary
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set itemorder
     *
     * @param integer $itemorder
     * @return Dictionary
     */
    public function setItemorder($itemorder)
    {
        $this->itemorder = $itemorder;

        return $this;
    }

    /**
     * Get itemorder
     *
     * @return integer 
     */
    public function getItemorder()
    {
        return $this->itemorder;
    }


    /**
     * Set value
     *
     * @param string $value
     * @return Dictionary
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set dictionary
     *
     * @param \Softlogo\CMSBundle\Entity\Dictionary $dictionary
     * @return Dictionary
     */
    public function setDictionary(\Softlogo\CMSBundle\Entity\Dictionary $dictionary = null)
    {
        $this->dictionary = $dictionary;

        return $this;
    }

    /**
     * Get dictionary
     *
     * @return \Softlogo\CMSBundle\Entity\Dictionary 
     */
    public function getDictionary()
    {
        return $this->dictionary;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
		$this->isMain=true;
        $this->dictionaries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dictionaries
     *
     * @param \Softlogo\CMSBundle\Entity\Dictionary $dictionaries
     * @return Dictionary
     */
    public function addDictionary(\Softlogo\CMSBundle\Entity\Dictionary $dictionaries)
    {
		$dictionaryClass=get_class($this);
		//$dictionaryClass=$this->getName();
		$dictionary=new $dictionaryClass();
		$dictionary->setDictionary($this);
		$dictionary->setIsMain(false);
        $this->dictionaries[] =$dictionary;

        return $this;
    }

    /**
     * Remove dictionaries
     *
     * @param \Softlogo\CMSBundle\Entity\Dictionary $dictionaries
     */
    public function removeDictionary(\Softlogo\CMSBundle\Entity\Dictionary $dictionaries)
    {
        $this->dictionaries->removeElement($dictionaries);
    }

    /**
     * Get dictionaries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDictionaries()
    {
        return $this->dictionaries;
    }

    /**
     * Set isMain
     *
     * @param boolean $isMain
     * @return Dictionary
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;

        return $this;
    }

    /**
     * Get isMain
     *
     * @return boolean 
     */
    public function getIsMain()
    {
        return $this->isMain;
    }
}
