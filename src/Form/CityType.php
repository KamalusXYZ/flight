<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('cityImg', FileType::class,['label' => 'Photo de la ville', 'required' => false,
                'constraints' => [new File([
                    'maxSize' => '1024k',
                    'maxSizeMessage' => 'Taille du fichier trop importante',
                    'mimeTypes' => ['image/jpeg', 'image/png'], 'mimeTypesMessage' => 'Merci de téléverser une image JPEG ou PNG'
                ])]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
