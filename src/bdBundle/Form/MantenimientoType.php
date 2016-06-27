<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckBoxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class MantenimientoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('dia',DateType::class, array("label"=>"Día:", 
                "required"=>"required", 
                "data" => new \DateTime("now"),
                "format" => "dd MM yyyy",
                "attr" =>array(
                "class" => "form-fecha form-control",
            )))          
            ->add('hora_inicio_manana',TimeType::class, array("label"=>"Hora inicio mañana:", "required"=>"required", "attr" =>array(
                "class" => "form-hour form-control",
            )))           
            ->add('hora_fin_manana',TimeType::class, array("label"=>"Hora fin mañana:", "required"=>"required", "attr" =>array(
                "class" => "form-hour form-control",
            )))         
            ->add('hora_inicio_tarde',TimeType::class, array("label"=>"Hora inicio tarde:", "required"=>"required", "attr" =>array(
                "class" => "form-fecha form-control",
            )))            
            ->add('hora_fin_tarde',TimeType::class, array("label"=>"Hora fin tarde:", "required"=>"required", "attr" =>array(
                "class" => "form-fecha form-control",
            ))) 
            ->add('observaciones',TextAreaType::class, array("label"=>"Observaciones:", "attr" =>array(
                "class" => "form-cliente form-control",
            )))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bdBundle\Entity\Mantenimiento'
        ));
    }
}
