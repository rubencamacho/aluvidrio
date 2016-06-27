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

use bdBundle\Entity\Costeoferta;
use bdBundle\Entity\Oferta;
use bdBundle\Entity\Obra;
use bdBundle\Form\OfertaType;
use bdBundle\Form\CosteofertaType;
use bdBundle\Entity\Producto;
use bdBundle\Entity\Productosobra;



class CosteOfertaController extends Controller{

    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

     public function postAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Costeoferta();
        $coste_repo = $em->getRepository('bdBundle:Costeoferta');
        $costes = $coste_repo->findAll();

        $coste = $coste_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));   
        
        $coste->setDescripcion($value);          
        $em->persist($coste);
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

    public function postcodigoAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Costeoferta();
        $coste_repo = $em->getRepository('bdBundle:Costeoferta');
        $costes = $coste_repo->findAll();

        $coste = $coste_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));   
        
        $coste->setCodOferta($value);          
        $em->persist($coste);
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

    public function postundAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Costeoferta();

        $coste_repo = $em->getRepository('bdBundle:Costeoferta');
        $costes_obras = $coste_repo->findAll();

        $coste = $coste_repo->find($id);

        $costereal_repo=$em->getRepository("bdBundle:Oferta");
        $costes = $costereal_repo->findAll();

        $obra = $coste->getObra()->getId();

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value')); 

        $coste->setUnd($value);

           
        $em->persist($coste);
        //$em->persist($producto);

        $flush = $em->flush();   
        $precio = 0;
        foreach ($costes_obras as $c) {
            if($obra == $c->getObra()->getId()) { 
                $total = $c->getPrecio() * $c->getUnd();
                $precio = $total + $precio;
            }else{

            }
        }   
        
        foreach ($costes as $c) {
            if($obra == $c->getObra()->getId()){
                $c->setCosteoferta($precio);
                $em->persist($c);
                $em->flush();
            }
        }
  

        if($id != "")
        {
            // Populate an array with the response code and the data we want to send back to the browser
            // We can json encode the data from an array easily using built in functions   
            
            $returnData = array("responseCode"=>200, 'coste' => $precio);
        
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

    public function postprecioAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Costeoferta();

        $coste_repo = $em->getRepository('bdBundle:Costeoferta');
        $costes_obras = $coste_repo->findAll();

        $producto_repo = $em->getRepository('bdBundle:Productosobra');
        $productos_obra = $producto_repo->findAll();

        $coste = $coste_repo->find($id);

        $costereal_repo=$em->getRepository("bdBundle:Oferta");
        $costes = $costereal_repo->findAll();

        $obra = $coste->getObra()->getId();
        $prefijo = $coste->getPrefijo()->getPrefijo();
        $codprod = $coste->getProducto()->getCodprod();

        

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));   
        
        $coste->setPrecio($value);
           
        $em->persist($coste);
        //$em->persist($producto);

        $flush = $em->flush(); 

        $precio = 0;
        foreach ($costes_obras as $c) {
            if($obra == $c->getObra()->getId()) { 
                $total = $c->getPrecio() * $c->getUnd();
                $precio = $total + $precio;
            }else{

            }
        }   
        
        foreach ($costes as $c) {
            if($obra == $c->getObra()->getId()){
                $c->setCosteoferta($precio);
                $em->persist($c);
                $em->flush();
            }
        }  

        foreach ($productos_obra as $po) {
            if($obra == $po->getObra()->getId() && $prefijo == $po->getPrefijo()->getPrefijo() && $codprod == $po->getCodprod()->getCodprod()){
                $po->setOferta($value);
                $em->persist($po);
                $em->flush();
            }
        }

        

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

        $query = $em->createQuery
        (
            'SELECT o.cliente,o.presupuesto, o.estado,o.obra, o.fecha, co.costeoferta,o.id,cr.coste, co.id as obra_id
             FROM bdBundle:Oferta co 
             JOIN bdBundle:Obra o WITH co.obra=o.id
             JOIN bdBundle:Costereal cr With cr.obra=o.id
             WHERE o.presupuesto = :presupuesto
            '
        );
        $query->setParameter('presupuesto', '1');
        $datos = $query->getResult();    

        
        return $this->render("bdBundle:CosteOferta:index.html.twig",array(
            "datos" => $datos
        ));
    }

    public function costeofertaAction($id,Request $request)
    {       
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT o FROM bdBundle:Costeoferta o "
                . " WHERE o.obra = :id";
        $query = $em->createQuery($dql)
                ->setParameter("id", $id);
        $datos = $query->getResult();

        $em = $this->getDoctrine()->getManager();

        $producto_repo=$em->getRepository("bdBundle:Costeoferta");
        $producto=$producto_repo->findAll();

        $p=$producto_repo->find($id);

        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obra=$obra_repo->find($id);

        $oferta_repo=$em->getRepository("bdBundle:Oferta");
        $ofertas=$oferta_repo->findAll($id);

        $prod_repo = $em->getRepository('bdBundle:Producto');
        $prod = $prod_repo->findAll();

        

        
        //Formulario para añadir productos a la oferta
        $coste = new Costeoferta();
        $oferta = new Oferta();
        $productos_obra = new Productosobra();

        $form = $this->createForm(CosteofertaType::class,$coste);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                
                $em = $this->getDoctrine()->getManager();

                $obra = new Obra();
                $obra_repo=$em->getRepository("bdBundle:Obra");
                $obra=$obra_repo->find($id);              

                $coste->setObra($obra);
                $coste->setUnd(1);
                $coste->setPrecio(0);
                $coste->setDescripcion($coste->getProducto()->getDescripcion());
                $coste->setProducto($form->get('producto')->getData());
                $coste->setPrefijo($form->get('prefijo')->getData());

                $productos_obra->setObra($obra);
                $productos_obra->setUnd(1);
                $productos_obra->setDescripcion($coste->getProducto()->getDescripcion());
                $productos_obra->setPrefijo($form->get('prefijo')->getData());
                $productos_obra->setCodprod($form->get('producto')->getData());
                $productos_obra->setOferta(0);
                $productos_obra->setPrecio(0);
                $productos_obra->setAlbaran('Albarán');
                $productos_obra->setProveedor('Proveedor');



                $em->persist($coste);
                $em->persist($productos_obra);

                $oferta_repo=$em->getRepository("bdBundle:Oferta");
                $ofertas = $oferta_repo->findAll();

                $precio = $coste->getPrecio() * $coste->getUnd();
                foreach ($producto as $p) {
                    if($obra == $p->getObra()) { 
                        $total = $p->getPrecio() * $p->getUnd();
                        $precio = $total + $precio;                
                    }else{

                    }
                }
                foreach ($ofertas as $c) {
                     if($obra == $c->getObra()){                        
                        $c->setCosteoferta($precio);
                        $em->persist($c);
                        //$em->flush();
                    }
                }
                
                

                $flush=$em->flush();

                if($flush==null){
                    $status = "El producto se ha añadido correctamente !!";
                }else{
                    $status ="Error al añadir el producto!!";
                }

            }else{
                $status = "El producto no se ha añadido correctamente, porque el formulario no es válido";
            }
            return $this->redirectToRoute("costeoferta_index", array('id' => $coste->getObra()->getId()));
        }
    

        return $this->render('bdBundle:CosteOferta:costeoferta.html.twig', array(
            "datos" => $datos,
            "producto" => $producto,
            "obra" => $obra,
            "p" => $p,
            "ofertas" => $ofertas,
            "prod" => $prod,
            "form" => $form->createView()
            ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $producto_repo=$em->getRepository("bdBundle:Costeoferta");
        $productos = $producto_repo->findAll();

        $producto=$producto_repo->find($id);

        $oferta_repo=$em->getRepository("bdBundle:Oferta");
        $ofertas = $oferta_repo->findAll();

        $obra = $producto->getObra()->getId();

        $form = $this->createForm(CosteofertaType::class, $producto);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $producto->setPrefijo($form->get("prefijo")->getData());
                $producto->setCodOferta($form->get("producto")->getData());
                $producto->setPrecio($form->get("precio")->getData());

                $em->persist($producto);
                $flush = $em->flush();

                $precio = 0;
                foreach ($productos as $c) {
                    if($obra == $c->getObra()->getId()) { 
                        $total = $c->getPrecio() * $c->getUnd();
                        $precio = $total + $precio;
                    }else{

                    }
                }   
                
                foreach ($ofertas as $c) {
                    if($obra == $c->getObra()->getId()){
                        $c->setCosteoferta($precio);
                        $em->persist($c);
                        $em->flush();
                    }
                } 

                if($flush==null){
                    $status = "El producto se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el producto!!";
                }
            }else{
                $status = "El producto no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("costeoferta_index", array('id' => $producto->getObra()->getId()));
        }
        return $this->render("bdBundle:Costeoferta:edit.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id, Request $request) {
        $em=$this->getDoctrine()->getManager();
        $producto_repo=$em->getRepository("bdBundle:Costeoferta");
        $producto=$producto_repo->find($id);

        $coste_repo=$em->getRepository("bdBundle:Oferta");
        $costes = $coste_repo->findAll();

        $obra = $producto->getObra()->getId();

        $cantidad = $producto->getUnd() * $producto->getPrecio();

        foreach ($costes as $c) {
            if($obra == $c->getObra()->getId()){
                $total = $c->getCosteoferta();
                $precio = $total - $cantidad;
                $c->setCosteoferta($precio);
            }
        }

            $em->remove($producto);
            $em->flush();
        
            return $this->redirectToRoute("costeoferta_index", array('id' => $producto->getObra()->getId()));
    } 
}