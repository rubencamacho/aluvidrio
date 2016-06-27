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

use bdBundle\Entity\Producto;
use bdBundle\Entity\Proveedor;
use bdBundle\Form\ProductoType;


class ProductoController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $producto_repo=$em->getRepository("bdBundle:Producto");
        $productos=$producto_repo->findAll();

        
        return $this->render("bdBundle:Producto:index.html.twig",array(
            "productos" => $productos
        ));
    }

    public function addAction(Request $request)
    {
        $producto = new Producto();

        $form = $this->createForm(ProductoType::class, $producto);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();

                $producto->setPrefijo($form->get("prefijo")->getData());
                $producto->setCodProd($form->get("codprod")->getData());
                $producto->setDescripcion($form->get("descripcion")->getData());

                $em->persist($producto);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El producto se ha creado correctamente";
                }else{
                    $status = "El producto no se ha podido crear";
                }    

            }else{
                $status = "El producto no se ha creado, porque el formuario no es válido";
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("producto_index");
        }
        return $this->render("bdBundle:Producto:add.html.twig", array(
            "form" => $form->createView()
            ));
    }
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $producto_repo=$em->getRepository("bdBundle:Producto");
        $producto=$producto_repo->find($id);

        $form = $this->createForm(ProductoType::class, $producto);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $producto->setPrefijo($form->get('prefijo')->getData());
                $producto->setCodProd($form->get('codprod')->getData());
                $producto->setDescripcion($form->get('descripcion')->getData());
                 
                $em->persist($producto);
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
            return $this->redirectToRoute("producto_index");
        }
        return $this->render("bdBundle:Producto:edit.html.twig",array(
            "form" => $form->createView()
        ));
    }

     public function deleteAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getEntityManager();
        $producto_repo=$em->getRepository("bdBundle:Producto");
        $producto=$producto_repo->find($id);

            $em->remove($producto);
            $em->flush();

        return $this->redirectToRoute("producto_index");
    } 

/*
    public function indexproductoAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $producto_repo=$em->getRepository("bdBundle:Producto");
        $productos=$producto_repo->findAll();
        
        return $this->render("bdBundle:Producto:indexproducto.html.twig",array(
            "productos" => $productos
        ));
    }   

    public function addproductoAction(Request $request){
        $producto = new Producto();
        $form = $this->createForm(ProductoType::class,$producto);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                
                $em = $this->getDoctrine()->getEntityManager();
                
                #$producto = new Producto();
                #$producto->setDescripcion($form->get("descripcion")->getData());
                #$producto->setUnd($form->get("und")->getData());
                #$producto->setPrecio($form->get("precio")->getData());

                # No producto repetido #
                $producto_repo=$em->getRepository("bdBundle:Producto");
                $producto = $producto_repo->findOneBy(array("descripcion"=>$form->get("descripcion")->getData()));

                if(count($producto)==0){
                    $producto = new Producto();
                    $producto->setDescripcion($form->get("descripcion")->getData());
                    $producto->setUnd($form->get("und")->getData());
                    $producto->setPrecio($form->get("precio")->getData());
                    $em = $this->getDoctrine()->getEntityManager();

                    $em->persist($producto);
                    $flush = $em->flush();

                    if($flush==null){
                        $status = "El producto se ha creado correctamente";
                    }else{
                        $status = "El producto no se ha creado";
                    }

                }else{
                    $em->remove($producto);
                    $producto = new Producto();
                    $producto->setDescripcion($form->get("descripcion")->getData());
                    $producto->setUnd($form->get("und")->getData());
                    $producto->setPrecio($form->get("precio")->getData());
                    $em->persist($producto);
                    $flush = $em->flush();
                    $status = "El producto ya existe";
                }
                #  #


                
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
            return $this->redirectToRoute("producto_list");
        }
        
        
        return $this->render("bdBundle:Producto:addproducto.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deleteproductoAction($id){
        $em=$this->getDoctrine()->getEntityManager();
        $producto_repo=$em->getRepository("bdBundle:Producto");
        $producto=$producto_repo->find($id);

        if(count($producto->getobra())==0){
            $em->remove($producto);
            $em->flush();
        }

        return $this->redirectToRoute("obra_list");
    }

    public function editproductoAction(Request $request, $id){
        $em = $this->getDoctrine()->getEntityManager();
        $producto_repo=$em->getRepository("bdBundle:Producto");
        $producto=$producto_repo->find($id);
        $productos = $producto_repo->findAll();

        $coste_repo=$em->getRepository("bdBundle:Costereal");
        $costes=$coste_repo->findAll();
        $costeproducto=$coste_repo->findAll();

        $obra = new Obra();
        $obra_repo=$em->getRepository("bdBundle:Obra");
        $obra=$obra_repo->find($id);

        
        $form = $this->createForm(ProductoType::class,$producto);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){
            if($form->isValid()){
                
                $producto->setDescripcion($form->get("descripcion")->getData());
                $producto->setUnd($form->get("und")->getData());
                $producto->setPrecio($form->get("precio")->getData());

                
                    $total= ($producto->getUnd() * $producto->getPrecio());
                    foreach ($costes as $coste) {
                        if($coste->getProducto()==$producto){
                            $em->remove($coste);
                            $coste->setCoste($total);
                            $coste->setProducto($producto);
                            $em->persist($coste);
                            $flush = $em->flush();
                        }
                    }
                $em->persist($producto);
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
            return $this->redirectToRoute("producto_list");
        }
        
        return $this->render("bdBundle:Producto:editproducto.html.twig",array(
            "form" => $form->createView()
        ));
    }
*/
}