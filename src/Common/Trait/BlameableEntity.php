<?php
declare(strict_types=1);

namespace App\Common\Trait;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

trait BlameableEntity
{

    #[ORM\Column(nullable: true)]
    protected \User $createdBy;


    #[ORM\Column(nullable: true)]
    protected User $updatedBy;

    public function setCreatedBy( User $createdBy):self
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    public function getCreatedBy():User
    {
        return $this->createdBy;
    }

    public function setUpdatedBy(User $updatedBy):self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    public function getUpdatedBy():User
    {
        return $this->updatedBy;
    }
}