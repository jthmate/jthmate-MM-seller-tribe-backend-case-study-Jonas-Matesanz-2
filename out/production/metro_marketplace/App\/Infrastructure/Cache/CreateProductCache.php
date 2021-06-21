<?php


namespace App\Infrastructure\Cache;

use App\Domain\Entity\Product;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class CreateProductCache
{
    private $cache;

    public function __construct()
    {
        $client = RedisAdapter::createConnection(
            'redis://localhost'
        );

        $this->cache = new RedisAdapter(
            $client,
            $namespace = '',
            $defaultLifetime = 0
        );
    }

    public function __invoke(Product $product)
    {
        $this->cache->save($product);
    }
}