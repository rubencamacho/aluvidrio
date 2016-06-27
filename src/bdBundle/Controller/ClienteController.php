<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;




class ClienteController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $cliente_repo=$em->getRepository("bdBundle:Obra");
        $clientes=$cliente_repo->findAll();

        
        return $this->render("bdBundle:Cliente:index.html.twig",array(
            "clientes" => $clientes
        ));
    }


}