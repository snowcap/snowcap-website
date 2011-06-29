<?php

namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Snowcap\SiteBundle\Entity\Post
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Post
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
	 * @Assert\MinLength(5)
     */
    private $title;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="slug", type="string", length=255)
	 * @Assert\MinLength(5)
	 */
	private $slug;
	 
    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var datetime $published_at
     *
     * @ORM\Column(name="published_at", type="datetime")
     */
    private $published_at;


    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
	
	/**
	 * Set slug
	 * 
	 * @param string s$lug
	 */
	public function setSlug($slug)
	{
		$this->slug = $slug;	
	}
	
	/**
	 * Get slug
	 * 
	 * @return string
	 */
	public function getSlug()
	{
		return $this->slug;
	}
	
    /**
     * Set body
     *
     * @param text $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return text $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set published_at
     *
     * @param datetime $publishedAt
     */
    public function setPublishedAt($publishedAt)
    {
        $this->published_at = $publishedAt;
    }

    /**
     * Get published_at
     *
     * @return datetime $publishedAt
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }
}