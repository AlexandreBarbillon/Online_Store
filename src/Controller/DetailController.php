<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function index($id)
    {
        $articleRepo = new ArticleRepository();
        return $this->render('detail/index.html.twig', [
            'article' => $articleRepo->getById($id)
        ]);
    }
}
