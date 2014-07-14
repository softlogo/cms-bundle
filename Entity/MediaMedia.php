<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MediaMedia
 */
class MediaMedia
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var string
     */
    private $providerName;

    /**
     * @var integer
     */
    private $providerStatus;

    /**
     * @var string
     */
    private $providerReference;

    /**
     * @var json
     */
    private $providerMetadata;

    /**
     * @var integer
     */
    private $width;

    /**
     * @var integer
     */
    private $height;

    /**
     * @var string
     */
    private $length;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @var integer
     */
    private $contentSize;

    /**
     * @var string
     */
    private $copyright;

    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $context;

    /**
     * @var boolean
     */
    private $cdnIsFlushable;

    /**
     * @var \DateTime
     */
    private $cdnFlushAt;

    /**
     * @var integer
     */
    private $cdnStatus;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     * @return MediaMedia
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
     * @return MediaMedia
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return MediaMedia
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set providerName
     *
     * @param string $providerName
     * @return MediaMedia
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * Get providerName
     *
     * @return string 
     */
    public function getProviderName()
    {
        return $this->providerName;
    }

    /**
     * Set providerStatus
     *
     * @param integer $providerStatus
     * @return MediaMedia
     */
    public function setProviderStatus($providerStatus)
    {
        $this->providerStatus = $providerStatus;

        return $this;
    }

    /**
     * Get providerStatus
     *
     * @return integer 
     */
    public function getProviderStatus()
    {
        return $this->providerStatus;
    }

    /**
     * Set providerReference
     *
     * @param string $providerReference
     * @return MediaMedia
     */
    public function setProviderReference($providerReference)
    {
        $this->providerReference = $providerReference;

        return $this;
    }

    /**
     * Get providerReference
     *
     * @return string 
     */
    public function getProviderReference()
    {
        return $this->providerReference;
    }

    /**
     * Set providerMetadata
     *
     * @param json $providerMetadata
     * @return MediaMedia
     */
    public function setProviderMetadata($providerMetadata)
    {
        $this->providerMetadata = $providerMetadata;

        return $this;
    }

    /**
     * Get providerMetadata
     *
     * @return json 
     */
    public function getProviderMetadata()
    {
        return $this->providerMetadata;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return MediaMedia
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return MediaMedia
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return MediaMedia
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set contentType
     *
     * @param string $contentType
     * @return MediaMedia
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;

        return $this;
    }

    /**
     * Get contentType
     *
     * @return string 
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * Set contentSize
     *
     * @param integer $contentSize
     * @return MediaMedia
     */
    public function setContentSize($contentSize)
    {
        $this->contentSize = $contentSize;

        return $this;
    }

    /**
     * Get contentSize
     *
     * @return integer 
     */
    public function getContentSize()
    {
        return $this->contentSize;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return MediaMedia
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string 
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set authorName
     *
     * @param string $authorName
     * @return MediaMedia
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get authorName
     *
     * @return string 
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set context
     *
     * @param string $context
     * @return MediaMedia
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string 
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set cdnIsFlushable
     *
     * @param boolean $cdnIsFlushable
     * @return MediaMedia
     */
    public function setCdnIsFlushable($cdnIsFlushable)
    {
        $this->cdnIsFlushable = $cdnIsFlushable;

        return $this;
    }

    /**
     * Get cdnIsFlushable
     *
     * @return boolean 
     */
    public function getCdnIsFlushable()
    {
        return $this->cdnIsFlushable;
    }

    /**
     * Set cdnFlushAt
     *
     * @param \DateTime $cdnFlushAt
     * @return MediaMedia
     */
    public function setCdnFlushAt($cdnFlushAt)
    {
        $this->cdnFlushAt = $cdnFlushAt;

        return $this;
    }

    /**
     * Get cdnFlushAt
     *
     * @return \DateTime 
     */
    public function getCdnFlushAt()
    {
        return $this->cdnFlushAt;
    }

    /**
     * Set cdnStatus
     *
     * @param integer $cdnStatus
     * @return MediaMedia
     */
    public function setCdnStatus($cdnStatus)
    {
        $this->cdnStatus = $cdnStatus;

        return $this;
    }

    /**
     * Get cdnStatus
     *
     * @return integer 
     */
    public function getCdnStatus()
    {
        return $this->cdnStatus;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return MediaMedia
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MediaMedia
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
