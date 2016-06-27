<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use bdBundle\Entity\Costeoferta;
use bdBundle\Form\CosteofertaType;



class OfertaController extends Controller{

		private $session;
	    
	    public function __construct() {
	        $this->session=new Session();
	    }

	    public function indexofertaAction(Request $request){
	    	$em = $this->getDoctrine()->getEntityManager();
	        $oferta_repo=$em->getRepository("bdBundle:Costeoferta");
	        $ofertas=$oferta_repo->findAll();
	        
	        return $this->render("bdBundle:Oferta:indexoferta.html.twig",array(
	            "ofertas" => $ofertas
	        ));
	    }

	    public function addofertaAction(Request $request){
        $coste = new Costeoferta();
        $form = $this->createForm(CosteofertaType::class,$coste);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                
                $em = $this->getDoctrine()->getEntityManager();
                
                $coste = new Costeoferta();
                $coste->setDescripcion($form->get("descripcion")->getData());
                $coste->setUnd($form->get("und")->getData());
                $coste->setPrecio($form->get("precio")->getData());
                
                $em->persist($coste);
                $flush = $em->flush();
                
                if($flush==null){
                    $status = "El producto se ha creado correctamente !!";
                }else{
                    $status ="Error al añadir el producto!!";
                }
                
            }else{
                $status = "El producto no se ha creado, porque el formulario no es valido !!";
            }
            
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("oferta_list");
        }
        
        
        return $this->render("bdBundle:Oferta:addoferta.html.twig",array(
            "form" => $form->createView()
        ));
    }

        public function deleteofertaAction($id){
        $em=$this->getDoctrine()->getEntityManager();
        $oferta_repo=$em->getRepository("bdBundle:Costeoferta");
        $oferta=$oferta_repo->find($id);

        if(count($oferta->getobra())==0){
            $em->remove($oferta);
            $em->flush();
        }

        return $this->redirectToRoute("oferta_list");
    }

    public function editofertaAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $oferta_repo=$em->getRepository("bdBundle:Costeoferta");
        $oferta=$oferta_repo->find($id);
        
        $form = $this->createForm(CosteofertaType::class,$oferta);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                
                $oferta->setDescripcion($form->get("descripcion")->getData());
                $oferta->setUnd($form->get("und")->getData());
                $oferta->setPrecio($form->get("precio")->getData());
                
                $em->persist($oferta);
                $flush = $em->flush();
                
                if($flush==null){
                    $status = "El producto se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el producto!!";
                }
                
            }else{
                $status = "El producto no se ha editado, porque el formulario no es valido !!";
            }
            
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("oferta_list");
        }
        
        return $this->render("bdBundle:Oferta:editoferta.html.twig",array(
            "form" => $form->createView()
        ));
    }

}