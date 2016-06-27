<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckBoxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FechaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dia_inicio',DateType::class, array("label"=>"Día inicio:", 
                "required"=>"required",
                "format" => "dd MM yyyy",
                "data" => new \DateTime("now"),
                "attr" =>array(
                "class" => "form-fecha form-control",
            )))          
            ->add('dia_fin',DateType::class, array("label"=>"Día fin:", 
                "required"=>"required",
                "format" => "dd MM yyyy",
                "data" => new \DateTime("now"),
                "attr" =>array(
                "class" => "form-fecha form-control",
            ))) 
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'bdBundle\Entity\Fecha'
        ));
    }
}
