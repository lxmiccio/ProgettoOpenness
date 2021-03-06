<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GenreRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GenreRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT g
                  FROM AppBundle:Genre g'
            )
            ->getResult();
    }

    public function findAllOrderedByGenreDescriptionAsc()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT g
                  FROM AppBundle:Genre g
                  ORDER BY g.genreDescription ASC'
            )
            ->getResult();
    }
}
