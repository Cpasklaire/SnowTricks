<?php

namespace App\Services;

use App\Repository\TrickRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PaginationService
{
    public function __construct(
        private RequestStack $requestStack,
        private TrickRepository $trickRepo,
        private PaginatorInterface $paginator
    ) {

    }

    public function getPaginatedTrick(): PaginationInterface
    {
        $request = $this->requestStack->getMainRequest();
        $tricksQuery = $this->trickRepo->findForPagination();
        $page = $request->query->getInt('page', 1);
        $limit = 3;

        return $this->paginator->paginate($tricksQuery, $page, $limit);
    }
}