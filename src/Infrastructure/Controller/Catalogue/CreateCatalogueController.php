<?php

namespace App\Infrastructure\Controller\Catalogue;

use App\Application\Catalogue\CreateCatalogueService;
use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use App\Domain\Contract\Client\ClientRepositoryContract;
use App\Domain\Contract\Product\ProductRepositoryContract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateCatalogueController extends AbstractController
{
    /**
     * @var CatalogueRepositoryContract
     */
    private CatalogueRepositoryContract $repository;
    /**
     * @var ProductRepositoryContract
     */
    private ProductRepositoryContract $productRepository;
    /**
     * @var ClientRepositoryContract
     */
    private ClientRepositoryContract $clientRepository;

    /**
     * CreateProductController constructor.
     * @param CatalogueRepositoryContract $repository
     * @param ProductRepositoryContract $productRepository
     * @param ClientRepositoryContract $clientRepository
     */
    public function __construct(
        CatalogueRepositoryContract $repository,
        ProductRepositoryContract $productRepository,
        ClientRepositoryContract $clientRepository
    ) {
        $this->repository        = $repository;
        $this->productRepository = $productRepository;
        $this->clientRepository  = $clientRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $clientId  = (int)$request->get('id');
        $productId = $request->query->get('product_id');
        $price     = $request->query->get('price');

        $catalogueService = new CreateCatalogueService(
            $this->repository,
            $this->productRepository,
            $this->clientRepository
        );

        $catalogue = $catalogueService->__invoke($clientId, $productId, $price);

        return new Response(
            null,
            Response::HTTP_OK
        );
    }
}