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

use bdBundle\Entity\Mantenimiento;
use bdBundle\Entity\Obra;
use bdBundle\Form\MantenimientoType;


class MantenimientoController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function indexmantenimientoAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $mante_repo=$em->getRepository("bdBundle:Mantenimiento");
        $mantenimiento=$mante_repo->findAll();

        
        return $this->render("bdBundle:Mantenimiento:indexmantenimiento.html.twig",array(
            "mantenimiento" => $mantenimiento
        ));
    }

     public function addmantenimientoAction(Request $request)
    {
        $mantenimiento = new Mantenimiento();
        $form = $this->createForm(MantenimientoType::class, $mantenimiento);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $user = $this->get('security.context')->getToken()->getUser()->getName();

                
               //$mantenimiento->setOperario($form->get("operario")->getData());
                $mantenimiento->setOperario($user);
                $mantenimiento->setDia($form->get("dia")->getData());
                $mantenimiento->setHoraInicioManana($form->get("hora_inicio_manana")->getData());
                $mantenimiento->setHoraFinManana($form->get("hora_fin_manana")->getData());
                $mantenimiento->setHoraInicioTarde($form->get("hora_inicio_tarde")->getData());
                $mantenimiento->setHoraFinTarde($form->get("hora_fin_tarde")->getData());
                $mantenimiento->setObservaciones($form->get("observaciones")->getData());

                $fin_dia = ($form->get("hora_fin_manana")->getData());
                $inicio_dia = ($form->get("hora_inicio_manana")->getData());
                $fin_tarde = ($form->get("hora_fin_tarde")->getData());
                $inicio_tarde = ($form->get("hora_inicio_tarde")->getData());

                $result1 = $inicio_dia->format('H:i:s');
                $result2 = $fin_dia->format('H:i:s');
                $result3 = $inicio_tarde->format('H:i:s');
                $result4 = $fin_tarde->format('H:i:s');                
                

                $horasdia = strtotime($result2) - strtotime($result1);
                $horastarde = strtotime($result4) - strtotime($result3);

                settype($horasdia, "float");
                settype($horastarde, "float");

                $total = $horasdia + $horastarde;
                $total = $total/3600;

                $mantenimiento->setTotal($total);

                $em->persist($mantenimiento);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El parte se ha creado correctamente";
                }else{
                    $status = "El parte no se ha podido crear";
                }    

            }else{
                $status = "El parte no se ha creado, porque el formuario no es válido";
            }
            //$this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("partes");
        }

        return $this->render("bdBundle:Mantenimiento:addmantenimiento.html.twig", array(
            "form" => $form->createView()
            ));
    }

    public function editmantenimientoAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $mante_repo=$em->getRepository("bdBundle:Mantenimiento");
        $mantenimiento=$mante_repo->find($id);

        $form = $this->createForm(MantenimientoType::class, $mantenimiento);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $mantenimiento->setOperario($form->get("operario")->getData());
                $mantenimiento->setDia($form->get("dia")->getData());
                $mantenimiento->setHoraInicioManana($form->get("hora_inicio_manana")->getData());
                $mantenimiento->setHoraFinManana($form->get("hora_fin_manana")->getData());
                $mantenimiento->setHoraInicioTarde($form->get("hora_inicio_tarde")->getData());
                $mantenimiento->setHoraFinTarde($form->get("hora_fin_tarde")->getData());
                $mantenimiento->setObservaciones($form->get("observaciones")->getData());

                $em->persist($mantenimiento);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El parte se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el parte!!";
                }
            }else{
                $status = "El parte no se ha editado, porque el formulario no es valido !!";
            }
            //$this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("partes");
        }
        return $this->render("bdBundle:Mantenimiento:editmantenimiento.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deletemantenimientoAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $mante_repo=$em->getRepository("bdBundle:Mantenimiento");
        $mantenimiento=$mante_repo->find($id);

            $em->remove($mantenimiento);
            $em->flush();
        

        return $this->redirectToRoute("partes_mantenimiento_list");
    } 

    

}