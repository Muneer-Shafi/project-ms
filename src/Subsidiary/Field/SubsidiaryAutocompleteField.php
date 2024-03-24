<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Subsidiary\Field;

use App\Subsidiary\Entity\Subsidiary;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\BaseEntityAutocompleteType;
use Symfony\Component\Validator\Constraints\Count;

#[AsEntityAutocompleteField]
class SubsidiaryAutocompleteField extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Subsidiary::class,
            'searchable_fields' => ['name'],
            'label' => 'What sounds tasty?',
            'choice_label' => 'name',
            'multiple' => true,
            'constraints' => [
                new Count(min: 1, minMessage: 'We need to eat *something*'),
            ],
        ]);
    }

    public function getParent(): string
    {
        return BaseEntityAutocompleteType::class;
    }
}
