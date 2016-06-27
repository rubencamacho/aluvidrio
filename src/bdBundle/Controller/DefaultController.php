<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use bdBundle\Entity\Obra;
use bdBundle\Entity\Costereal;
use bdBundle\Entity\Oferta;
use bdBundle\Entity\Fecha;
use bdBundle\Entity\Parte;
use bdBundle\Entity\Mantenimiento;
use bdBundle\Entity\Taller;

use bdBundle\Form\FechaType;

use Ob\HighchartsBundle\Highcharts\Highchart;

use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	
        return $this->render('bdBundle:Default:index.html.twig');
    }

    // Gráficas y Estadísticas

    public function informesAction()
    {
        return $this->render("bdBundle:Informe:informes.html.twig");
    }

    // Comparación costes de las obras
    public function costeobraAction()
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery
        (
            'SELECT o.id,o.obra,o.cliente, c.coste,co.costeoferta
             FROM bdBundle:Obra o
             JOIN bdBundle:Costereal c WITH c.obra=o.id
             JOIN bdBundle:Oferta co WITH c.obra=co.obra
             WHERE c.coste > :coste
            '
        );
        $query->setParameter('coste','0');
        $datos = $query->getResult();   

        return $this->render('bdBundle:Informe:costeobra.html.twig', compact("datos"));
    }
    // Gráfica comparación costes obras
    public function chartcosteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $costeoferta = new Oferta();
                $oferta_repo=$em->getRepository("bdBundle:Oferta");
                $ofertas=$oferta_repo->findAll();
        $costereal = new Costereal();
                $coste_repo=$em->getRepository("bdBundle:Costereal");
                $costes=$coste_repo->findAll(); 

        $obra = new Obra();
                $obra_repo=$em->getRepository("bdBundle:Obra");
                $obra=$obra_repo->find($id);

       

        foreach ($ofertas as $oferta) {           
            if ($obra == $oferta->getObra()){
                $num1 = ($oferta->getCosteOferta()*100);
                    
            }
        }
        foreach ($costes as $coste) {           
            if ($obra == $coste->getObra()){
                $num2 = $coste->getCoste();
                    
            }
        }


        $beneficios= $num1/$num2;
        $perdidas= 100-$beneficios;
        
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Obras Realizadas');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
        $data = array(
            array('%beneficios', $beneficios),
            array('%perdidas', $perdidas),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));

        return $this->render('bdBundle:Informe:chartcoste.html.twig', array(
            'chart' => $ob,
            'obra' => $obra,
            'costes' => $costes,
            'ofertas' => $ofertas
        ));

    }

    // Informe Operarios

    //Lista de operarios
    public function informeoperarioAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $operario_repo=$em->getRepository("bdBundle:Operario");
        $operarios=$operario_repo->findAll();

        return $this->render('bdBundle:Informe:informeoperario.html.twig',array(
            'operarios' => $operarios
        ));
    }

    public function operariohorasAction($operario, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $fecha = new Fecha();
        $parte = new Parte();
        $total = 0;

        $form = $this->createForm(FechaType::class, $fecha);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $parte_repo=$em->getRepository("bdBundle:Parte");
                $parte=$parte_repo->find($operario);
                $partes=$parte_repo->findAll();               


                $fecha1 = ($form->get("dia_inicio")->getData());
                $fecha2 = ($form->get("dia_fin")->getData());
                $result1 = $fecha1->format('Y-m-d');
                $result2 = $fecha2->format('Y-m-d');

                //echo $result2."<br>";
                for($i=$result1;$i<=$result2;$i=date("Y-m-d", strtotime($i ."+ 1 days")))
                {                    
                    foreach ($partes as $p){
                        $pdia = $p->getDia()->format('Y-m-d');
                        if($pdia == $i && $p->getOperario() == $operario){
                            $total = $total + $p->getTotal();
                        }
                    }
                }                                            
            }
        }

        //echo "El Total de horas en ese intervalo de días es:".$total;

        return $this->render('bdBundle:Informe:operariohoras.html.twig', array(
            "form" => $form->createView(),
            "total" => $total
            ));

    }

    //INFORME MANTENIMIENTO
    public function mantenimientohorasAction($operario, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $fecha = new Fecha();
        $mantenimiento = new Mantenimiento();
        $total = 0;

        $form = $this->createForm(FechaType::class, $fecha);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $mante_repo=$em->getRepository("bdBundle:Mantenimiento");
                //$mante=$mante_repo->find($operario);
                $total_mantenimiento=$mante_repo->findAll();               


                $fecha1 = ($form->get("dia_inicio")->getData());
                $fecha2 = ($form->get("dia_fin")->getData());
                $result1 = $fecha1->format('Y-m-d');
                $result2 = $fecha2->format('Y-m-d');

                //echo $result2."<br>";
                for($i=$result1;$i<=$result2;$i=date("Y-m-d", strtotime($i ."+ 1 days")))
                {                    
                    foreach ($total_mantenimiento as $t){
                        $tdia = $t->getDia()->format('Y-m-d');
                        if($tdia == $i && $t->getOperario() == $operario){
                            $total = $total + $t->getTotal();
                        }
                    }
                }                                            
            }
        }

        //echo "El Total de horas en ese intervalo de días es:".$total;

        return $this->render('bdBundle:Informe:mantenimientohoras.html.twig', array(
            "form" => $form->createView(),
            "total" => $total
            ));

    }

    //INFORME TALLER
    public function tallerhorasAction($operario, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $fecha = new Fecha();
        $taller = new Taller();
        $total = 0;

        $form = $this->createForm(FechaType::class, $fecha);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $taller_repo=$em->getRepository("bdBundle:Taller");
                //$mante=$mante_repo->find($operario);
                $talleres=$taller_repo->findAll();               


                $fecha1 = ($form->get("dia_inicio")->getData());
                $fecha2 = ($form->get("dia_fin")->getData());
                $result1 = $fecha1->format('Y-m-d');
                $result2 = $fecha2->format('Y-m-d');

                //echo $result2."<br>";
                for($i=$result1;$i<=$result2;$i=date("Y-m-d", strtotime($i ."+ 1 days")))
                {                    
                    foreach ($talleres as $t){
                        $tdia = $t->getDia()->format('Y-m-d');
                        if($tdia == $i && $t->getOperario() == $operario){
                            $total = $total + $t->getTotal();
                        }
                    }
                }                                            
            }
        }

        //echo "El Total de horas en ese intervalo de días es:".$total;

        return $this->render('bdBundle:Informe:tallerhoras.html.twig', array(
            "form" => $form->createView(),
            "total" => $total
            ));

    }
}
