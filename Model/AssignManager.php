<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:01 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use \Magento\Directory\Model\CurrencyFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Vaimo\UserAccountPostcodeManagement\Api\AssignedCustomerManagerRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Api\PostCodesRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Api\AccountManagerPostCodesRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterfaceFactory;

/**
 * Class AssignManager
 * @package Vaimo\UserAccountPostcodeManagement\Observer
 */
class AssignManager
{

    const CHOSEN_CURRENCY = 'GBP';

    const THRESHOLD_PATH = 'customer/order_threshold/threshold';

    /**
     * @var CartRepositoryInterface
     */
    private $_cartRepository;

    /**
     * @var CurrencyFactory
     */
    private $_currencyFactory;

    /**
     * @var ScopeConfigInterface
     */
    private $_scopeConfig;

    /**
     * @var AssignedCustomerManagerRepositoryInterface
     */
    private $_assignedCustomerManagerRepository;

    /**
     * @var AccountManagerPostCodesRepositoryInterface
     */
    private $_accountManagerPostCodesRepository;

    /**
     * @var PostCodesRepositoryInterface
     */
    private $_postCodesRepository;

    /**
     * @var AssignedCustomerManagerInterfaceFactory
     */
    private $_assignedCustomerManagerFactory;

    /**
     * AssignManager constructor.
     * @param CartRepositoryInterface $cartRepository
     * @param CurrencyFactory $currencyFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param AssignedCustomerManagerRepositoryInterface $assignedCustomerManagerRepository
     * @param PostCodesRepositoryInterface $postCodesRepository
     * @param AccountManagerPostCodesRepositoryInterface $accountManagerPostCodesRepository
     * @param AssignedCustomerManagerInterfaceFactory $assignedCustomerManagerFactory
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        CurrencyFactory $currencyFactory,
        ScopeConfigInterface $scopeConfig,
        AssignedCustomerManagerRepositoryInterface $assignedCustomerManagerRepository,
        PostCodesRepositoryInterface $postCodesRepository,
        AccountManagerPostCodesRepositoryInterface $accountManagerPostCodesRepository,
        AssignedCustomerManagerInterfaceFactory $assignedCustomerManagerFactory
    )
    {
        $this->_cartRepository = $cartRepository;
        $this->_currencyFactory = $currencyFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_assignedCustomerManagerRepository = $assignedCustomerManagerRepository;
        $this->_postCodesRepository = $postCodesRepository;
        $this->_accountManagerPostCodesRepository = $accountManagerPostCodesRepository;
        $this->_assignedCustomerManagerFactory = $assignedCustomerManagerFactory;
    }

    /**
     * @param integer $quoteId
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function assign($quoteId)
    {
        $_quote = $this->_cartRepository->get($quoteId);
        $rate = $this->getRate(
                    $_quote->getStoreCurrencyCode(),
                    self::CHOSEN_CURRENCY
                );
        try{
            $amount = $rate * $_quote->getBaseSubtotal();
            $code = $_quote->getShippingAddress()->getPostcode();
            $_postCode = $this->_postCodesRepository->get($code);
            $_accountManagerPostCode = $this->_accountManagerPostCodesRepository->getByPostCode($_postCode->getEntityId());

            if($this->meetsThreshold($amount)){
                $managed = $this->_assignedCustomerManagerFactory->create();
                $managed->setQuoteId($quoteId);
                $managed->setManagerId($_accountManagerPostCode->getAccountManagerId());
                $this->_assignedCustomerManagerRepository->save($managed);
            }
        }catch (NoSuchEntityException $exception){
            
        }
    }

    /**
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return float
     */
    public function getRate($fromCurrency, $toCurrency){

        $rate = $this->_currencyFactory
                    ->create()
                    ->load($fromCurrency)
                    ->getAnyRate($toCurrency);
        return $rate;
    }

    /**
     * Checks whether Base Total Amount is up to
     * Threshold or not
     *
     * @param float $amount
     * @return bool
     */
    public function meetsThreshold($amount){
        return $amount >= $this->getThreshold();
    }

    /**
     * Gets Threshold value from Configuration
     *
     * @return float
     */
    public function getThreshold(){

        $threshold = $this->_scopeConfig->getValue(
                        self::THRESHOLD_PATH,
                        ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );

        return (float) $threshold;
    }

}