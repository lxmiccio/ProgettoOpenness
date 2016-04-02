<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TaleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaleRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t'
            )
            ->getResult();
    }

    public function findAllOrderedByTitleAsc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleTitle ASC'
            )
            ->getResult();
    }

    public function findAllOrderedByTitleDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleTitle DESC'
            )
            ->getResult();
    }

    public function findAllOrderedByTaleDateAsc()
    {

        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleDate ASC'
            )
            ->getResult();
    }

    public function findAllOrderedByTaleDateDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleDate DESC'
            )
            ->getResult();
    }

    public function findAllOrderedByTaleScoreAsc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleScore ASC'
            )
            ->getResult();
    }

    public function findAllOrderedByTaleScoreDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleScore DESC'
            )
            ->getResult();
    }

    public function findAllOrderedByLikesAsc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, COUNT(t) AS likes
                  FROM AppBundle:Tale t JOIN t.likes l
                  GROUP BY t
                  ORDER BY likes ASC'
            )
            ->getResult();
    }

    public function findAllOrderedByLikesDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, COUNT(t) AS likes
                  FROM AppBundle:Tale t JOIN t.likes l
                  GROUP BY t
                  ORDER BY likes DESC'
            )
            ->getResult();
    }

    public function findAllByUserIdOrderedByTitleAsc($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t JOIN t.user u
                  WHERE u.id = :userId
                  ORDER BY t.taleTitle ASC'
            )
            ->setParameter('userId', $userId)
            ->getResult();
    }

    public function findAllByUserIdOrderedByTaleDateDesc($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t JOIN t.user u
                  WHERE u.id = :userId
                  ORDER BY t.taleDate DESC'
            )
            ->setParameter('userId', $userId)
            ->getResult();
    }

    public function findAllByUserIdOrderedByTaleScoreDesc($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t JOIN t.user u
                  WHERE u.id = :userId
                  ORDER BY t.taleScore DESC'
            )
            ->setParameter('userId', $userId)
            ->getResult();
    }

    public function findAllByUserIdOrderedByLikesDesc($userId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, COUNT(t) AS likes
                  FROM AppBundle:Tale t JOIN t.likes l JOIN t.user u
                  WHERE u.id = :userId
                  GROUP BY t
                  ORDER BY likes DESC'
            )
            ->setParameter('userId', $userId)
            ->getResult();
    }

    public function findAllByGenreIdOrderedByTitleAsc($genreId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t JOIN t.taleGenres tG JOIN tG.genre g
                  WHERE g.id = :genreId
                  ORDER BY t.taleTitle ASC'
            )
            ->setParameter('genreId', $genreId)
            ->getResult();
    }

    public function findAllByGenreIdOrderedByTaleDateDesc($genreId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t JOIN t.taleGenres tG JOIN tG.genre g
                  WHERE g.id = :genreId
                  ORDER BY t.taleDate DESC'
            )
            ->setParameter('genreId', $genreId)
            ->getResult();
    }

    public function findAllByGenreIdOrderedByTaleScoreDesc($genreId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t JOIN t.taleGenres tG JOIN tG.genre g
                  WHERE g.id = :genreId
                  ORDER BY t.taleScore DESC'
            )
            ->setParameter('genreId', $genreId)
            ->getResult();
    }

    public function findAllByGenreIdOrderedByLikesDesc($genreId)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t, COUNT(t) AS likes
                  FROM AppBundle:Tale t JOIN t.likes l JOIN t.taleGenres tG JOIN tG.genre g
                  WHERE g.id = :genreId
                  GROUP BY t
                  ORDER BY likes DESC'
            )
            ->setParameter('genreId', $genreId)
            ->getResult();
    }

    public function findByDateDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleDate DESC'
            )
            ->setMaxResults(1)
            ->getResult();
    }

    public function findByScoreDesc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  ORDER BY t.taleScore DESC'
            )
            ->setMaxResults(1)
            ->getResult();
    }

    public function findByLikesDesc()
    {
        /*return $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t
                  WHERE t.id = :taleId'
            )
            ->setParameter('taleId', $this->getEntityManager()
                ->createQuery(
                    'SELECT t, COUNT(t) AS likes
                      FROM AppBundle:Tale t JOIN t.likes l
                      GROUP BY t
                      ORDER BY likes DESC'
                )
                ->setMaxResults(1)
                ->getSingleResult()[0]
                ->getId()
            )
            ->getResult()[0];
        */

        $tales = $this->getEntityManager()
            ->createQuery(
                'SELECT t
                  FROM AppBundle:Tale t'
            )
            ->getResult();

        foreach ($tales as $tale) {
            if (!isset($result) || $tale->getLikes()->count() > $result->getLikes()->count()) {
                $result = $tale;
            }
        }

        return $result;
    }

    public function deleteById($id)
    {
        $this->getEntityManager()
            ->createQuery(
                'DELETE
                  FROM AppBundle:Tale t
                  WHERE t.id = :id'
            )
            ->setParameter('id', $id)
            ->getResult();
    }
}