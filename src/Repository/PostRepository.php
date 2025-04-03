<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

	public function getAllPublished(): array {
	$queryBuilder = $this
			->createQueryBuilder(alias : "p")
			->where("p.publishat <= :now")
			->setParameter(key: "now", value: new \DateTime(), type: Types::DATETIME_MUTABLE)
			->orderBy("p.publishat", order: "DESC");

	return $queryBuilder
		->getQuery()
		->getResult();
	}
}
