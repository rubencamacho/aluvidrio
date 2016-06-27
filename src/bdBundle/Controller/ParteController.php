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

use bdBundle\Entity\Parte;
use bdBundle\Entity\Obra;
use bdBundle\Form\ParteType;

use Symfony\Component\Validator\Constraints\DateTime;



class ParteController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function partesAction(Request $request)
    {
        return $this->render("bdBundle:Parte:partes.html.twig");
    }

    public function indexobraAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obras=$obra_repo->findAll();

        
        return $this->render("bdBundle:Parte:indexobra.html.twig",array(
            "obras" => $obras
        ));
    }

     public function addobraAction($id, Request $request)
    {
        $parte = new Parte();
        $form = $this->createForm(ParteType::class, $parte);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $obra = new Obra();
                $obra_repo=$em->getRepository("bdBundle:Obra");
                $obra=$obra_repo->find($id);

                $user = $this->get('security.context')->getToken()->getUser()->getUsername();


                $parte->setOperario($user);
                $parte->setDia($form->get("dia")->getData());
                $parte->setHoraInicioManana($form->get("hora_inicio_manana")->getData());
                $parte->setHoraFinManana($form->get("hora_fin_manana")->getData());
                $parte->setHoraInicioTarde($form->get("hora_inicio_tarde")->getData());
                $parte->setHoraFinTarde($form->get("hora_fin_tarde")->getData());
                $parte->setObservaciones($form->get("observaciones")->getData());
                $parte->setObra($obra);

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

                $parte->setTotal($total);

                $em->persist($parte);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El parte se ha creado correctamente";
                }else{
                    $status = "El parte no se ha podido crear";
                }    

            }else{
                $status = "El parte no se ha creado, porque el formuario no es válido";
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("partes_list");
        }

        return $this->render("bdBundle:Parte:addobra.html.twig", array(
            "form" => $form->createView()
            ));
    }

    public function partesobraAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p.id,p.operario,p.dia,p.hora_inicio_manana,p.hora_fin_manana,p.hora_fin_tarde, p.hora_inicio_tarde, p.hora_fin_tarde, p.observaciones FROM bdBundle:Parte p "
                . " WHERE p.obra = :id";
        $query = $em->createQuery($dql)
                ->setParameter("id", $id);
        $datos = $query->getResult();   
        
        return $this->render("bdBundle:Parte:partesobra.html.twig",array(
            "datos" => $datos
        ));
    }

    public function editobraAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $parte_repo=$em->getRepository("bdBundle:Parte");
        $parte=$parte_repo->find($id);

        $form = $this->createForm(ParteType::class, $parte);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $parte->setOperario($form->get("operario")->getData());
                $parte->setDia($form->get("dia")->getData());
                $parte->setHoraInicioManana($form->get("hora_inicio_manana")->getData());
                $parte->setHoraFinManana($form->get("hora_fin_manana")->getData());
                $parte->setHoraInicioTarde($form->get("hora_inicio_tarde")->getData());
                $parte->setHoraFinTarde($form->get("hora_fin_tarde")->getData());
                $parte->setObservaciones($form->get("observaciones")->getData());

                $em->persist($parte);
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
            return $this->redirectToRoute("partes_list");
        }
        return $this->render("bdBundle:Parte:editobra.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deleteobraAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $parte_repo=$em->getRepository("bdBundle:Parte");
        $parte=$parte_repo->find($id);

            $em->remove($parte);
            $em->flush();
        

        return $this->redirectToRoute("partes_list");
    } 

    

}