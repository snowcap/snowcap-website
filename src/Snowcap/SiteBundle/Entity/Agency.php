<?php
namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Snowcap\SiteBundle\Model\Base as BaseModel;

/**
 * Agency entity class
 *
 * @ORM\Table(name="agency")
 * @ORM\Entity
 */
class Agency extends BaseModel
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
     * @ORM\Column(name="website", type="string", length=255)
     */
    private $website;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Project", mappedBy="agency")
     */
    private $projects;

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