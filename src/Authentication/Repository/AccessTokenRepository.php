<?php

namespace App\Authentication\Repository;

use App\Authentication\Entity\AccessToken;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccessTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessToken::class);
    }

    public function findOneByValue(string $token): AccessToken
    {
        $token = $this->findAll()[0];
        assert($token instanceof AccessToken);
        return $token;
    }
    public function createNewToken(): void
    {
        $newToken = new AccessToken(
            'muneer_shafi',
            'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImN',
            'token1',
            ''
        );
        $this->getEntityManager()
            ->persist($newToken);
        $this->getEntityManager()->flush();
        
    }
}
