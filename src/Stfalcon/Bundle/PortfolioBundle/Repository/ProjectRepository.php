<?php

namespace Stfalcon\Bundle\PortfolioBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Stfalcon\Bundle\PortfolioBundle\Entity\Category;

/**
 * Project Repository
 */
class ProjectRepository extends EntityRepository
{

    /**
     * Get query for select projects by category
     *
     * @param Category $category
     * @param string   $orderBy
     * @param string   $orderDirection
     *
     * @return Query
     */
    public function getQueryForSelectProjectsByCategory(Category $category, $orderBy = 'p.date', $orderDirection = 'DESC')
    {
        $qb = $this->getQueryBuilderWithOrdering($orderBy, $orderDirection);

        return $qb->join('p.categories', 'c')
                ->where('c.id = :category')
                ->setParameter('category', $category->getId())
                ->getQuery();
    }

    /**
     * Get all projects from this category
     *
     * @param Category $category       A category object
     * @param string   $orderBy        order by field
     * @param string   $orderDirection order direction
     *
     * @return array
     */
    public function getProjectsByCategory(Category $category, $orderBy = 'p.date', $orderDirection = 'DESC')
    {
        return $this->getQueryForSelectProjectsByCategory($category, $orderBy, $orderDirection)
                ->getResult();
    }

    /**
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getQueryBuilderWithOrdering($orderBy = 'p.date', $orderDirection = 'ASC')
    {
        return $this->createQueryBuilder('p')
            ->orderBy($orderBy, $orderDirection);
    }

    /**
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return Query
     */
    public function findAllProjectsOrderingByDateAsQuery($orderBy = 'p.date', $orderDirection = 'DESC')
    {
        return $this->getQueryBuilderWithOrdering($orderBy, $orderDirection)
            ->getQuery();
    }

    /**
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return array
     */
    public function findAllProjectsOrderingByDate($orderBy = 'p.date', $orderDirection = 'ASC')
    {
        return $this->findAllProjectsOrderingByDateAsQuery($orderBy, $orderDirection)
            ->getResult();
    }

    /**
     * @param string $orderBy
     * @param string $orderDirection
     *
     * @return array
     */
    public function findProjectsForHomePage($orderBy = 'p.date', $orderDirection = 'DESC')
    {
        $qb = $this->getQueryBuilderWithOrdering($orderBy, $orderDirection);

        return $qb->where('p.onFrontPage = :onFrontPage')
            ->setParameter('onFrontPage', true)
            ->getQuery()
            ->getResult();
    }
}