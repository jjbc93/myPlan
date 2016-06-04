<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Usuario;
use AppBundle\Form\UsuarioType;

class UserController extends Controller
{   
    private $session;

    public function __construct(){
        $this->session = new Session();
    }
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
        if($form->isSubmitted()){
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $userRepo = $em->getRepository("AppBundle:Usuario");
                $user = $userRepo->findOneBy(array("correo"=>$form->get("correo")->getData()));
                if(count($user)==0){
                    $user = new Usuario();
                    /*$user->setNick($form->get("nick")->getData());
                    $user->setNombre($form->get("nombre")->getData());
                    $user->setApellidos($form->get("apellidos")->getData());
                    $user->setCorreo($form->get("correo")->getData());*/
                    $user->setRol("ROLE_USER");
                    /*$user->setImagen(null);*/
                    //Cifrar la password del usuario
                    $factory = $this->get("security.encoder_factory");
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get("clave")->getData(),$user->getSalt());
                    $user->setClave($password);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $flush = $em->flush();
                    if($flush==null){
                        $status = "Gracias ".$user->getNombre()." desde ahora formas parte de myplan, estate atento a su correo para nuevos eventos y actulizaciones";
                    }else{
                        $status = "Lo sentimos no se ha podido dar de alta revise los campos y vuelva a intentarlo";
                    }
                }else{
                    $status = "Lo sentimos esta cuenta de correo ya esta asociada a un cliente";
                }

            }else{
                $status = "formulario no valido";

            }
            $this->session->getFlashBag()->add("status",$status);
        }
        return $this->render('default/user.html.twig',array(
            "error" => $error,
            "lastUserName" => $lastUserName,
            "form" => $form->createView(),

        ));
    }
}