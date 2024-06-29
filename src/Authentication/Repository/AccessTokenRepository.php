<?php

namespace App\Authentication\Repository;

use App\Authentication\Entity\AccessToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AccessTokenRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private TokenGeneratorInterface $tokenGenerator,
        // private UserPasswordEncoderInterface  $passwordEncoder
        )
    {
        parent::__construct($registry, AccessToken::class);
    }

    public function findOneByValue(string $token): ?AccessToken
    {
        $token = $this->findOneBy(['token'=>$token]);
        return $token;
    }
    public function createNewToken(): void
    {
        $token = $this->tokenGenerator->generateToken();
        $newToken = new AccessToken(
            'muneer_shafi',
             $token,
            'token1',
            ''
        );
        $this->getEntityManager()
            ->persist($newToken);
        $this->getEntityManager()->flush();
        
    }

}
