<?php

namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Snowcap\SiteBundle\Entity\Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Snowcap\SiteBundle\Repository\ProjectRepository")
 */
class Project extends Content
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
	 * @Assert\MinLength(5)
     */
    protected $title;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="slug", type="string", length=255)
	 * @Assert\MinLength(5)
	 */
	protected $slug;
	 
    /**
     * @var text
     *
     * @ORM\Column(name="introduction", type="text")
     */
    protected $introduction;

    /**
     * @var text $body
     *
     * @ORM\Column(name="body", type="text")
     */
    protected $body;

    /**
     * @var datetime
     *
     * @ORM\Column(name="published_at", type="datetime")
     */
    protected $published_at;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    protected $website;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=255)
     */
    protected $client;

    /**
     * @var string
     *
     * @ORM\Column(name="realisation_period", type="string", length=255)
     */
    protected $realisation_period;

    /**
     * @var \Snowcap\SiteBundle\Entity\Agency
     *
     * @ORM\ManyToOne(targetEntity="Agency", inversedBy="projects")
     * @ORM\JoinColumn(name="agency_id", referencedColumnName="id")
     */
    protected $agency;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="projects")
     * @ORM\JoinTable(name="project_tag")
     */
    protected $tags;

    /**
     * @var bool
     *
     * @ORM\Column(name="published", type="boolean")
     */
    protected $published;

    /**
     * @var bool
     *
     * @ORM\Column(name="hidden", type="boolean")
     */
    protected $available_on_list;

    /**
     * @var \Snowcap\SiteBundle\Entity\Image
     *
     * @ORM\OneToOne(targetEntity="Image")
     */
    protected $thumb_recto;

    /**
     * @var \Snowcap\SiteBundle\Entity\Image
     * @ORM\OneToOne(targetEntity="Image")
     */
    protected $thumb_verso;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Image")
     */
    protected $images;

    /**
     * Project constructor
     * Set all properties default value
     */
    public function __construct() {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->published_at = new \DateTime();
        $this->published = true;
        $this->available_on_list = true;
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    /**
     * @param \Snowcap\SiteBundle\Entity\Agency $agency
     * @return void
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * @param $tags
     * @return void
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\Client $client
     * @return void
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\text $introduction
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\text
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * @param DateTime $realisation_period
     * @return void
     */
    public function setRealisationPeriod($realisation_period)
    {
        $this->realisation_period = $realisation_period;
    }

    /**
     * @return DateTime
     */
    public function getRealisationPeriod()
    {
        return $this->realisation_period;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\Image $thumb_recto
     */
    public function setThumbRecto($thumb_recto)
    {
        $this->thumb_recto = $thumb_recto;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Image
     */
    public function getThumbRecto()
    {
        return $this->thumb_recto;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\Image $thumb_verso
     */
    public function setThumbVerso($thumb_verso)
    {
        $this->thumb_verso = $thumb_verso;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Image
     */
    public function getThumbVerso()
    {
        return $this->thumb_verso;
    }

    /**
     * @param boolean $hidden
     */
    public function setAvailableOnList($available_on_list)
    {
        $this->available_on_list = $available_on_list;
    }

    /**
     * @return boolean
     */
    public function isAvailableOnList()
    {
        return $this->available_on_list;
    }
}