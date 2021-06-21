<?php

namespace App\Infrastructure\Controller\Catalogue;

use App\Application\Catalogue\GetAllOffersByClientService;
use App\Domain\Contract\Catalogue\CatalogueRepositoryContract;
use App\Domain\Entity\Catalogue;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class GetAllOffersByClientController extends AbstractController
{
    /**
     * @var CatalogueRepositoryContract
     */
    private CatalogueRepositoryContract $repository;

    private LoggerInterface $logger;

    /**
     * GetAllOffersByClientController constructor.
     * @param CatalogueRepositoryContract $repository
     * @param LoggerInterface $logger
     */
    public function __construct(CatalogueRepositoryContract $repository, LoggerInterface $logger) {
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $id = (int)$request->get('id');
        $getCatalogueService = new GetAllOffersByClientService($this->repository);

        $catalogues = $getCatalogueService->__invoke($id);

        if (!$catalogues) {
            throw new \InvalidArgumentException('Catalogue not available');
        }

        $cataloguesArray = array();
        foreach($catalogues as $catalogue) {
            $cataloguesArray[] = array(
                'id'      => $catalogue->id(),
                'product' => $catalogue->product()->name()->value(),
                'price'   => $catalogue->price() > 0 ? $catalogue->price() : $catalogue->product()->price()->value()
            );
        }

        return new JsonResponse(
            $cataloguesArray,
            Response::HTTP_OK
        );
    }
}