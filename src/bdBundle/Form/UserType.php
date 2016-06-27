<?php

namespace bdBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, array("label"=>"Usuario","required"=>"required", "attr" =>array(
                "class" => "form-username form-control",
            )))
            ->add('name',TextType::class, array("label"=>"Nombre","required"=>"required", "attr" =>array(
                "class" => "form-name form-control",
            )))
            ->add('password',PasswordType::class, array("label"=>"Contraseña","required"=>"required", "attr" =>array(
                "class" => "form-password form-control",
            )))
            ->add('role', ChoiceType::class,array(
                "label" => "ROLE:",
                "choices"=> array(
                    "ROLE_USER" => "Usuario",
                    "ROLE_ADMIN" => "Administrador"
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
            'data_class' => 'bdBundle\Entity\User'
        ));
    }
}
