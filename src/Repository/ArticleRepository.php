<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\FileLocator;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends EntityRepository
{
    public $articles;
    
    public function __construct()
    {
        $this->articles = $this->recoverData();
    }

    public function getAll(){
        return $this->articles;
    }

    public function getById($id){
        return $this->articles[$id];
    }

    public function searchByName($search){
        $res = array();
        foreach ($this->articles as $article) {
            if(strpos(strtoupper($article->getName()),strtoupper($search)) !== false){
                array_push($res,$article);
            }
        }
        return $res;
    }

    public function recoverData(): Array{
        /**
         * Return the array of articles in the yaml database
         */
        $result = array();
        $array = Yaml::parseFile("../src/database.yaml",Yaml::PARSE_CUSTOM_TAGS);
        foreach ($array['article'] as $index => $article) {
            $newArticleEntity = new Article();
            $newArticleEntity->setName($article["name"]);
            $newArticleEntity->setDescription($article["description"]);
            $newArticleEntity->setPrice($article["price"]);
            $newArticleEntity->setId($index);
            array_push($result,$newArticleEntity);
        }
        return $result;
    }
}
