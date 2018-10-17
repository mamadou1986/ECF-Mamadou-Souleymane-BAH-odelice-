<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
    * @param $id
    * @return \Symfony\Component\HttpFoundation\Response
    */
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:page')->find($id);

        if(!$page) throw $this->createNotFoundException("!!!!LA PAGE N'EXISTE PAS");



        return $this->render('PagesBundle:Default:index.html.twig', array('page'=>$page));
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public  function  menuAction()
    {

        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PagesBundle:page')->findAll();

        return $this->render('PagesBundle:Default:menu.html.twig', array('pages'=>$pages));
    }


}
