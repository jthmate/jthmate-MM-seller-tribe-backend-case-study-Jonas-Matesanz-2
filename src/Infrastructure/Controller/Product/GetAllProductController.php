<?php

namespace App\Infrastructure\Controller\Product;

use App\Application\Product\GetAllProductService;
use App\Domain\Contract\Product\ProductRepositoryContract;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class GetAllProductController extends AbstractController
{
    /**
     * @var ProductRepositoryContract
     */
    private ProductRepositoryContract $repository;

    /**
     * GetAllProductController constructor.
     * @param ProductRepositoryContract $repository
     */
    public function __construct(ProductRepositoryContract $repository) {
        $this->repository = $repository;
    }

    public function __invoke(): JsonResponse
    {
        $getProductService = new GetAllProductService($this->repository);
        $products = $getProductService->__invoke();

        $productArray = array();

        foreach($products as $product) {
            $productArray[] = array(
                'id'    => $product->id()->value(),
                'name'  => $product->name()->value(),
                'price' => $product->price()->value()
            );
        }

        return new JsonResponse(
            $productArray,
            Response::HTTP_OK
        );
    }
}