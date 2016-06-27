<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class ProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prefijo',EntityType::class,array(
                "label" => "Prefijo",
                "class" => "bdBundle:Prefijo",
                "attr" =>array("class" => "form-control")
            ))
            ->add('codprod',TextType::class,array(
                "label" => "Cod. Producto:",
                "attr" =>array("class" => "form-control")
            ))
            ->add('descripcion',TextType::class,array(
                "label" => "Descripción:",
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
            'data_class' => 'bdBundle\Entity\Producto'
        ));
    }
}
