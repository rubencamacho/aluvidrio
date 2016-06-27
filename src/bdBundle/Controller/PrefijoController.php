<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use bdBundle\Entity\Prefijo;
use bdBundle\Form\PrefijoType;



class PrefijoController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $prefijo_repo=$em->getRepository("bdBundle:Prefijo");
        $prefijos=$prefijo_repo->findAll();

        
        return $this->render("bdBundle:Prefijo:index.html.twig",array(
            "prefijos" => $prefijos
        ));
    }

    public function addAction(Request $request){
        $prefijo = new Prefijo();

        $form = $this->createForm(PrefijoType::class, $prefijo);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();

                $prefijo->setPrefijo($form->get("prefijo")->getData());
                $prefijo->setDescripcion($form->get("descripcion")->getData());

                $em->persist($prefijo);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El prefijo se ha creado correctamente";
                }else{
                    $status = "El prefijo no se ha podido crear";
                }    

            }else{
                $status = "El prefijo no se ha creado, porque el formuario no es válido";
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("prefijos_index");
        }
        return $this->render("bdBundle:Prefijo:add.html.twig", array(
            "form" => $form->createView()
            ));

    }

    public function editAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $prefijo_repo=$em->getRepository("bdBundle:Prefijo");
        $prefijo=$prefijo_repo->find($id);

        $form = $this->createForm(PrefijoType::class, $prefijo);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $prefijo->setPrefijo($form->get('prefijo')->getData());
                $prefijo->setDescripcion($form->get('descripcion')->getData());
                 
                $em->persist($prefijo);
                    $flush = $em->flush();

                    if($flush==null){
                        $status = "El prefijo se ha editado correctamente !!";
                    }else{
                        $status ="Error al editar el prefijo!!";
                    }
            }else{
                    $status = "El prefijo no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("prefijos_index");
        }
        return $this->render("bdBundle:Prefijo:edit.html.twig",array(
            "form" => $form->createView()
        ));

    }

    public function deleteAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $prefijo_repo=$em->getRepository("bdBundle:Prefijo");
        $prefijo=$prefijo_repo->find($id);

            $em->remove($prefijo);
            $em->flush();

        return $this->redirectToRoute("prefijos_index");
    } 

}