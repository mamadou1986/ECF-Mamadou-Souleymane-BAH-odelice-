<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ingredient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\rechercheType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function produitsAction($ingredient = null)
    {

        //var_dump($categorie);die();
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();

        if($ingredient != null)
            $produits = $em->getRepository('AppBundle:produits')->byCategorie($ingredient);
        else
        $produits = $em->getRepository('AppBundle:produits')->findBy(array('disponible' => 1));


        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('produits/layout/produits.html.twig', array('produits' =>$produits,'panier' =>$panier));
    }

    /**
     * @Route("/produit/{id}", name="presentation")
     */
    public function presentationAction($id)
    {
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AppBundle:produits')->find($id);

        if(!$produit) throw $this->createNotFoundException("!!!!LA PAGE N'EXISTE PAS");

        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;

        return $this->render('produits/layout/presentation.html.twig', array('produit' =>$produit,'panier' =>$panier));
    }

    /**
     *

    public function categorieAction($categorie)
    {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:produits')->byCategorie($categorie);

        $categorie = $em->getRepository('AppBundle:categorie')->find($categorie);
        if(!$categorie) throw $this->createNotFoundException("!!!!LA PAGE N'EXISTE PAS");

        return $this->render('produits/layout/produits.html.twig', array('produits' =>$produits));
    } */


    /**
     * @Route("/recherche")
     */
    public function rechercheAction()
    {
        $form = $this->createFormBuilder()->add('recherche')->getForm();
        return $this->render('produits/layout/recherche.html.twig', array('form' => $form->createView()));
    }


    public function rechercheTraitementAction(Request $request)
    {
        //$pseudo = filter_input(INPUT_POST, "form[recherche]");
       // $form = $this->createFormBuilder()->add('recherche')->getForm();
        //if(isset($_POST)){
           //$this->get('request_stack')->getCurrentRequest() == 'post'
           // $form->bind($this->get('request_stack'));
            /*echo $form['recherche']->getData();

        }
        die();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AppBundle:produits')->recherche();

        return $this->render('produits/layout/presentation.html.twig', array('produit' =>$produit));*/


        $form = $this->createFormBuilder()->add('recherche')->getForm();


        if (isset($_POST)) {

            //$request = filter_input(INPUT_POST, "form[recherche]");
            //$form->isSubmitted() && $form->isValid()
            $form->handleRequest($request);
             //$form['recherche']->getData();
            //$data = $form["recherche"]->getData();
            //$data = $request->request->get('form');
            //var_dump($data);
            echo $form['recherche']->getData();

           //
        }
        die();
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AppBundle:Produits')->recherche();
        return $this->render('produits/layout/produits.html.twig', array('produit' => $produit));


    }
}
