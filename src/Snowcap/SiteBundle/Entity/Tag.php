<?php
namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use
    Snowcap\SiteBundle\Model\Base as BaseModel;

/**
 * Tag entity class
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag extends BaseModel
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    private $posts;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="tags")
     */
    private $projects;

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
     * Set posts
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $posts
     */
    public function setPosts(ArrayCollection $posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\ArrayCollection|ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set projects
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $projects
     */
    public function setProjects(ArrayCollection $projects)
    {
        $this->projects = $projects;
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getProjects()
    {
        return $this->projects;
    }
}