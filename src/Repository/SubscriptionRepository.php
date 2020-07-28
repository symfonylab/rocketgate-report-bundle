<?php


namespace SymfonyLab\RocketGateReportBundle\Repository;


use Nevmmv\RocketGate\GatewayServiceInterface;
use Nevmmv\RocketGate\MerchantInterface;
use Nevmmv\RocketGate\Reports\MembershipsRequest;
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
