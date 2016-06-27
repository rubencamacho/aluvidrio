<?php

namespace bdBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

use bdBundle\Entity\Proveedor;
use bdBundle\Entity\Producto;
use bdBundle\Entity\Proveedor_Producto;
use bdBundle\Form\ProveedorType;
use bdBundle\Form\Proveedor_ProductoType;


class ProveedorController extends Controller
{
    private $session;
    
    public function __construct() {
        $this->session=new Session();
    }
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $proveedor_repo=$em->getRepository("bdBundle:Proveedor");
        $proveedores=$proveedor_repo->findAll();

        
        return $this->render("bdBundle:Proveedor:index.html.twig",array(
            "proveedores" => $proveedores
        ));
    }

    public function addAction(Request $request)
    {
        $proveedor = new Proveedor();
        $producto = new Producto();
        $form = $this->createForm(ProveedorType::class, $proveedor);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                $proveedor->setCodProv($form->get("codprov")->getData());
                $proveedor->setProveedor($form->get("proveedor")->getData());
                //$proveedor->setProducto($form->get("producto")->getData());

                $em = $this->getDoctrine()->getManager();

                $proveedor_repo=$em->getRepository("bdBundle:Proveedor");
                $proveedores=$proveedor_repo->findAll();

                

                $em->persist($proveedor);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El proveedor se ha creado correctamente";
                }else{
                    $status = "El proveedor no se ha podido crear";
                }    

            }else{
                $status = "El provedor no se ha creado, porque el formuario no es válido";
            }
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("proveedores_list");
        }

        return $this->render("bdBundle:Proveedor:add.html.twig", array(
            "form" => $form->createView()
            ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $proveedor_repo=$em->getRepository("bdBundle:Proveedor");
        $proveedor=$proveedor_repo->find($id);

        $form = $this->createForm(ProveedorType::class, $proveedor);
        
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                $proveedor->setCodProv($form->get("codprov")->getData());
                $proveedor->setProveedor($form->get("proveedor")->getData());

                $em->persist($proveedor);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El proveedor se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el proveedor!!";
                }
            }else{
                $status = "El proveedor no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("proveedores_list");
        }
        return $this->render("bdBundle:Proveedor:edit.html.twig",array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $proveedor_repo=$em->getRepository("bdBundle:Proveedor");
        $proveedor=$proveedor_repo->find($id);

            $em->remove($proveedor);
            $em->flush();
        

        return $this->redirectToRoute("proveedores_list");
    }


    // Proveedor Producto
    public function addproveedorproductoAction(Request $request)
    {
        $proveedor_producto = new Proveedor_Producto();
        $producto = new Producto();
        $form = $this->createForm(Proveedor_ProductoType::class, $proveedor_producto);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();

                //$proveedor->setCodProv($form->get("codprov")->getData());
                $proveedor_producto->setProveedor($form->get("proveedor")->getData());
                $proveedor_producto->setProducto($form->get("producto")->getData());
                $proveedor_producto->setPrecio($form->get("precio")->getData());

                $em = $this->getDoctrine()->getManager();

                

                

                $em->persist($proveedor_producto);
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
            return $this->redirectToRoute("proveedores_list");
        }

        return $this->render("bdBundle:Proveedor:addproveedorproducto.html.twig", array(
            "form" => $form->createView()
            ));
    }

    public function productosAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $producto_repo=$em->getRepository("bdBundle:Producto");
        $productos=$producto_repo->findAll();

        return $this->render('bdBundle:Proveedor:productos.html.twig', array(
            "productos" => $productos
            ));

    }

    public function verproveedoresAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT p FROM bdBundle:Proveedor_Producto p "
                . " WHERE p.producto = :id";
        $query = $em->createQuery($dql)
                ->setParameter("id", $id);
        $datos = $query->getResult();

        return $this->render('bdBundle:Proveedor:verproveedores.html.twig', array(
            "datos" => $datos
            ));
    }

}