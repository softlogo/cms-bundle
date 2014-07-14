<?php

namespace Softlogo\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="IDX_23A0E66C4663E4", columns={"section_id"}), @ORM\Index(name="fk_article_1_idx", columns={"language_id"})})
 * @ORM\Entity
 */
class Article
{
  public function __toString()
  {
    return $this->getTitle() ? $this->getTitle() : "";
  }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="itemorder", type="integer", nullable=true)
     */
    private $itemorder;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="shortContent", type="text", nullable=true)
     */

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Section")
     */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity="Page")
     */
    private $page;
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
     * @var \ArticleType
     *
     * @ORM\ManyToOne(targetEntity="ArticleType")
     */
    private $type;


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
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Article
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Article
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
     * Set page
     *
     * @param \Softlogo\CMSBundle\Entity\Page $page
     * @return Article
     */
    public function setPage(\Softlogo\CMSBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Softlogo\CMSBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set itemorder
     *
     * @param integer $itemorder
     * @return Article
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
     * Set type
     *
     * @param \Softlogo\CMSBundle\Entity\ArticleType $type
     * @return Article
     */
    public function setType(\Softlogo\CMSBundle\Entity\ArticleType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Softlogo\CMSBundle\Entity\ArticleType 
     */
    public function getType()
    {
        return $this->type;
    }
}
