<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ){
        $this->entityManager = $entityManager;
    }

    protected function orderedPaginatedList(
        Request $request,
        $queryBuilder,
        PaginatorInterface $paginator,
        $options = [],
        $itemsPerPage = 25
    ){
        if (!array_key_exists('wrap-queries', $options)) {
            $options['wrap-queries'] = true;
        }
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            $itemsPerPage,
            $options
        );
        $pagination->setCustomParameters(array(
            'align' => 'center',
            'size' => 'small',
        ));

        return $pagination;
    }
}
