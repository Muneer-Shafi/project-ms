<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Relation\Form;

use App\Form\AddressType;
use App\Form\Type\DateTimePickerType;
use App\Form\Type\TagsInputType;
use App\Relation\Domain\Entity\Relation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class RelationType extends AbstractType
{
    // Form types are services, so you can inject other services in them if needed
    public function __construct(
        private SluggerInterface $slugger
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'attr' => ['autofocus' => true],
                'label' => 'label.name',
            ])
            ->add('shortName', TextareaType::class, [
                'help' => 'help.post_summary',
                'label' => 'label.shortName',
            ])
            ->add('cocNumber', null, [
                'help' => 'help.post_cocNumber',
                'label' => 'label.cocNumber',
            ])
            ->add('remarks', TextareaType::class, [
                'attr' => ['rows' => 5],
                'help' => 'help.remarks',
                'label' => 'label.remarks',
            ])
            ->add('country', CountryType::class, [
                'mapped' => false,
                'help' => 'help.country',
                'label' => 'label.country',
            ])
//            ->add('addresses', LiveCollectionType::class, [
//                'entry_type' => AddressType::class,
//                'entry_options' => ['label' => false],
//                'label' => false,
//                'allow_add' => true,
//                'allow_delete' => true,
//                'by_reference' => false,
//            ])
            ->add('contacts', LiveCollectionType::class, [
                'entry_type' => ContactType::class,
                'entry_options' => ['label' => false],
                'label' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
        // ->add('publishedAt', DateTimePickerType::class, [
        //     'label' => 'label.published_at',
        //     'help' => 'help.post_publication',
        // ])
        // ->add('tags', TagsInputType::class, [
        //     'label' => 'label.tags',
        //     'required' => false,
        // ]);
        // form events let you modify information or fields at different steps
        // of the form handling process.
        // See https://symfony.com/doc/current/form/events.html
        // ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
        //     /** @var Post */
        //     $post = $event->getData();
        //     if (null === $post->getSlug() && null !== $post->getTitle()) {
        //         $post->setSlug($this->slugger->slug($post->getTitle())->lower());
        //     }
        // });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Relation::class,
        ]);
    }
}
