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

use bdBundle\Entity\User;
use bdBundle\Form\UserType;


class UserController extends Controller
{
	private $session;
	
	public function __construct() {
		$this->session=new Session();
	}

    public function loginAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        

        return $this->render("bdBundle:User:login.html.twig", array(
            "error" => $error,
            "last_username" => $lastUsername
            ));
    }
    public function registerAction(Request $request){

    	$user = new User();
		$form = $this->createForm(UserType::class,$user);
		
		$form->handleRequest($request);
			if($form->isSubmitted()){
				if($form->isValid()){
					$em=$this->getDoctrine()->getManager();
					$user_repo=$em->getRepository("bdBundle:User");
					$user = $user_repo->findOneBy(array("username"=>$form->get("username")->getData()));
					
					if(count($user)==0){
						$user = new User();
						$user->setUsername($form->get("username")->getData());
						$user->setname($form->get("name")->getData());

						$factory = $this->get("security.encoder_factory");
						$encoder = $factory->getEncoder($user);
						$password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());

						$user->setPassword($password);
						$user->setRole($form->get('role')->getData());

						$em = $this->getDoctrine()->getManager();
						$em->persist($user);
						$flush = $em->flush();
						if($flush==null){
							$status = "El usuario se ha creado correctamente";
						}else{
							$status = "No te has registrado correctamente";
						}
					}else{
						$status = "El usuario ya existe!!!";
					}
				}else{
					$status = "No te has registrado correctamente";
				}

				$this->session->getFlashBag()->add("status",$status);
				return $this->redirectToRoute("user_index");
			}


		return $this->render('bdBundle:User:register.html.twig',array("form"=>$form->createView()));

		}

	 
	public function indexAction()
	{
	    $em = $this->getDoctrine()->getManager();
        $user_repo=$em->getRepository("bdBundle:User");
        $users=$user_repo->findAll();

        
        return $this->render("bdBundle:User:index.html.twig",array(
            "users" => $users
        ));
	}

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user_repo=$em->getRepository("bdBundle:User");
        $user=$user_repo->find($id);

        $editform = $this->createForm(UserType::class, $user);
        
        $editform->handleRequest($request);

        if($editform->isSubmitted()){
            if($editform->isValid()){
                $user->setUsername($editform->get("username")->getData());
                $user->setname($editform->get("name")->getData());

                $factory = $this->get("security.encoder_factory");
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword($editform->get("password")->getData(), $user->getSalt());

                $user->setPassword($password);
                $user->setRole($editform->get('role')->getData());
                
                $em->persist($user);
                $flush = $em->flush();

                if($flush==null){
                    $status = "El usuario se ha editado correctamente !!";
                }else{
                    $status ="Error al editar el usuario!!";
                }
            }else{
                $status = "El usuario no se ha editado, porque el formulario no es valido !!";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("user_index");
        }
        return $this->render("bdBundle:User:edit.html.twig",array(
            "form" => $editform->createView()
        ));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getEntityManager();
        $user_repo=$em->getRepository("bdBundle:user");
        $user=$user_repo->find($id);

            $em->remove($user);
            $em->flush();
        

        return $this->redirectToRoute("user_index");
    }
}
