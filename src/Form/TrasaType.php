<?php

namespace App\Form;

use App\Entity\Trasa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TrasaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', TextType::class, [
                'label' => 'Początek trasy'
            ])
            ->add('end', TextType::class, [
                'label' => 'Koniec trasy'
            ])
            ->add('opis', TextType::class, [
                'label' => 'Opis (lista przystanków)'
            ])
            ->add('legenda', TextareaType::class, [
                'label' => 'Legenda(opis oznaczeń kursów)'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zapisz',
                'attr' => [ 'class' => 'btn btn-success' ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trasa::class,
        ]);
    }
}
