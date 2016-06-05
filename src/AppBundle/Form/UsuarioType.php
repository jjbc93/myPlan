<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nick',TextType::class, array("label"=>"Nick","required"=>"required","attr" => array(
            "class" =>"form-nick form-control",
            )))
            ->add('nombre',TextType::class, array("label"=>"Nombre","required"=>"required","attr" => array(
            "class" =>"form-nombre form-control",
            )))
            ->add('apellidos',TextType::class, array("label"=>"Apellidos","required"=>"required","attr" => array(
            "class" =>"form-apellidos form-control",
            )))
            ->add('correo',EmailType::class, array("label"=>"Email","required"=>"required","attr" => array(
            "class" =>"form-correo form-control",
            )))
            ->add('clave',PasswordType::class, array("label"=>"Contraseña","required"=>"required","attr" => array(
            "class" =>"form-password form-control",
            )))
            ->add('enviar',SubmitType::class, array("attr" =>array(
            "class" =>"form-submit btn btn-success miSubmit")))
            /*->add('rol')
            ->add('imagen')*/
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Usuario'
        ));
    }
}
