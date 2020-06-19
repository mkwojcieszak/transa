<?php

namespace App\Form;

use App\Entity\Kurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Trasa;

class KursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('czas')
            ->add('symbole')
            ->add('trasa', EntityType::class, [
                'label' => ' ',
                'class' => Trasa::class,
                'attr' => [
                    'class' => 'hidden'
                ]
            ])
            ->add('zapisz', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Kurs::class,
        ]);
    }
}
