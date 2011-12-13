<?php
namespace Snowcap\SiteBundle\Repository;

use Snowcap\SiteBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
	/**
	 * Get the latest blog posts
	 * 
	 * @return array
	 */
	public function getLatest($limit)
	{
		return $this
			->getEntityManager()
			->createQuery('
				SELECT p
				FROM SnowcapSiteBundle:Post p
				WHERE p.published = true
				ORDER BY p.published_at DESC
			')
			->setMaxResults($limit)
			->getResult();
	}
}
