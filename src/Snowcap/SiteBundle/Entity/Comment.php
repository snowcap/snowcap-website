<?php
namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constraints as Assert;

use Snowcap\SiteBundle\Model\Base as BaseModel;

/**
 * Comment entity class
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="Snowcap\SiteBundle\Repository\CommentRepository")
 */
class Comment extends BaseModel
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank()
     */
    protected $body;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime")
     */
    protected $published_at;

    /**
     * @var \Snowcap\SiteBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    private $post;

    /**
    * @var bool
    *
    * @ORM\Column(name="published", type="boolean")
    */
   protected $published;


    /**
     * Class constructor
     * 
     */
    public function __construct()
    {
        $this->published_at = new \DateTime();
        $this->published = 1;
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
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \DateTime $published_at
     */
    public function setPublishedAt($published_at)
    {
        $this->published_at = $published_at;
    }

    /**
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * @param \Snowcap\SiteBundle\Entity\Post $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
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
    public function getPublished()
    {
        return $this->published;
    }


}