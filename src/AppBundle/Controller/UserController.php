<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{   
    /**
     * @Route("/login", name="login")
     */
    
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName =$authenticationUtils->getLastUsername();
        
        return $this->render('default/user.html.twig',array(
            "error" => $error,
            "lastUserName" => $lastUserName
            
        ));
    }
}