<?php
namespace Snowcap\SiteBundle\Repository;

use Snowcap\SiteBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    /**
     * Get the latest blog posts
     *
     * @param int $limit
     * @param string $slug
     *
     * @return array
     */
    public function getLatest($limit, $slug = null)
    {
        if ($slug == null) {
            $dql = "SELECT p
                FROM SnowcapSiteBundle:Post p
                WHERE p.published = true
                ORDER BY p.published_at DESC
            ";
            $query = $this
                ->getEntityManager()
                ->createQuery($dql);
        } else {
            $dql = "SELECT p
                FROM SnowcapSiteBundle:Post p
                INNER JOIN p.category c
                WHERE 
                    p.published = true AND
                    c.slug = :slug
                ORDER BY p.published_at DESC
            ";
            $query = $this
                ->getEntityManager()
                ->createQuery($dql)
                ->setParameter('slug', $slug);
        }
        return $query->setMaxResults($limit)
            ->getResult();
	}
}
