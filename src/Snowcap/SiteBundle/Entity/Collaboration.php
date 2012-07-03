<?php
namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use
    Snowcap\SiteBundle\Model\Base as BaseModel,
    Snowcap\SiteBundle\Entity\Project,
    Snowcap\SiteBundle\Entity\Agency;

/**
 * Collaboration entity class
 *
 * @ORM\Table(name="collaboration")
 * @ORM\Entity
 */
class Collaboration extends BaseModel
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
     * @var \Snowcap\SiteBundle\Entity\Project
     *
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="collaborations")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;

    /**
     * @var \Snowcap\SiteBundle\Entity\Agency
     *
     * @ORM\ManyToOne(targetEntity="Agency")
     * @ORM\JoinColumn(name="agency_id", referencedColumnName="id")
     */
    protected $agency;

    /**
     * @var string
     *
     * @ORM\Column(name="field", type="string")
     */
    protected $field;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\Project $project
     */
    public function setProject(Project $project)
    {
        $this->project = $project;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\Agency $agency
     */
    public function setAgency(Agency $agency)
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
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }
    

}