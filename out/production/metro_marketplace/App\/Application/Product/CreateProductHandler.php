<?php

namespace App\Application\Product;

use App\Domain\Contract\Product\ProductRepositoryContract;
use App\Domain\Entity\Product;
use App\Domain\Event\ProductCreatedEvent;
use App\Domain\ValueObject\Product\ProductId;
use App\Domain\ValueObject\Product\ProductName;
use App\Domain\ValueObject\Product\ProductPrice;
use JMS\Serializer\SerializerInterface;

use Psr\Log\LoggerInterface;


/**
 * Class CreateProductHandler
 * @package App\Application
 */
class CreateProductHandler
{
    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var ProductRepositoryContract
     */
    private ProductRepositoryContract $repository;

    private LoggerInterface $logger;

    /**
     * CreateProductHandler constructor.
     * @param SerializerInterface $serializer
     * @param ProductRepositoryContract $repository
     * @param LoggerInterface $logger
     */
    public function __construct(
        SerializerInterface $serializer,
        ProductRepositoryContract $repository,
        LoggerInterface $logger
    )
    {
        $this->serializer = $serializer;
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @param ProductCreatedEvent $event
     */
    public function handle(ProductCreatedEvent $event): void
    {
        if (!$event || !$event->value()) {
            throw new \InvalidArgumentException('No more products');
        }

        $product = $event->value();

        $productMatch = $this->repository->find(new ProductId($product->id()->value()));

        if (!$productMatch) {
            $productEntity = new Product(
                new ProductId($product->id()->value()),
                new ProductName($product->name()->value()),
                new ProductPrice($product->price()->value())
            );

            $this->repository->save($productEntity);

            print_r("New product created \n");
        }
    }
}