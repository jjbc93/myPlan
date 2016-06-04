<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
    */ 
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/pp", name="hello")
     */
    public function dime2Action()
    {
        $em = $this->getDoctrine()->getManager();
        $eventUserRepo = $em->getRepository("AppBundle:EventUsuario");
        $eventUsers = $eventUserRepo ->findAll();
        foreach($eventUsers as $eventUser){
            echo $eventUser->getNombre()."<br/>";
        }
        return $this->render('default/prueba.html.twig');
    }
}
