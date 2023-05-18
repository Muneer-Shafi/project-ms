<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Relation;
use App\Form\Type\DateTimePickerType;
use App\Form\Type\TagsInputType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\SluggerInterface;

class RelationType extends AbstractType
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
                'mapped' =>false,
                'help' => 'help.country',
                'label' => 'label.country',
            ])
            ->add('addresses', CollectionType::class, [
                'entry_type' => AddressType::class,
                'allow_delete' => true,
                'allow_add' => true,
                'entry_options' => ['label' => false],
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

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Relation::class,
        ]);
    }
}
