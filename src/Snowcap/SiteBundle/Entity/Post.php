<?php
namespace Snowcap\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection,
    Symfony\Component\Validator\Constraints as Assert;

use Snowcap\SiteBundle\Model\Base as BaseModel;

/**
 * Post entity class
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Snowcap\SiteBundle\Repository\PostRepository")
 */
class Post extends BaseModel
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
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @var \Snowcap\SiteBundle\Entity\PostCategory
     *
     * @ORM\ManyToOne(targetEntity="PostCategory", inversedBy="posts")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    protected $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    protected $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="published_at", type="datetime")
     */
    protected $published_at;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Technology", inversedBy="posts")
     * @ORM\JoinTable(name="post_technology")
     */
    protected $technologies;

    /**
     * @var \Snowcap\SiteBundle\Entity\Image
     *
     * @ORM\ManyToOne(targetEntity="Image")
     */
    protected $thumb;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Image")
     */
    protected $images;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     */
    protected $comments;

    /**
    * @var bool
    *
    * @ORM\Column(name="published", type="boolean")
    */
   protected $published;

    /**
     * @var string
     *
     * @ORM\Column("meta_title", type="string", length="255", nullable=true)
     */
    protected $meta_title;
    /**
     * @var string
     *
     * @ORM\Column("meta_description", type="string", length="255", nullable=true)
     */
    protected $meta_description;
    /**
     * @var string
     *
     * @ORM\Column("meta_keywords", type="string", length="255", nullable=true)
     */
    protected $meta_keywords;

    /**
     * Class constructor
     * 
     */
    public function __construct()
    {
        $this->technologies = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->published_at = new \DateTime();
        $this->published = true;
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
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
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

    /**
     * Set Category
     *
     * @param \Snowcap\SiteBundle\Entity\PostCategory $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Get Category
     *
     * @return \Snowcap\SiteBundle\Entity\PostCategory
     */
    public function getCategory()
    {
        return $this->category;
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
     * @param \Snowcap\SiteBundle\Entity\Image $thumb
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    /**
     * @return \Snowcap\SiteBundle\Entity\Image
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getValidComments()
    {
        $comments = $this->comments;
        foreach($comments as $key => $comment) {
            if(!$comment->published) {
                $comments->remove($key);
            }
        }
        return $comments;
    }

    /**
     * @param bool $published
     */
    public function setPublished($published) {
        $this->published = $published;
    }

    /**
     * @return bool
     */
    public function getPublished() {
        return $this->published;
    }
    
    /**
     * @param string $meta_description
     */
    public function setMetaDescription($meta_description)
    {
        $this->meta_description = $meta_description;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return ($this->meta_description != null ?: $this->summary);
    }

    /**
     * @param string $meta_keywords
     */
    public function setMetaKeywords($meta_keywords)
    {
        $this->meta_keywords = $meta_keywords;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return ($this->meta_keywords != null ?: $this->getCategory()->getName());
    }

    /**
     * @param string $meta_title
     */
    public function setMetaTitle($meta_title)
    {
        $this->meta_title = $meta_title;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return ($this->meta_title != null ?: $this->title);
    }
}