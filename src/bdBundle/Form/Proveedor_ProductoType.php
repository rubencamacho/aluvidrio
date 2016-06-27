<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;


class Proveedor_ProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('proveedor', EntityType::class,array(
                "mapped" => false,
                "label" => "Operario",
                "class" => 'bdBundle:Proveedor',
                "attr" =>array("class" => "form-control")
                )) 
            ->add('producto', EntityType::class,array(
                "mapped" => false,
                "label" => "Operario",
                "class" => 'bdBundle:Producto',
                "attr" =>array("class" => "form-control")
                )) 
            ->add('precio',MoneyType::class,array(
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
            'data_class' => 'bdBundle\Entity\Proveedor_Producto'
        ));
    }
}
