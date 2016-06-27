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

use bdBundle\Entity\Taller;
use bdBundle\Entity\Obra;
use bdBundle\Form\TallerType;


class TallerController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function indextallerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $taller_repo=$em->getRepository("bdBundle:Taller");
        $taller=$taller_repo->findAll();

        
        return $this->render("bdBundle:Taller:indextaller.html.twig",array(
            "taller" => $taller
        ));
    }  

    public function addtallerAction(Request $request)
    {
        $taller = new Taller();
        $form = $this->createForm(TallerType::class, $taller);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $user = $this->get('security.context')->getToken()->getUser()->getUsername();


                $taller->setOperario($user);
                $taller->setDia($form->get("dia")->getData());
                $taller->setHoraInicioManana($form->get("hora_inicio_manana")->getData());
                $taller->setHoraFinManana($form->get("hora_fin_manana")->getData());
                $taller->setHoraInicioTarde($form->get("hora_inicio_tarde")->getData());
                $taller->setHoraFinTarde($form->get("hora_fin_tarde")->getData());
                $taller->setObservaciones($form->get("observaciones")->getData());

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

                $taller->setTotal($total);

                $em->persist($taller);
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

        return $this->render("bdBundle:Taller:addtaller.html.twig", array(
            "form" => $form->createView()
            ));
    }  

    public function edittallerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $taller_repo=$em->getRepository("bdBundle:Taller");
        $taller=$taller_repo->find($id);

        $form = $this->createForm(TallerType::class, $taller);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $taller->setOperario($form->get("operario")->getData());
                $taller->setDia($form->get("dia")->getData());
                $taller->setHoraInicioManana($form->get("hora_inicio_manana")->getData());
                $taller->setHoraFinManana($form->get("hora_fin_manana")->getData());
                $taller->setHoraInicioTarde($form->get("hora_inicio_tarde")->getData());
                $taller->setHoraFinTarde($form->get("hora_fin_tarde")->getData());
                $taller->setObservaciones($form->get("observaciones")->getData());

                $em->persist($taller);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El parte se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el parte!!";
                }
            }else{
                $status = "El parte no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("partes_taller_list");
        }
        return $this->render("bdBundle:Taller:edittaller.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deletetallerAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $taller_repo=$em->getRepository("bdBundle:Taller");
        $taller=$taller_repo->find($id);

            $em->remove($taller);
            $em->flush();

        return $this->redirectToRoute("partes_taller_list");
    } 
}