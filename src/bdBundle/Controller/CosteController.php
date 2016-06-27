<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


use bdBundle\Entity\Obra;
use bdBundle\Entity\Productosobra;
use bdBundle\Entity\Producto;
use bdBundle\Entity\Costereal;
use bdBundle\Entity\Costeoferta;
use bdBundle\Entity\Oferta;
use bdBundle\Form\CosterealType;
use bdBundle\Form\ProductosobraType;

class CosteController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function postAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Productosobra();
        $coste_repo = $em->getRepository('bdBundle:Productosobra');
        $costes = $coste_repo->findAll();

        $coste = $coste_repo->find($id);

        $producto = new Producto();

        $producto_repo = $em->getRepository('bdBundle:Producto');
        $productos = $coste_repo->findAll();

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

    public function postundAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Productosobra();

        $coste_repo = $em->getRepository('bdBundle:Productosobra');
        $costes_obras = $coste_repo->findAll();

        $coste = $coste_repo->find($id);

        $costereal_repo=$em->getRepository("bdBundle:Costereal");
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
                $c->setCoste($precio);
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
/*      EDITAR CODIGO PRODUCTO 

    public function postcodprodAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Productosobra();
        $coste_repo = $em->getRepository('bdBundle:Productosobra');
        

        $coste = $coste_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));   
        
        $coste->setCodprod($value);
           
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
        
/*        $returnData = json_encode($returnData);
        
        /* Finally, construct a response object to send the data to the browser with our data */
        
        /* Send the data with a HTTP status code 200 for "Okay" and the correct content encoding */
        
