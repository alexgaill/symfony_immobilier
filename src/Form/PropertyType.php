<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Titre de l\'annocne'])
            ->add('description')
            ->add('surface')
            ->add('rooms', null, ['label' => 'Nb de pièces'])
            ->add('bedrooms', null, ['label' => 'Nb de chambres'])
            ->add('floor', null, ['label' => 'Etage'])
            ->add('price', null, ['label' => 'Prix'])
            ->add('heat', ChoiceType::class, ['label' => 'Type de chauffage', 'choices' => $this->getChoices()])
            ->add('city', null, ['label' => 'Ville'])
            ->add('address', null, ['label' => 'Adresse'])
            ->add('postal_code', null, ['label' => 'Code Postal'])
            ->add('sold', null, ['label' => 'Vendu?'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
            'translation_domain' => 'forms'
        ]);
    }

    private function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $k =>$v){
            $output[$v] = $k;
        }
        return $output;
    }
}
