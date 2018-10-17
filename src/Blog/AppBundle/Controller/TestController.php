<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\produits;
use AppBundle\Form\testType;

class TestController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function testFormAction(){

        $form = $this->createForm( testType::class);

        return $this->render('default/test.html.twig', array('form' => $form->createView()));

    }
    /* public function ajoutAction(Request $request)
     {
         $em = $this->getDoctrine()->getManager();


       /*$produits = new produits();

         $produits->setCategorie('legume');
         $produits->setDisponible('15');
         $produits->setnom('concombre');
         $produits->setPrix('0.75');
         $produits->setTva('19.6');
         $produits->setImage('https://www.lesfruitsetlegumesfrais.com/_upload/cache/ressources/produits/concombre/concombre_346_346_filled.jpg');

         $em->persist($produits);
         $em->flush();
         die('ici ça pointe');

        $produits = $em->getRepository('AppBundle:produits')->findAll();

        return $this->render('default/test.html.twig', array('produits' => $produits));
    }*/


}
