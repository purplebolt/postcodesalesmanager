<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:01 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Observer;

use Vaimo\UserAccountPostcodeManagement\Model\AssignManager;
use Magento\Framework\Event\ObserverInterface;
Use Magento\Framework\Event\Observer;

/**
 * Class OrderPlaceBefore
 * @package Vaimo\UserAccountPostcodeManagement\Observer
 */
class OrderPlaceBefore implements ObserverInterface
{

    /**
     * @var AssignManager
     */
    private $_assignManager;

    /**
     * OrderPlaceBefore constructor.
     * @param AssignManager $assignManager
     */
    public function __construct(
        AssignManager $assignManager
    )
    {
        $this->_assignManager = $assignManager;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $quoteId = $observer->getEvent()->getOrder()->getQuoteId();
        $this->_assignManager->assign($quoteId);
    }

}