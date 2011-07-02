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
				FROM Snowcap\SiteBundle\Entity\Post p
				ORDER BY p.published_at DESC
			')
			->setMaxResults($limit)
			->getResult();
	}
}
