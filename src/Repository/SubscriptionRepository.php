<?php


namespace SymfonyLab\RocketGateReportBundle\Repository;


use SymfonyLab\RocketGateReport\GatewayServiceInterface;
use SymfonyLab\RocketGateReport\MerchantInterface;
use SymfonyLab\RocketGateReport\Reports\MembershipsRequest;
use SymfonyLab\RocketGateReportBundle\Model\SubscriptionInterface;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    /**
     * @var GatewayServiceInterface
     */
    private $gatewayService;

    /**
     * SubscriptionRepository constructor.
     * @param GatewayServiceInterface $gatewayService
     */
    public function __construct(GatewayServiceInterface $gatewayService)
    {
        $this->gatewayService = $gatewayService;
    }


    public function findOneByCustomerId(MerchantInterface $merchant, int $siteId, string $customerId): ?SubscriptionInterface
    {
        $request = new MembershipsRequest();
        $request
            ->setMerchant($merchant)
            ->setFromDate(new \DateTimeImmutable('-1 week'))
            ->setToDate(new \DateTimeImmutable())
            ->whereCustomerId($customerId)
            ->whereSiteIds($siteId)
        ;

        $response = $this->gatewayService->request($request);

        var_dump($response);
        die();
    }
}