/*        return new Response( $returnData ,200 , array('Content-Type'=>'application/json') );            
           
    }
*/
    public function postalbaranAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Productosobra();
        $coste_repo = $em->getRepository('bdBundle:Productosobra');
        

        $coste = $coste_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));   
        
        $coste->setAlbaran($value);
           
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

    public function postproveedorAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Productosobra();
        $coste_repo = $em->getRepository('bdBundle:Productosobra');
        

        $coste = $coste_repo->find($id);

        $request = Request::createFromGlobals();
    
        // Get the edited data content from the request object
        // Pass through htmlentities to make the data safe and to make sure that it is escaped properly
        $value = htmlentities($request->request->get('value'));   
        
        $coste->setProveedor($value);
           
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

    public function postprecioAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $coste = new Productosobra();

        $coste_repo = $em->getRepository('bdBundle:Productosobra');
        $costes_obras = $coste_repo->findAll();

        $coste = $coste_repo->find($id);

        $costereal_repo=$em->getRepository("bdBundle:Costereal");
        $costes = $costereal_repo->findAll();

        $obra = $coste->getObra()->getId();

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
                $c->setCoste($precio);
                $em->persist($c);
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

    public function costeobraAction($id,Request $request)
    {       
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p 
                FROM bdBundle:Productosobra p 
                WHERE p.obra = :id";
        $query = $em->createQuery($dql)
                ->setParameter("id", $id);
        $datos = $query->getResult();

        $em = $this->getDoctrine()->getManager();
        $producto_repo=$em->getRepository("bdBundle:Productosobra");
        $producto=$producto_repo->findAll();
        $p=$producto_repo->find($id);
        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obra=$obra_repo->find($id);
        $oferta_repo=$em->getRepository("bdBundle:Oferta");
        $ofertas=$oferta_repo->findAll($id);
        $prod_repo = $em->getRepository('bdBundle:Producto');
        $prod = $prod_repo->findAll();


        //Formulario para crear nuevo coste
        $productos_obra = new Productosobra();
        $coste = new Costereal();

        $form = $this->createForm(ProductosobraType::class, $productos_obra);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();

                //Obtener el id de la obra
                $obra = new Obra();
                $obra_repo=$em->getRepository("bdBundle:Obra");
                $obra=$obra_repo->find($id);

                $productos_obra->setProveedor($form->get("proveedor")->getData());
                $productos_obra->setAlbaran($form->get("albaran")->getData());
                $productos_obra->setCodProd($form->get("codprod")->getData());
                $productos_obra->setPrefijo($form->get("prefijo")->getData());
                $productos_obra->setDescripcion($productos_obra->getCodprod()->getDescripcion());
                $productos_obra->setPrecio(0);
                $productos_obra->setUnd(1);
                $productos_obra->setObra($obra);

                $em->persist($productos_obra);
                
                

                $coste_repo=$em->getRepository("bdBundle:Costereal");
                $costes = $coste_repo->findAll();


            /*    if($costes==null){
                    $coste->setCoste($form->get("precio")->getData());
                    //$coste->setProducto($form->get("producto")->getData());
                    $coste->setObra($obra);
                    //$obra->setPresupuesto(1);
                    $em->persist($obra);
                    $em->persist($coste);
                    $em->persist($productos_obra);
                }
            */
                $precio = $productos_obra->getPrecio() * $productos_obra->getUnd();
                foreach ($producto as $p) {
                    if($obra == $p->getObra()) { 
                        $total = $p->getPrecio() * $p->getUnd();
                        $precio = $total + $precio;                
                    }else{

                    }
                }   

                foreach ($costes as $c) {
                     if($obra == $c->getObra()){                        
                        $c->setCoste($precio);
                        $em->persist($c);
                        //$em->flush();
                    }
                }

                $flush = $em->flush();
                
                
                

                if($flush==null){
                    $status = "El coste se ha añadido correctamente";
                }else{
                    $status = "El coste no se ha podido añadir";
                } 
            }else{
                $status = "El coste no se ha creado, porque el formuario no es válido";
            }
            return $this->redirectToRoute("obra_coste", array('id' => $productos_obra->getObra()->getId()));
        }

        return $this->render('bdBundle:Coste:costeobra.html.twig', array(
            "datos" => $datos,
            "producto" => $producto,
            "obra" => $obra,
            "p" => $p,
            "ofertas" => $ofertas,
            "prod" => $prod,
            "form" => $form->createView()));
    }


    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $producto_repo=$em->getRepository("bdBundle:Productosobra");
        $productos=$producto_repo->findAll($id);

        $producto=$producto_repo->find($id);

        $coste_repo=$em->getRepository("bdBundle:Costereal");
        $costes = $coste_repo->findAll();

        $obra = $producto->getObra()->getId();

        $form = $this->createForm(ProductosobraType::class, $producto);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $producto->setProveedor($form->get("proveedor")->getData());
                $producto->setAlbaran($form->get("albaran")->getData());
                $producto->setCodProd($form->get("codprod")->getData());
                $producto->setPrefijo($form->get("prefijo")->getData());

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
                foreach ($costes as $c) {
                    if($obra == $c->getObra()->getId()){
                        $c->setCoste($precio);
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
            return $this->redirectToRoute("obra_coste", array('id' => $producto->getObra()->getId()));
        }
        return $this->render("bdBundle:Coste:edit.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id, Request $request) {
        $em=$this->getDoctrine()->getManager();
        $producto_repo=$em->getRepository("bdBundle:Productosobra");
        $producto=$producto_repo->find($id);

        $coste_repo=$em->getRepository("bdBundle:Costereal");
        $costes = $coste_repo->findAll();

        $obra = $producto->getObra()->getId();

        $cantidad = $producto->getUnd() * $producto->getPrecio();

        foreach ($costes as $c) {
            if($obra == $c->getObra()->getId()){
                $total = $c->getCoste();
                $precio = $total - $cantidad;
                $c->setCoste($precio);
            }
        }

            $em->remove($producto);
            $em->flush();
        
            return $this->redirectToRoute("obra_coste", array('id' => $producto->getObra()->getId()));
    } 
    

    public function costerealejecucionAction(Request $request)
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
      

        

        return $this->render('bdBundle:Coste:costerealejecucion.html.twig', compact("datos"));
    }

    public function costerealAction($id,Request $request)
    {       
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p FROM bdBundle:Productosobra p "
                . " WHERE p.obra = :id";
        $query = $em->createQuery($dql)
                ->setParameter("id", $id);
        $datos = $query->getResult();

        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obra=$obra_repo->find($id);

        $producto_repo=$em->getRepository("bdBundle:Productosobra");
        $productos=$producto_repo->findAll();

        $oferta_repo=$em->getRepository("bdBundle:Costeoferta");
        $ofertas=$oferta_repo->findAll();



        return $this->render('bdBundle:Coste:costereal.html.twig', compact("datos", "costeoferta", "ofertas", "productos", "obra", "codprod"));
    }

    
}
