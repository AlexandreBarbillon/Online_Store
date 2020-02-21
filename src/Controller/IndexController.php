<?php

namespace App\Controller;
use Symfony\Component\Yaml\Yaml;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Config\FileLocator;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="search", methods="GET")
     */
    public function index(Request $request)
    {
        $repo = new ArticleRepository();
        $search = $request->query->get('search');
        if($request != null && $search != ""){
            $articles = $repo->searchByName($search);
        }
        else{
            $articles = $repo->getAll();
        }


        return $this->render('index/index.html.twig', [
            'search' => $search,
            'articles' => $articles
        ]);
    }
}
