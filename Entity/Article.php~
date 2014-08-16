<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="IDX_23A0E66C4663E4", columns={"section_id"}), @ORM\Index(name="fk_article_1_idx", columns={"language_id"})})
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
     * @ORM\ManyToOne(targetEntity="Section")
     */
    private $section;
    /**
     * @var \Language
     *
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;



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
    public function getContent()
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
     * Set language
     *
     * @param \Softlogo\CMSBundle\Entity\Language $language
     * @return Article
     */
    public function setLanguage(\Softlogo\CMSBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Softlogo\CMSBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
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
}
