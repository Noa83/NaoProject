<?php

namespace AppBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    //Récupère les articles et utilise le paginator, réorganiser et nommer findAll
    public function findAllArticles($page, $nbreParPage)
    {
        $query = $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC') //Ordonne par ordre décroissant dernier article au premier article
            ->getQuery()
            ->setFirstResult(($page-1) * $nbreParPage) //On définit l'article à partir duquel commencer la liste
            ->setMaxResults($nbreParPage); //Le nombre d'épisode à afficher sur une page

        return new Paginator($query, true);
    }

    //Récupère les articles pour utilisation dans articles récents et le limit à 3 résultats  //A réorganiser et nommer différement findArticlesRecents
    public function getArticlesRecents()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC') //Ordonne par ordre décroissant dernier article au premier article
            ->setMaxResults(3)  //Limite à 3 résultats.
            ->getQuery()
            ->getResult();
    }

    const LIMIT = 15;

    public function findArticle($term)
    {
        $qb = $this->createQueryBuilder('a');
        $qb ->select('a.id, a.title')
            ->where('a.title LIKE :term')
            ->setParameter('term', '%'.$term.'%')
            ->setMaxResults(self::LIMIT);

        $arrayAss= $qb->getQuery()->getArrayResult();

        // Transformer le tableau associatif en un tableau standard
        $array = array();
        foreach($arrayAss as $data)
        {
            $array[] = array("title"=>$data['title'], "id" =>$data['id']);
        }
        return $array;
    }
}
