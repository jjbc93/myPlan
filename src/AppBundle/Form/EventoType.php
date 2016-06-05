<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class, array("label"=>"Nombre","required"=>"required","attr" => array("class" =>"form-name form-control",)))
            ->add('horario', TextType::class, array("label"=>"Horario","required"=>"required","attr" => array("class" =>"form-name form-control",)))
            
            ->add('fecha',TextType::class, array("label"=>"Fecha","required"=>"required","attr" => array("class" =>"form-name form-control",)))
            ->add('organizadores',TextType::class, array("label"=>"Organizadores","required"=>"required","attr" => array("class" =>"form-name form-control",)))
            ->add('lugar', TextType::class, array("label"=>"Lugar","required"=>"required","attr" => array("class" =>"form-name form-control",)))
            ->add('direccion',TextType::class, array("label"=>"Dirección","required"=>"required","attr" => array("class" =>"form-name form-control",)))
            ->add('descripcion',TextareaType::class, array("label"=>"Descripción","required"=>"required","attr"=>array("class"=>"form-name form-control")))
            ->add('Generar Evento',SubmitType::class, array("attr" =>array(
            "class" =>"form-submit btn btn-success miSubmit")))
            
            
            /*->add('fecha', DateType::class, array(
                'required' => true,
                'label' => 'form.label.datetime',
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'class' => '',
                    'data-provide' => 'datepicker',
                    'data-format' => 'dd-mm-yyyy',
                )))*/
            /*->add('fecha', DateType::class, array(
                'widget' => 'single_text', 
                'html5' => true,
                ))*/
            
           /* ->add('fecha', DateType::class, array(
            'input'  => 'datetime',
            'widget' => 'choice',))*/
            
 
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Evento'
        ));
    }
}
