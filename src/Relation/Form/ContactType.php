<?php

namespace App\Relation\Form;

use App\Relation\Domain\Entity\RelationAddress;
use App\Relation\Domain\Entity\RelationContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;

class ContactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'attr' => ['autofocus' => true],
//                'label' => 'label.name',
            ])
            ->add('lastName', TextType::class, [
                'help' => 'help.lastName',
//                'label' => 'label.lastName',
            ])
            ->add('email', TextType::class, [
                'help' => 'help.email',
//                'label' => 'label.email',
            ])
            ->add('telephone', TextType::class, [
                'help' => 'help.telephone',
//                'label' => 'label.telephone',
            ])
            ->add('gender', null, [
                'help' => 'help.gender',
//                'label' => 'label.gender',
            ])
            ->add('initials', null, [
                'help' => 'help.initials',
//                'label' => 'label.initials',
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RelationContact::class,
        ]);
    }


}