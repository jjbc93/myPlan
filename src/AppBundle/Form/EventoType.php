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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
class EventoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,array("label"=>"Nombre","required"=>"required","attr"=>
             array("class"=>"form-control",)))
            ->add('descripcion',TextType::class,array("label"=>"Descripcion","required"=>"required","attr"=>array("class"=>"form-control",)))
            ->add('horario',TextType::class,array("label"=>"horario","required"=>"required","attr"=>
             array("class"=>"form-control",)))
            ->add('fecha',TextType::class,array("label"=>"fecha","required"=>"required","attr"=>
             array("class"=>"form-control",)))
            ->add('categorias', EntityType::class,array(
				"class" => "AppBundle:Categoria",
                'choice_label' => 'descripcion',
                "multiple" => true,
                'expanded' => true,
				"label" => "Categorias",
				"attr" =>array("class" => "form-control")))
            ->add('imagen', FileType::class,array(
				"label" => "Imagen:",
				"attr" =>array("class" => "form-control"),
				"data_class" => null,
				"required" => false
			))
            ->add('patrocinadores',TextType::class,array("label"=>"Patrocinadores","required"=>"required"
             ,"attr"=>array("class"=>"form-control")))
            ->add('lugar',TextType::class,array("label"=>"Lugar","required"=>"required","attr"=>
             array("class"=>"form-control",)))
            ->add('direccion',TextType::class,array("label"=>"Direccion","required"=>"required","attr"=>
             array("class"=>"form-control",)))
            ->add('enviar',SubmitType::class, array("attr" =>array(
            "class" =>"form-submit btn btn-success miSubmit")))
            /*->add('usuarios')*/
            
        ;
        //Buscar solucion más tarde
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
