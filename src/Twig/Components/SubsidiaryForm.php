<?php

declare(strict_types=1);
namespace App\Twig\Components;


use App\Subsidiary\Entity\Subsidiary;
use App\Subsidiary\Form\SubsidiaryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;
#[AsLiveComponent]
class SubsidiaryForm extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;

    #[LiveProp(fieldName: 'formData')]
    public ?Subsidiary $subsidiary;


    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            SubsidiaryType::class,
            $this->subsidiary
        );
    }
}