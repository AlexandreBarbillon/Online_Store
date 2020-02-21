<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="detail")
     * Récupère un article et l'affiche sur la page de détails
     */
    public function index($id)
    {
        $articleRepo = new ArticleRepository();
        $article = $articleRepo->getById($id);
        if($article == null){
          return $this->render('detail/nothing.html.twig');  
        }
        return $this->render('detail/index.html.twig', [
            'article' => $article
        ]);
    }
}
