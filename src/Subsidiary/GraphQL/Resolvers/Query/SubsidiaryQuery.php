<?php

declare(strict_types=1);
namespace App\Subsidiary\GraphQL\Resolvers\Query;

use App\Subsidiary\Repository\SubsidiaryRepository;
use App\Subsidiary\Entity\Subsidiary;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Types\ID;

class SubsidiaryQuery
{
    public function __construct(
        private readonly SubsidiaryRepository $subsidiaryRepository
    ) {
    }

    /**
     * @return list<Subsidiary>
     */
    #[Query]
    public function subsidiaries(): array
    {
        return $this->subsidiaryRepository->findAll();
    }

    /**
     * @throws NotFoundHttpException
     */
    #[Query]
    public function subsidiary(ID $subsidiaryID): Subsidiary
    {
        $relation = $this->subsidiaryRepository->find((string) $subsidiaryID);
        if (null === $relation) {
            throw new NotFoundHttpException(sprintf('Subsidiary of Id: %s not found', $subsidiaryID->val()));
        }

        return $relation;
    }
}
