<?php
namespace App\Service\Results;

use App\Entity\Blog\Article;
use App\Service\Interfaces\ResultServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ResultService implements ResultServiceInterface
{
    CONST LIMIT=2;
    private $em;

    private $requestStack;


    public function __construct(EntityManagerInterface $em,RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function get(string $class,string $type = 'All',array $options=[]): array
    {
        $request = $this->requestStack->getCurrentRequest();

        $repo = $this->em->getRepository($class);

        $page = $request->query->get('page', 1);
        $allCount=($type == 'All') ? $repo->findAll() : $repo->findBy($options);
        $pagesCount = ceil(count($allCount) / self::LIMIT);

        $pages = range(1, $pagesCount);

        $articles = $repo->findBy($options, [], self::LIMIT, (self::LIMIT * ($page - 1)));

        return ['pagesCount' => $pagesCount,'pages' => $pages,'articles' => $articles];
    }
}

