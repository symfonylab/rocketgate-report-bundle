<?php

declare(strict_types=1);

namespace SymfonyLab\RocketGateReportBundle\Repository;


use SymfonyLab\RocketGateReport\MerchantInterface;
use SymfonyLab\RocketGateReportBundle\Model\SubscriptionInterface;

interface SubscriptionRepositoryInterface
{
    public function findOneByCustomerId(MerchantInterface $merchant, int $siteId, string $customerId): ?SubscriptionInterface;
}
