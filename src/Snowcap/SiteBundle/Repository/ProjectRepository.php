<?php
namespace Snowcap\SiteBundle\Repository;

use Snowcap\SiteBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

class ProjectRepository extends EntityRepository
{
	/**
	 * Get the latest projects
	 * 
	 * @return array
	 */
	public function getLatest($limit)
	{
		return $this
			->getEntityManager()
			->createQuery('
				SELECT p
				FROM SnowcapSiteBundle:Project p
				ORDER BY p.published_at DESC
			')
			->setMaxResults($limit)
			->getResult();
	}
}
