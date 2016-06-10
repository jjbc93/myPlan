<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Categoria;
use AppBundle\Form\CategoriaType;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryController extends Controller
{
    private $session;

    public function __construct(){
        $this->session = new Session();
    }
    /**
     * @Route("/category/add", name="addCategory")
    */ 
    public function addCategoryAction(Request $request){
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class,$categoria);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $eventRepo = $em->getRepository("AppBundle:Categoria");
                $em->persist($categoria);
                $flush = $em->flush();
                if($flush==null){
                    $status = "Ya puedes disfrutar de una nueva Categoria";
                }else{
                    $status = "No se ha podido crear la categoria intentelo más tarde";
                }

                $status = "Ya puedes disfrutar de una nueva Categoria";
            }else{

            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("mostrar");
        }
        return $this->render('category/categoryAdd.html.twig',array(
            "form" => $form->createView()
        ));
    }
}