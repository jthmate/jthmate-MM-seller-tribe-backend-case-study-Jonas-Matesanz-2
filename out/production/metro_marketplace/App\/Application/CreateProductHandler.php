<?php


namespace App\Application;

use App\Domain\Entity\Product;
use App\Domain\Event\ProductCreatedEvent;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class CreateProductHandler
{
    private $serializer;
    private $cache;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;

//
    }

    public function handle(ProductCreatedEvent $event): void
    {
        print_r($event->value());


        //        $this->cache->save($product);
    }
}