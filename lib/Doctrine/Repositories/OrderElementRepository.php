<?php

namespace Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * OrderElementRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderElementRepository extends EntityRepository
{
    public function find($id)
    {
        $dql = 'SELECT f FROM Entities\FeedPublisher f
                WHERE f.id = :id ';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findByUser(\Entities\Feed $feed, \User_Adapter $user)
    {
        $dql = 'SELECT f FROM Entities\FeedPublisher f
                WHERE f.usr_id = :usrId AND f.feed = :feed';

        $query = $this->_em->createQuery($dql);
        $query->setParameter('usrId', $user->get_id());
        $query->setParameter('feed', $feed);

        return $query->getOneOrNullResult();
    }
}
