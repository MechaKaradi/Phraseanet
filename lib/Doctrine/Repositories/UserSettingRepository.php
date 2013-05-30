<?php

namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * UserSettingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserSettingRepository extends EntityRepository
{
    public function find($id)
    {
        $dql = 'SELECT f FROM Entities\FeedEntry f
                WHERE f.id = :id ';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findByFeed($feed, $id)
    {
        $dql = 'SELECT f FROM Entities\FeedEntry f
                WHERE f.id = :id AND f.feed = :feed';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('id', $id);
        $query->setParameter('feed', $feed);

        return $query->getOneOrNullResult();
    }

    public function findByFeeds($feeds, $offset_start = null, $how_many = null)
    {
        $dql = 'SELECT f FROM Entities\FeedEntry f
                WHERE f.feed IN (:feeds)';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('feeds', $feeds);

        if (null !== $offset_start) {
            $query->setFirstResult($offset_start);
        }
        if (null !== $how_many) {
            $query->setMaxResults($how_many);
        }

        return $query->getResult();
    }
}
