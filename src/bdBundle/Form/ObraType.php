<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ObraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('obra',TextType::class, array("label"=>"Obra:","required"=>"required", "attr" =>array(
                "class" => "form-cliente form-control",
            )))
            ->add('cliente',TextType::class, array("label"=>"Cliente:","required"=>"required", "attr" =>array(
                "class" => "form-cliente form-control",
            )))
            ->add('fecha',DateTimeType::class, array("label"=>"Fecha:", 
                "required"=>"required", 
                "data" => new \DateTime("now"),
                "format" => "dd MM yyyy",
                "attr" =>array(
                "class" => "form-fecha form-control",
            )))
            ->add('estado', ChoiceType::class,array(
                "label" => "Estado:",
                "choices"=> array(
                    "Pendiente" => "pendiente",
                    "Ejecutando" => "ejecutando",
                    "Finalizada" => "finalizada"
                ),
                "attr" =>array("class" => "form-control")
            ))
            ->add('presupuesto', ChoiceType::class,array(
                "label" => "Presupuesto:",
                "choices"=> array(
                    "0" => "Sin Presupuesto",
                    "1" => "Con Presupuesto"
                ),
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
            'data_class' => 'bdBundle\Entity\Obra'
        ));
    }
}
