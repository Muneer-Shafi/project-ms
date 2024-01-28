<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Repository;

use App\Entity\Post;
use App\GraphQl\Types\Pagination\Cursor;
use App\GraphQl\Types\Pagination\Edge;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class DoctrinePostRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @param positive-int $first
     *
     * @throws \Exception
     *
     * @return list<Edge>
     */
    public function getEdges(int $first, ?Cursor $after): array
    {
        $postQB = $this->createQueryBuilder();

        if (null !== $after) {
            $postQB
                ->select('p')
                ->andWhere('p.id > :cursor')
                ->setParameter('cursor', $after->value)
                ->setMaxResults($first)
                ->getQuery();
        }

        $paginator = new Paginator($postQB);

        $posts = iterator_to_array($paginator->getIterator());

        return array_map(
            function (Post $post): Edge {
                return new Edge($post, new Cursor((string) $post->getId()));
            },
            $posts
        );
    }

    private function createQueryBuilder(): QueryBuilder
    {
        return $this
            ->entityManager
            ->createQueryBuilder()
            ->from(Post::class, 'p')
            ->orderBy('p.id', 'DESC');
    }

    /**
     * @return int<0, max>
     *
     * @psalm-suppress MissingThrowsDocblock
     * Count query will never throw non unique result exception
     */
    public function getTotalCount(): int
    {
        $totalCount = (int) $this
            ->createQueryBuilder()
            ->select('count(distinct p.id)')
            ->getQuery()
            ->getSingleScalarResult();

        \assert($totalCount >= 0);

        return $totalCount;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function startCursor(?Cursor $after): ?Cursor
    {
        $startCursorQB = $this->createQueryBuilder()
            ->select('distinct p.id');
        if (null !== $after) {
            $startCursorQB
                ->andWhere('p.id > :cursor')
                ->setParameter('cursor', $after->value);
        }

        /** @var string|null */
        $id = $startCursorQB->setMaxResults(1)->getQuery()->getOneOrNullResult()['id'] ?? null;

        return null === $id ? null : new Cursor($id);
    }

    /**
     * @param int<0, max> $first
     */
    public function endCursor(int $first, ?Cursor $after): ?Cursor
    {
        $endCursorQb = $this->createQueryBuilder()->select('distinct p.id');
        if (null !== $after) {
            $endCursorQb
                ->andWhere('p.id > :cursor')
                ->setParameter('cursor', $after->value);
        }

        /** @var string|null */
        $lastId = \array_slice($endCursorQb->setMaxResults($first)->getQuery()->getSingleColumnResult(), -1)[0] ?? null;

        return null === $lastId ? null : new Cursor($lastId);
    }

    /**
     * @param int<0, max> $first
     *
     * @psalm-suppress MissingThrowsDocblock
     * Count query will never throw non unique result exception
     */
    public function hasNextPage(int $first, ?Cursor $after): bool
    {
        $hasNextPageQb = $this->createQueryBuilder()->select('count(distinct p.id)');
        if (null !== $after) {
            $hasNextPageQb
                ->andWhere('p.id > :cursor')
                ->setParameter('cursor', $after->value);
        }

        return (int) $hasNextPageQb->getQuery()->getSingleScalarResult() > $first;
    }

    /**
     * @psalm-suppress MissingThrowsDocblock
     * Count query will never throw non unique result exception.
     */
    public function hasPreviousPage(?Cursor $after): bool
    {
        if (null === $after) {
            return false;
        }

        return (int) $this
                ->createQueryBuilder()
                ->select('count(distinct p.id)')
                ->andWhere('p.id < :cursor')
                ->setParameter('cursor', $after->value)
                ->getQuery()
                ->getSingleScalarResult() > 0
        ;
    }
}
