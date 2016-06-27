<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;




class ProductosobraType extends AbstractType
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
                "label" => "Proveedor",
                "class" => 'bdBundle:Proveedor',
                "attr" =>array("class" => "form-control")
                ))
            ->add('albaran', IntegerType::class, array(
                "required" => false,
                "label" => "Albarán",
                "attr" => array("class" => "form-control")
                ))
            ->add('prefijo', EntityType::class,array(
                "mapped" => false,
                "label" => "Prefijo",
                "class" => 'bdBundle:Prefijo',
                "attr" =>array("class" => "form-control")
                ))
            ->add('codprod', EntityType::class,array(
                "mapped" => false,
                "label" => "Cod.Prod.",
                "class" => 'bdBundle:Producto',
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
            'data_class' => 'bdBundle\Entity\Productosobra'
        ));
    }
}
