<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Evento;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\EventUsuario;
use AppBundle\Form\EventoType;

class EventController extends Controller
{
    private $session;

    public function __construct(){
        $this->session = new Session();
    }

    /**
     * @Route("/event/list", name="listEvent")
    */ 
    public function indexEventAction()
    {   
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository("AppBundle:Evento");
        $events = $eventRepo->findAll();

        return $this->render('event/eventDefault.html.twig',array(
            "events" =>$events
        ));
    }

    /**
     * @Route("/event/add", name="addEvent")
    */ 
    public function addEventAction(Request $request)
    {
        //Generar Formulario de eventos
        $evento = new Evento();
        $form = $this->createForm(EventoType::class,$evento);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $eventRepo = $em->getRepository("AppBundle:Evento");
                //Subir fichero
                $file=$form["imagen"]->getData();
				
				if(!empty($file) && $file!=null){
					$ext=$file->guessExtension();
					$file_name=time().".".$ext;
					$file->move("uploads",$file_name);

					$evento->setImagen($file_name);
				}else{
					$entry->setImagen(null);
				}
                
                /*foreach($evento->getCategorias() as $categoria){
                    var_dump($categoria);
                    $evento->addCategoria($categoria);
                }*/
                $em->persist($evento);
                $flush = $em->flush();
                if($flush==null){
                    $status = "Los clientes ya pueden disfrutar de un nuevo evento";
                }else{
                    $status = "No se ha podido crear el evento revise los campos";
                }

                $status = "Los clientes ya pueden disfrutar de un nuevo evento";
            }else{
                $status = "No se ha podido crear el evento revise los campos";
            }
            $this->session->getFlashbag()->add("status",$status);
            return $this->redirectToRoute("listEvent");
        }



        return $this->render('event/eventAdd.html.twig',array(
            "form" => $form->createView()
        ));
    }
    
     /**
     * @Route("/event/add/user/{id}", name="addUserEvent")
    */ 
    public function addUserEventAction($id){
       $em = $this->getDoctrine()->getManager();
       $eventRepo = $em->getRepository("AppBundle:Evento");
       $event = $eventRepo->find($id);
       $user = $this->getUser();
       $user->addEvento($event);
       $em->flush();
       
       return $this->redirectToRoute("listEvent");
    }
    
    /**
     * @Route("/event/delete/{id}", name="deleteEvent")
    */ 
    public function deleteEventAction($id){
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository("AppBundle:Evento");
        $event = $eventRepo->find($id);
        $em->remove($event);
        $em->flush();
        
        return $this->redirectToRoute("listEvent");
    }
}