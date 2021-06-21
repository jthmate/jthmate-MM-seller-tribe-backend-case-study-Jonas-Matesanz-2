<?php

namespace App\Infrastructure\Controller;

use App\Application\GetAllProductService;
use App\Infrastructure\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class GetAllProductController extends AbstractController
{
    private $repository;

    public function __construct(ProductRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(): JsonResponse
    {

        $getProductService = new GetAllProductService($this->repository);
        $products = $getProductService->__invoke();

        $productArray = array();

        foreach($products as $product) {
            $productArray[] = array(
                'name' => $product->name()->value(),
                'price' => $product->price()->value()
            );
        }

        return new JsonResponse(
            $productArray,
            Response::HTTP_OK
        );
    }
}