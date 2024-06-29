<?php

declare(strict_types=1);
namespace App\BankAccount\Form;

use App\BankAccount\Entity\BankAccount;
use App\Currency\Entity\Currency;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BankAccountType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('accountNumber', TextType::class, [
                'attr' => ['autofocus' => true],
                'label' => 'label.name',
            ])
            ->add('currency', EntityType::class, [
                'class' => Currency::class,
                'choice_label' => 'name',
                'label' => 'label.currency',
            ])
            ->add('name', TextType::class, [
                  'label' => 'label.name',
            ])
            ->add('ibanNumber', TextType::class, [
                'label' => 'label.ibanNumber',
            ])
            ->add('swiftCode', TextType::class, [
                'label' => 'label.swiftCode',
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BankAccount::class,
        ]);
    }

}