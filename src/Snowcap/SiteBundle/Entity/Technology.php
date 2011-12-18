<?php

namespace Snowcap\SiteBundle\Entity;

use
    Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use
    Snowcap\SiteBundle\Model\Base as BaseModel;

/**
 * Technology entity class
 *
 * @ORM\Table(name="technology")
 * @ORM\Entity
 */
class Technology extends BaseModel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     */
    protected $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var  string
     *
     * @ORM\Column(name="website", type="string", length=255)
     */
    protected $website;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="technologies")
     */
    protected $projects;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="technologies")
     */
    protected $posts;

    /**
     * @var bool
     *
     * @ORM\Column(name="highlight", type="boolean")
     */
    protected $highlight;

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
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
     * Set Posts
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $posts
     */
    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get Posts
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set Projects
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $projects
     */
    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;
    }

    /**
     * Get Projects
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $highlight
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;
    }

    /**
     * @return string
     */
    public function getHighlight()
    {
        return $this->highlight;
    }
}