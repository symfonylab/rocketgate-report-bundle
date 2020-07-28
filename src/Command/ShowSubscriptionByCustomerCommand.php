<?php


namespace SymfonyLab\RocketGateReportBundle\Command;

use Nevmmv\RocketGate\Merchant;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SymfonyLab\RocketGateReportBundle\Repository\SubscriptionRepositoryInterface;

class ShowSubscriptionByCustomerCommand extends Command
{
    protected static $defaultName = 'rockergate:subscription:show-by-customer';

    /**
     * @var SubscriptionRepositoryInterface
     */
    private $subscriptionRepository;

    /**
     * ShowSubscriptionByCustomer constructor.
     * @param SubscriptionRepositoryInterface $subscriptionRepository
     */
    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        parent::__construct();

        $this->subscriptionRepository = $subscriptionRepository;
    }


    protected function configure()
    {
        $this
            ->addArgument('merchantId', InputArgument::REQUIRED, 'Merchant ID')
            ->addArgument('merchantPassword', InputArgument::REQUIRED, 'Merchant Password')
            ->addArgument('siteId', InputArgument::REQUIRED, 'Site ID')
            ->addArgument('customerId', InputArgument::REQUIRED, 'Customer ID');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $merchant = new Merchant(
            $input->getArgument('merchantId'),
            $input->getArgument('merchantPassword'),
            ''
        );

        $subscription = $this->subscriptionRepository->findOneByCustomerId(
            $merchant,
            (int)$input->getArgument('siteId'),
            (int)$input->getArgument('customerId')
        );
        if (!$subscription) {
            $output->writeln('Subscription not found');
            return 0;
        }

        $output->writeln($subscription['status'].' / '.$subscription['cust_email']);
    }

}
