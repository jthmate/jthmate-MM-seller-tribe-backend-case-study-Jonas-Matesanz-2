<?php

namespace App\Infrastructure\Controller\Catalogue;

use App\Application\Catalogue\GetAllOffersByProductService;
use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetAllOffersByProductController extends AbstractController
{
    /**
     * @var CatalogueRepositoryContract
     */
    private CatalogueRepositoryContract $repository;

    /**
     * GetAllOffersByProductController constructor.
     * @param CatalogueRepositoryContract $repository
     */
    public function __construct(CatalogueRepositoryContract $repository) {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $id = (int)$request->get('id');
        $getCatalogueService = new GetAllOffersByProductService($this->repository);

        $catalogues = $getCatalogueService->__invoke($id);

        if (!$catalogues) {
            throw new \InvalidArgumentException('Catalogue not available');
        }

        $cataloguesArray = array();
        foreach($catalogues as $catalogue) {
            $cataloguesArray[] = array(
                'id'      => $catalogue->id(),
                'client'  => $catalogue->client()->name(),
                'price'   => $catalogue->price() > 0 ? $catalogue->price() : $catalogue->product()->price()->value()
            );
        }

        return new JsonResponse(
            $cataloguesArray,
            Response::HTTP_OK
        );
    }
}