<?php
/**
 * Created by PhpStorm.
 * User: Sow
 * Date: 15/08/2018
 * Time: 19:04
 */
namespace AppBundle\Controller;

use AppBundle\Entity\user;
use AppBundle\Entity\userAdress;
use AppBundle\Form\userAdressType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use Symfony\Component\HttpFoundation\RedirectResponse;
class PanierController extends Controller
{
    /**
     * @Route("/panier", name="panier")
     */
    public function panierAction(Request $request)
    {
        //$session = new Session(new NativeSessionStorage(), new AttributeBag());
        $session = $this->get('session');
        //$session->clear();$session->get('qte')
        if (!$session->has('panier')) $session->set('panier', array());
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:produits')->findArray(array_keys($session->get('panier')));
       // var_dump($session->get('panier'));
        //var_dump($request->query->get('qte'));

        //die();
        return $this->render('panier/layout/panier.html.twig', array('produits' => $produits,
                                                                           'panier' => $session->get('panier')));
    }

    public function menuAction()
    {
        $session = $this->get('session');
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('panier/layout/module_inc/panier.html.twig', array('articles' => $articles));
    }

    public function adresseSuppressionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('AppBundle:UserAdress')->find($id);

        if ($this->container->get('security.context')->getToken()->getUser() != $entity->getUtilisateur() || !$entity)
            return $this->redirect ($this->generateUrl ('livraison'));

        $em->remove($entity);
        $em->flush();

        return $this->redirect ($this->generateUrl ('livraison'));
    }


    /**
     * @Route("/livraison", name="livraison")
     */
    public function livraisonAction(Request $request)
    {
        //$user = new user();$this->container->get('securityContext')->getToken()->getUser();
        $entity = new userAdress();
        $form = $this->createForm(userAdressType::class, $entity);


       /* if ($this->get('request')->getMethod() == 'POST')
        {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $entity->setUser($user);
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('livraison'));
            }
        }*/

        return $this->render('panier/layout/livraison.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/validation", name="validation")
     */
    public function valideAction(Request $request)
    {

        return $this->render('panier/layout/validation.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function supprimerAction($id)
    {
        $session = $this->get('session');
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
            $this->addFlash('success','Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('panier'));
    }

    public function ajouterAction(Request $request,$id)
    {
        // $session = $this->getDoctrine()->getManager();
        $session = $this->get('session');
        if (!$session->has('panier'))
            $session->set('panier',array());
            $panier = $session->get('panier');
        $qte = $request->query->get('qte', 1);


        if (array_key_exists($id, $panier)) {
            if ($qte != null) $panier[$id] =  $request->query->get('qte');
            $this->addFlash('success','Quantité modifié avec succès');
        } else {
            if ($qte != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

            $this->addFlash('success','Article ajouté avec succès');
        }

        $session->set('panier',$panier);


        return $this->redirect($this->generateUrl('panier'));
    }
}
