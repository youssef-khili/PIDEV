<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Rating;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class RatingRepository
 * @package App\Repository
 */
final class RatingRepository extends ServiceEntityRepository implements Repository
{
    /**
     * BlockRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }

    /**
     * @param int $id
     *
     * @return Rating|object
     */
    public function load(int $id): Rating
    {
        if (null === ($rating = $this->find($id))) {
            throw new NotFoundHttpException(sprintf('Rating not found with given Id %s.', $id));
        }

        return $rating;
    }

    /**
     * @param int $contentId
     *
     * @return Rating
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(int $contentId): Rating
    {
        if (null === ($rating = $this->findOneByContentId($contentId))) {
            $rating = (new Rating())->setContentId($contentId);
            $this->_em->persist($rating);
            $this->_em->flush($rating);
            $this->_em->refresh($rating);
        }

        return $rating;
    }
}
