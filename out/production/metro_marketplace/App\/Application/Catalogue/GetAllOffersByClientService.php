<?php

namespace App\Application\Catalogue;

use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use App\Domain\ValueObject\Client\ClientId;

/**
 * Class GetAllOffersByClientService
 * @package App\Application\Catalogue
 */
class GetAllOffersByClientService
{
    /**
     * @var CatalogueRepositoryContract
     */
    private CatalogueRepositoryContract $repository;

    /**
     * GetAllOffersByClientService constructor.
     * @param CatalogueRepositoryContract $repository
     */
    public function __construct(CatalogueRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return array
     */
    public function __invoke(int $id): array
    {
        $clientId = new ClientId($id);

        return $this->repository->findByClient($clientId);
    }

}