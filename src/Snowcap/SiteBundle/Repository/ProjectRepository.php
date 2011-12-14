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
	public function getList($limit, $highlighted = null, $availableOnList = null, $exclude = array())
	{
		$queryBuilder = $this
			->getEntityManager()
            ->createQueryBuilder()
            ->select('p')
            ->from('SnowcapSiteBundle:Project', 'p')
            ->where('p.published = true')
            ->orderBy('p.published_at', 'DESC')
            ->setMaxResults($limit);
        if($highlighted !== null) {
            $queryBuilder->andWhere('p.highlighted = :highlighted');
            $queryBuilder->setParameter('highlighted', $highlighted);
        }
        if($availableOnList !== null) {
            $queryBuilder->andWhere('p.available_on_list = :available_on_list');
            $queryBuilder->setParameter('available_on_list', $availableOnList);
        }
        if(count($exclude) > 0) {
            $queryBuilder->andWhere($queryBuilder->expr()->notIn('p.id', $exclude));
        }
		return $queryBuilder->getQuery()->getResult();
	}
}
