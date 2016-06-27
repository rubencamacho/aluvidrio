<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CosterealType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder        
            ->add('codprod', EntityType::class,array(
                "mapped" => false,
                "label" => "Cod.Prod.",
                "class" => 'bdBundle:Producto',
                "attr" =>array("class" => "form-control")
                ))
            ->add('coste',MoneyType::class,array(
                "label" => "Precio:",
                "attr" =>array("class" => "form-control")
            )) 
                      
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bdBundle\Entity\Costereal'
        ));
    }
}
