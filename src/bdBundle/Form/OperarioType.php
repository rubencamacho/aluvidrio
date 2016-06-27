<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;


class OperarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codoperario',TextType::class,array(
                "label" => "Cod. Operario:",
                "attr" =>array("class" => "form-control")
            ))
            ->add('nombre',TextType::class, array("label"=>"Nombre","required"=>"required", "attr" =>array(
                "class" => "form-nombre form-control",
            )))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bdBundle\Entity\Operario'
        ));
    }
}
