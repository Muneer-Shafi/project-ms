<?php

declare(strict_types=1);

namespace App\Form;



use App\Relation\Domain\Entity\RelationAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;


class AddressType extends AbstractType
{
    // Form types are services, so you can inject other services in them if needed
    public function __construct(
        private SluggerInterface $slugger
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', null, [
                'attr' => ['autofocus' => true],
                'label' => 'label.name',
            ])
            ->add('addressLine1', TextareaType::class, [
                'help' => 'help.post_summary',
                'label' => 'label.addressLine1',
            ])
            ->add('addressLine2', TextareaType::class, [
                'help' => 'help.post_summary',
                'label' => 'label.addressLine2',
            ])
            ->add('pinCode', null, [
                'help' => 'help.post_pinCode',
                'label' => 'label.pinCode',
            ])
            ->add('city', null, [
                'help' => 'help.post_pinCode',
                'label' => 'label.city',
            ])
            // ->add('publishedAt', DateTimePickerType::class, [
            //     'label' => 'label.published_at',
            //     'help' => 'help.post_publication',
            // ])
            ->add('country', CountryType::class, [
                'mapped' => false,
                'label' => 'label.country',
                'help' => 'help.country',
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RelationAddress::class,
        ]);
    }
}
