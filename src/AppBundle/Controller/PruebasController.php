<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PruebasController extends Controller
{
    /**
     * @Route("/mostrar", name="mostrar")
     */
    public function mostrarDatosAction()
    {/*
        $em = $this->getDoctrine()->getManager();
        $eventUserRepo = $em->getRepository("AppBundle:EventUsuario");
        $eventUsers = $eventUserRepo->findAll();
        foreach($eventUsers as $eventUser){
            echo $eventUser->getIdEvento()->getNombre()."<br/>";
            echo $eventUser->getIdUsuario()->getNombre()."<br/> <hr/>";
        }*/
        return $this->render('default/login.html.twig');
    }
    
    
}