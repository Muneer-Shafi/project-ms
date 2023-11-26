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

namespace App\Common\Trait;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

trait BlameableEntity
{
    #[ORM\Column(nullable: true)]
    protected \User $createdBy;

    #[ORM\Column(nullable: true)]
    protected User $updatedBy;

    public function setCreatedBy(User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedBy(): User
    {
        return $this->createdBy;
    }

    public function setUpdatedBy(User $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedBy(): User
    {
        return $this->updatedBy;
    }
}
