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

use bdBundle\Entity\Obra;
use bdBundle\Entity\Costereal;
use bdBundle\Entity\Oferta;
use bdBundle\Form\ObraType;


class ObraController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

        public function postAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $obra = new Obra();
        $obra_repo = $em->getRepository('bdBundle:Obra');
        $obras = $obra_repo->findAll();

        $obra = $obra_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));  


        $obra->setObra($value);
        $em->persist($obra);
        //$em->persist($producto);

        $flush = $em->flush();   

        if($id != "")
        {
            // Populate an array with the response code and the data we want to send back to the browser
            // We can json encode the data from an array easily using built in functions   
            
            $returnData = array("responseCode"=>200, 'coste' => $value);
        
        }
        else
        {
            $returnData = array("responseCode"=>400);

        }
        
        /* Serialize the returnData array in json format for sending to the browser */
        
        $returnData = json_encode($returnData);
        
        /* Finally, construct a response object to send the data to the browser with our data */
        
        /* Send the data with a HTTP status code 200 for "Okay" and the correct content encoding */
        
        return new Response( $returnData ,200 , array('Content-Type'=>'application/json') );            
            
    }
    public function postestadoAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $obra = new Obra();
        $obra_repo = $em->getRepository('bdBundle:Obra');
        $obras = $obra_repo->findAll();

        $obra = $obra_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value')); 

         

        $obra->setEstado($value);

        $em->persist($obra);
        //$em->persist($producto);

        $flush = $em->flush();   

        if($id != "")
        {
            // Populate an array with the response code and the data we want to send back to the browser
            // We can json encode the data from an array easily using built in functions               
            $returnData = array("responseCode"=>200, 'coste' => $obra->getEstado());        
        }
        else
        {
            $returnData = array("responseCode"=>400);
        }
        
        /* Serialize the returnData array in json format for sending to the browser */
        
        $returnData = json_encode($returnData);
        
        /* Finally, construct a response object to send the data to the browser with our data */
        
        /* Send the data with a HTTP status code 200 for "Okay" and the correct content encoding */
        
        return new Response( $returnData ,200 , array('Content-Type'=>'application/json') );  
        

    }
    public function postclienteAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $obra = new Obra();
        $obra_repo = $em->getRepository('bdBundle:Obra');
        $obras = $obra_repo->findAll();

        $obra = $obra_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));  


        $obra->setCliente($value);
        $em->persist($obra);
        //$em->persist($producto);

        $flush = $em->flush();   

        if($id != "")
        {
            // Populate an array with the response code and the data we want to send back to the browser
            // We can json encode the data from an array easily using built in functions   
            
            $returnData = array("responseCode"=>200, 'coste' => $obra->getObra());
        
        }
        else
        {
            $returnData = array("responseCode"=>400);

        }
        
        /* Serialize the returnData array in json format for sending to the browser */
        
        $returnData = json_encode($returnData);
        
        /* Finally, construct a response object to send the data to the browser with our data */
        
        /* Send the data with a HTTP status code 200 for "Okay" and the correct content encoding */
        
        return new Response( $returnData ,200 , array('Content-Type'=>'application/json') );  
        

    }

    public function postfechaAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $obra = new Obra();
        $obra_repo = $em->getRepository('bdBundle:Obra');
        $obras = $obra_repo->findAll();

        $obra = $obra_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));  


        $obra->setFecha($value);
        $em->persist($obra);
        //$em->persist($producto);

        $flush = $em->flush();   

        if($id != "")
        {
            // Populate an array with the response code and the data we want to send back to the browser
            // We can json encode the data from an array easily using built in functions   
            
            $returnData = array("responseCode"=>200, 'coste' => $value);
        
        }
        else
        {
            $returnData = array("responseCode"=>400);

        }
        
        /* Serialize the returnData array in json format for sending to the browser */
        
        $returnData = json_encode($returnData);
        
        /* Finally, construct a response object to send the data to the browser with our data */
        
        /* Send the data with a HTTP status code 200 for "Okay" and the correct content encoding */
        
        return new Response( $returnData ,200 , array('Content-Type'=>'application/json') );  
        

    }

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obras=$obra_repo->findAll();
        
        return $this->render("bdBundle:Obra:index.html.twig",array(
            "obras" => $obras
        ));
    }

    public function newAction(Request $request)
    {
        $obra = new Obra();
        $form = $this->createForm(ObraType::class, $obra);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $obra->setObra($form->get("obra")->getData());
                $obra->setCliente($form->get("cliente")->getData());
                $obra->setFecha($form->get("fecha")->getData());
                $obra->setEstado($form->get("estado")->getData());
                $obra->setPresupuesto($form->get("presupuesto")->getData());

                $em->persist($obra);
                $flush = $em->flush();

                $coste = new Costereal();
                $oferta = new Oferta();
                $obra->getId();
                $coste->setObra($obra);
                $coste->setCoste(0);
                $oferta->setObra($obra);
                $oferta->setCosteoferta(0);
                $em->persist($coste);           
                $em->persist($oferta);
                $flush = $em->flush();

                if($flush==null){
                    $status = "La obra se ha creado correctamente";
                }else{
                    $status = "La obra no se ha podido crear";
                }    

            }else{
                $status = "La obra no se ha creado, porque el formuario no es válido";
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("obra_index");
        }

        return $this->render("bdBundle:Obra:new.html.twig", array(
            "form" => $form->createView()
            ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obra=$obra_repo->find($id);

        $form = $this->createForm(ObraType::class, $obra);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em->persist($obra);
                $flush = $em->flush();

                if($flush==null){
                    $status = "La obra se ha editado correctamente !!";
                }else{
                    $status ="Error al editar la obra!!";
                }
            }else{
                $status = "La obra no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("obra_index");
        }
        return $this->render("bdBundle:Obra:edit.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getEntityManager();
        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obra=$obra_repo->find($id);

            $em->remove($obra);
            $em->flush();
        

        return $this->redirectToRoute("obra_index");
    }

    public function costerealAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery
        (
            'SELECT o.cliente,o.presupuesto, o.estado,o.obra, o.fecha, c.coste,o.id, c.id as obra_id
             FROM bdBundle:Costereal c 
             JOIN bdBundle:Obra o WITH c.obra=o.id
             WHERE o.presupuesto = :presupuesto
            '
        );
        //$query->setParameter('coste', '0');
        $query->setParameter('presupuesto', '1');
        $datos = $query->getResult();    

        
        return $this->render("bdBundle:Obra:costereal.html.twig",array(
            "datos" => $datos
        ));


    }


    public function obrasinpresupuestoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obras=$obra_repo->findAll();

        return $this->render("bdBundle:Obra:obrasinpresupuesto.html.twig",array(
            "obras" => $obras
        ));

    }


}
