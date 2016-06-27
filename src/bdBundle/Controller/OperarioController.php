<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use bdBundle\Entity\Operario;
use bdBundle\Form\OperarioType;


class OperarioController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }


    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $operario_repo=$em->getRepository("bdBundle:Operario");
        $operarios=$operario_repo->findAll();
        
        return $this->render("bdBundle:Operario:index.html.twig",array(
            "operarios" => $operarios
        ));
    }

    public function addAction(Request $request)
    {
        $operario = new Operario();
        $form = $this->createForm(OperarioType::class, $operario);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $operario->setNombre($form->get("nombre")->getData());

                $em->persist($operario);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El operario se ha creado correctamente";
                }else{
                    $status = "El operario no se ha podido crear";
                }    

            }else{
                $status = "El operario no se ha creado, porque el formuario no es válido";
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("operarios_list");
        }

        return $this->render("bdBundle:Operario:add.html.twig", array(
            "form" => $form->createView()
            ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $operario_repo=$em->getRepository("bdBundle:Operario");
        $operario=$operario_repo->find($id);

        $editform = $this->createForm(OperarioType::class, $operario);
        
        $editform->handleRequest($request);

        if($editform->isSubmitted()){
            if($editform->isValid()){
                $operario->setCodOperario($editform->get("codoperario")->getData());
                $operario->setNombre($editform->get("nombre")->getData());

                $em->persist($operario);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El operario se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el operario!!";
                }
            }else{
                $status = "El operario no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("operarios_list");
        }
        return $this->render("bdBundle:Operario:edit.html.twig",array(
            "form" => $editform->createView()
        ));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getEntityManager();
        $operario_repo=$em->getRepository("bdBundle:Operario");
        $operario=$operario_repo->find($id);

            $em->remove($operario);
            $em->flush();
        

        return $this->redirectToRoute("operarios_list");
    }


}