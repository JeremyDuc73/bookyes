<?php

namespace App\Form;

use App\Entity\Equipment;
use App\Entity\Property;
use App\Entity\PropertyCategory;
use App\Repository\EquipmentRepository;
use App\Repository\PropertyCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('propertyCategory', EntityType::class, [
                'class'=>PropertyCategory::class,
                'query_builder' => function (PropertyCategoryRepository $propertyCategoryRepository) {
                    return $propertyCategoryRepository->createQueryBuilder('cat')
                        ->orderBy('cat.name', 'ASC');
                },
                'choice_label' => 'name',
                'multiple'=>false,
                'label'=>'Catégorie'
            ])
            ->add('equipments', EntityType::class, [
                'class'=>Equipment::class,
                'query_builder' => function (EquipmentRepository $equipmentRepository) {
                    return $equipmentRepository->createQueryBuilder('equipment')
                        ->orderBy('equipment.name', 'ASC');
                },
                'choice_label' => 'name',
                'expanded'=>true,
                'multiple'=>true,
                'label'=>'Equipement'
            ])
            ->add('description')
            ->add('country', CountryType::class)
            ->add('star')
            ->add('website')
            ->add('adress')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
