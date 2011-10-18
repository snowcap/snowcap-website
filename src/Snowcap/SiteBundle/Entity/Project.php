<?php
namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constraints as Assert;

use Snowcap\SiteBundle\Model\Base as BaseModel,
    Snowcap\SiteBundle\Entity\Agency,
    Snowcap\SiteBundle\Entity\Image;


/**
 * Project entity class
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="Snowcap\SiteBundle\Repository\ProjectRepository")
 */
class Project extends BaseModel
{
    /**
     * @var int
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
     * @var string
     *
     * @ORM\Column(name="introduction", type="text")
     */
    protected $introduction;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    protected $body;

    /**
     * @var \DateTime
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
     * @ORM\ManyToMany(targetEntity="Technology", inversedBy="projects")
     * @ORM\JoinTable(name="project_technology")
     */
    protected $technologies;

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
     * @ORM\ManyToOne(targetEntity="Image")
     */
    protected $thumb_front;

    /**
     * @var \Snowcap\SiteBundle\Entity\Image
     *
     * @ORM\ManyToOne(targetEntity="Image")
     */
    protected $thumb_back;

    /**
     * @var bool
     *
     * @ORM\Column(name="highlighted", type="boolean")
     */
    protected $highlighted;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Image")
     * @ORM\JoinTable(name="project_image")
     */
    protected $images;

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        $this->technologies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->published_at = new \DateTime();
        $this->published = true;
        $this->available_on_list = true;
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
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
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
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
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set published_at
     *
     * @param \DateTime $publishedAt
     */
    public function setPublishedAt(\DateTime $publishedAt)
    {
        $this->published_at = $publishedAt;
    }

    /**
     * Get published_at
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * Set agency
     *
     * @param \Snowcap\SiteBundle\Entity\Agency $agency
     */
    public function setAgency(Agency $agency)
    {
        $this->agency = $agency;
    }

    /**
     * Get agency
     *
     * @return \Snowcap\SiteBundle\Entity\Agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * Set client
     *
     * @param string $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Get client
     *
     * @return string
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set introduction
     *
     * @param string $introduction
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;
    }

    /**
     * Get introduction
     *
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Set realisation_period
     *
     * @param string $realisation_period
     */
    public function setRealisationPeriod($realisation_period)
    {
        $this->realisation_period = $realisation_period;
    }

    /**
     * Get realisation_period
     *
     * @return string
     */
    public function getRealisationPeriod()
    {
        return $this->realisation_period;
    }

    /**
     * Set website
     *
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set published
     *
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Is published
     *
     * @return boolean
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * Set imahes
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $images
     */
    public function setImages(ArrayCollection $images)
    {
        $this->images = $images;
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set thumb_front
     *
     * @param \Snowcap\SiteBundle\Entity\Image $thumb_front
     */
    public function setThumbFront(Image $thumb_front)
    {
        $this->thumb_front = $thumb_front;
    }

    /**
     * Get thumb_front
     *
     * @return \Snowcap\SiteBundle\Entity\Image
     */
    public function getThumbFront()
    {
        return $this->thumb_front;
    }

    /**
     * Set thumb_back
     *
     * @param \Snowcap\SiteBundle\Entity\Image $thumb_back
     */
    public function setThumbBack(Image $thumb_back)
    {
        $this->thumb_back = $thumb_back;
    }

    /**
     * Get thumb_back
     *
     * @return \Snowcap\SiteBundle\Entity\Image
     */
    public function getThumbBack()
    {
        return $this->thumb_back;
    }

    /**
     * Set available_on_list
     *
     * @param bool $available_on_list
     */
    public function setAvailableOnList($available_on_list)
    {
        $this->available_on_list = $available_on_list;
    }

    /**
     * Is available_on_list
     *
     * @return bool
     */
    public function isAvailableOnList()
    {
        return $this->available_on_list;
    }

    /**
     * @param bool $highlighted
     */
    public function setHighlighted($highlighted)
    {
        $this->highlighted = $highlighted;
    }

    /**
     * @return bool
     */
    public function isHighlighted()
    {
        return $this->highlighted;
    }

    /**
     * Set Technologies
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $technologies
     */
    public function setTechnologies(ArrayCollection $technologies)
    {
        $this->technologies = $technologies;
    }

    /**
     * Get Technologies
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getTechnologies()
    {
        return $this->technologies;
    }
}