<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(columns={"section_id"}), @ORM\Index(columns={"language_id"})})
 * @ORM\Entity
 */
class Article extends AbstractSection
{
  public function __toString()
  {
    return $this->getTitle() ? $this->getTitle() : "";
  }



    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="rawContent", type="text", nullable=true)
     */
    private $rawContent;

    /**
     * @var string
     *
     * @ORM\Column(name="contentFormatter", type="string", length=255, nullable=true)
     */
    private $contentFormatter;

    /**
     * @ORM\ManyToOne(targetEntity="Section")
     */
    private $section;

    /**
     * @var \Application\Sonata\MediaBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="\Application\Sonata\MediaBundle\Entity\Media")
     */
    private $media;



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
     * Set content
     *
     * @param string $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent($locale='')
    {
        return $this->content;
    }




    /**
     * Set section
     *
     * @param \Softlogo\CMSBundle\Entity\Section $section
     * @return Article
     */
    public function setSection(\Softlogo\CMSBundle\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Softlogo\CMSBundle\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }


    /**
     * Set abstract
     *
     * @param string $abstract
     * @return Article
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }


    /**
     * @var string
     */
    private $rawcontent;

    /**
     * @var string
     */
    private $contentformatter;

    /**
     * @var string
     */
    private $shortcontent;


    /**
     * Set rawcontent
     *
     * @param string $rawcontent
     * @return Article
     */
    public function setRawcontent($rawcontent)
    {
        $this->rawcontent = $rawcontent;

        return $this;
    }

    /**
     * Get rawcontent
     *
     * @return string 
     */
    public function getRawcontent()
    {
        return $this->rawcontent;
    }

    /**
     * Set contentformatter
     *
     * @param string $contentformatter
     * @return Article
     */
    public function setContentformatter($contentformatter)
    {
        $this->contentformatter = $contentformatter;

        return $this;
    }

    /**
     * Get contentformatter
     *
     * @return string 
     */
    public function getContentformatter()
    {
        return $this->contentformatter;
    }

    /**
     * Set shortcontent
     *
     * @param string $shortcontent
     * @return Article
     */
    public function setShortcontent($shortcontent)
    {
        $this->shortcontent = $shortcontent;

        return $this;
    }

    /**
     * Get shortcontent
     *
     * @return string 
     */
    public function getShortcontent()
    {
        return $this->shortcontent;
    }



    /**
     * Set description
     *
     * @param string $description
     * @return Article
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
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return Article
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }

    }
