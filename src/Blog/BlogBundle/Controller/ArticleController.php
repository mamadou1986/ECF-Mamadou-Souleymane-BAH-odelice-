<?php

namespace Blog\BlogBundle\Controller;

use Blog\BlogBundle\Entity\Article;
use Blog\BlogBundle\Entity\Comment;
use Blog\BlogBundle\Form\ArticleType;
use Blog\BlogBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package Blog\BlogBundle\Controller
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/list", name="blog")
     */
    public function indexAction(Request $request)
    {
        $articles = $this->getDoctrine()
            ->getRepository('BlogBundle:Article')
            ->findAll();

        $reservations  = $this->get('knp_paginator')->paginate(
            $articles,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/, 8/*nbre d'éléments par page*/
        );
        return $this->render('BlogBundle:Article:index.html.twig', ['articles' => $reservations]);
    }





    /**
     * @Route("/show/{id}", name="details")
     */
    public function detailsAction( Article $article = null, Request $request)
    {
        //Instanciation d' une entité commentaire
        $comment = new Comment();
        //Liaison entre le commentaire et l'article
        $comment->setArticle($article);
        //Création du formulaire
        $form = $this->createForm(CommentType::class, $comment);
        //Hydratation du formulaire
        $form->handleRequest($request);

        //Traitement
        if($form->isSubmitted() and $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute("details", ["id"=>$article->getId()]);
        }

        return $this->render('BlogBundle:Article:details.html.twig', [
            'article'=>$article,
            'commentForm'=>$form->createView()
        ]);
    }

}
