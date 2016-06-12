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
     * @Route("/", name="index")
     */
    public function indexEventAction()
    {   
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository("AppBundle:Evento");
        $user = $this->getUser();
        if(!$user){
            $events = $eventRepo->findAll();
        }else{
            $events  = $eventRepo->findByNotInUser($user->getId());
        }
        return $this->render('event/eventDefault.html.twig',array(
            "events" =>$events
        ));
    }
    
    /**
     * @Route("/event/user", name="userEvent")
    */ 
    public function userEventListAction()
    {   
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository("AppBundle:Evento");
        $user = $this->getUser();
        $events = $user->getEventos();
        return $this->render('event/eventList.html.twig',array(
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
					$evento->setImagen(null);
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
            return $this->redirectToRoute("index");
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
        if($user==null){
            $status = "Debes estar registrado para disfrutar de nuestros eventos";
            $this->session->getFlashbag()->add("status",$status);
            return $this->redirectToRoute("login");
        }
       $user->addEvento($event);
       $em->flush();
       
       return $this->redirectToRoute("index");
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
        
        return $this->redirectToRoute("index");
    }
    
    /**
     * @Route("/event/edit/{id}", name="editEvent")
    */ 
    public function editEventAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository("AppBundle:Evento");
        $event = $eventRepo->find($id);
        $form = $this->createForm(EventoType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                //Subir fichero
                $file=$form["imagen"]->getData();
				
				if(!empty($file) && $file!=null){
					$ext=$file->guessExtension();
					$file_name=time().".".$ext;
					$file->move("uploads",$file_name);

					$event->setImagen($file_name);
				}else{
					$event->getImagen();
				}
                
                /*foreach($evento->getCategorias() as $categoria){
                    var_dump($categoria);
                    $evento->addCategoria($categoria);
                }*/
                $em->persist($event);
                $flush = $em->flush();
                if($flush==null){
                    $status = "El evento ha sido editado";
                }else{
                    $status = "No se ha podido editar el evento";
                }

                $status = "El evento ha sido editado";
            }else{
                $status = "No se ha podido editar el evento";
            }
            $this->session->getFlashbag()->add("status",$status);
            return $this->redirectToRoute("index");
        }



        return $this->render('event/eventAdd.html.twig',array(
            "form" => $form->createView()
        ));
    }
    
    /**
     * @Route("/event/delete/user/{id}", name="deleteUserEvent")
    */ 
    public function deleteUserEventAction($id){
        $em = $this->getDoctrine()->getManager();
        $eventRepo = $em->getRepository("AppBundle:Evento");
        $event = $eventRepo->find($id);
        $user = $this->getUser();
        $user->removeEvento($event);
        $em->flush();
        return $this->redirectToRoute("index");
    }
    
}