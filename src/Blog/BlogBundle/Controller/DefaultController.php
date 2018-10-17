<?php

namespace Blog\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/blog")
     */
    public function indexAction(Request $request)
    {
        $artilcleRepository = $this->getDoctrine()->getRepository("BlogBundle:Article");

        $article = $artilcleRepository->getAllArticles();

        // replace this example code with whatever you need
        return $this->render('BlogBundle:Default:index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'articleList' => $article
        ]);
        //return $this->render('BlogBundle:Default:index.html.twig');
    }

    /**
     * @Route("/test/{name}/{age}",
     *     requirements={"age":"\d{1,3}"},
     *     defaults={"age":"7"}
     * )
     * @return Response
     */
    public function testAction($age, $name){
        $out = "hello $name vous avez $age ans";

        $fruits = ["pommes", "poires", "oranges", "tomates", "figues", "grenades", "abricots"];

        return $this->render("test.html.twig", [
            "message" => $out,
            "now"=> new \DateTime(),
            "fruitList" => $fruits
        ]);
    }

    /**
     * @Route("/calc/add/{n1}/{n2}"
     *  , requirements={"n1":"\d+", "n2":"\d+"}
     *  , defaults={"n1":"1", "n2":"1"}
     * )
     */
    public function addAction($n1, $n2){
        //message utilisé dans la réponse sur master
        $out = "$n1 plus $n2 égal " . (intval($n1) + intval($n2));

        //retour de l'objet Response
        return new Response($out);
    }

    /**
     * @Route("/api/data", name="json_export")
     */
    public function getJsonAction(){
        $data = [
            ["name" => "Seb", "âge"=>48],
            ["name" => "Alice", "âge"=>25],
            ["name" => "Maev", "âge"=>50]
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set("Content-type","application/json");

        return $response;

    }
}
