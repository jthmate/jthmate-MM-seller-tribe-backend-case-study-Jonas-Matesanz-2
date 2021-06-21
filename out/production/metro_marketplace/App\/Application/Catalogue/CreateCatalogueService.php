<?php

namespace App\Application\Catalogue;

use App\Application\Client\GetClientService;
use App\Application\Product\GetProductService;
use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use App\Domain\Contract\Client\ClientRepositoryContract;
use App\Domain\Contract\Product\ProductRepositoryContract;
use App\Domain\Entity\Catalogue;

/**
 * Class CreateCatalogueService
 * @package App\Application\Catalogue
 */
class CreateCatalogueService
{
    /**
     * @var CatalogueRepositoryContract
     */
    private CatalogueRepositoryContract $repository;

    /**
     * @var ProductRepositoryContract
     */
    private ProductRepositoryContract $productRepository;


    public function __construct(
        CatalogueRepositoryContract $repository,
        ProductRepositoryContract $productRepository,
        ClientRepositoryContract $clientRepository
    )
    {
        $this->repository        = $repository;
        $this->productRepository = $productRepository;
        $this->clientRepository  = $clientRepository;
    }

    public function __invoke(int $clientId, int $productId, int $price): Catalogue
    {
        $getProductService = new GetProductService($this->productRepository);
        $product = $getProductService->__invoke($productId);

        $getClientService = new GetClientService($this->clientRepository);
        $client = $getClientService->__invoke($clientId);

        try {
            $catalogue = Catalogue::create($client, $product, $price);

            return $this->repository->save($catalogue);
        } catch (\Exception $ex) {
            throw new \InvalidArgumentException($ex);
        }
    }
}