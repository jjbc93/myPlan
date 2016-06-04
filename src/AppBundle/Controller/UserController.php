<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

class UserController extends Controller
{   
    /**
     * Controlador encargado de la acción de login de los usuarios,
     * con validación de symfony3 y formulario de registro
     * @Route("/login", name="login")
     */
    
    public function loginAction(Request $request)
    {
        //Autentificación de Symfony3
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName =$authenticationUtils->getLastUsername();
        //Formulario para registrar un nuevo usuario en la aplicación
        $user = new Usuario();
        $form = $this->createForm(UsuarioType::class,$user);
        $form->handleRequest($request);
        
        if($form->isValid()){
           /* $user = new Usuario();
            $user->setNick($form->get("nick")->getData());
            $user->setNombre($form->get("nombre")->getData());
            $user->setApellidos($form->get("apellidos")->getData());
            $user->setCorreo($form->get("correo")->getData());
            $user->setClave($form->get("clave")->getData());*/
            $user->setRol("ROLE_USER");
            /*$user->setImagen(null);*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $flush = $em->flush();
            if($flush==null){
                 $status = "Gracias ".$user->getNombre()." desde ahora formas parte de myplan, este atento a su correo para nuevos eventos actulizaciones";
            }else{
                $status = "Lo sentimos no se ha podido dar de alta revise los campos y vuelva a intentarlo";
            }
           
        }else{
            $status = "formulario no valido";
        }
        
        
        return $this->render('default/user.html.twig',array(
            "error" => $error,
            "lastUserName" => $lastUserName,
            "form" => $form->createView(),
            
        ));
    }
}