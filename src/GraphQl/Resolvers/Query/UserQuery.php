<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\GraphQl\Resolvers\Query;

use App\Entity\User;
use App\Repository\UserRepository;
use TheCodingMachine\GraphQLite\Annotations\Query;

final class UserQuery
{
    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    /**
     * @return User[]
     */
    #[Query]
    public function users(): array
    {
        return $this->userRepository->findAll();
    }
}
