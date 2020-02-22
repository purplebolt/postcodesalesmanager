<?php


namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterfaceFactory;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface;
use Magento\Framework\Api\DataObjectHelper;

class AccountManagerPostCodes
    extends \Magento\Framework\Model\AbstractModel
    implements AccountManagerPostCodesInterface
{

    protected $dataObjectHelper;

    protected $_eventPrefix = 'account_manager_post_codes';
    protected $account_manager_post_codesDataFactory;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AccountManagerPostCodesInterfaceFactory $account_manager_post_codesDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes $resource
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        AccountManagerPostCodesInterfaceFactory $account_manager_post_codesDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes $resource,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes\Collection $resourceCollection,
        array $data = []
    ) {
        $this->account_manager_post_codesDataFactory = $account_manager_post_codesDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve account_manager_post_codes model with account_manager_post_codes data
     * @return AccountManagerPostCodesInterface
     */
    public function getDataModel()
    {
        $account_manager_post_codesData = $this->getData();
        
        $account_manager_post_codesDataObject = $this->account_manager_post_codesDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $account_manager_post_codesDataObject,
            $account_manager_post_codesData,
            AccountManagerPostCodesInterface::class
        );
        
        return $account_manager_post_codesDataObject;
    }


    /**
     * Get account_manager_post_codes_id
     * @return string|null
     */
    public function getAccountManagerPostCodesId()
    {
        return $this->_getData(self::ACCOUNT_MANAGER_POST_CODES_ID);
    }

    /**
     * Set account_manager_post_codes_id
     * @param string $accountManagerPostCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setAccountManagerPostCodesId($accountManagerPostCodesId)
    {
        return $this->setData(self::ACCOUNT_MANAGER_POST_CODES_ID, $accountManagerPostCodesId);
    }

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get account_manager_id
     * @return string|null
     */
    public function getAccountManagerId()
    {
        return $this->_getData(self::ACCOUNT_MANAGER_ID);
    }

    /**
     * Set account_manager_id
     * @param string $accountManagerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setAccountManagerId($accountManagerId)
    {
        return $this->setData(self::ACCOUNT_MANAGER_ID, $accountManagerId);
    }

    /**
     * Get post_code_id
     * @return string|null
     */
    public function getPostCodeId()
    {
        return $this->_getData(self::POST_CODE_ID);
    }

    /**
     * Set post_code_id
     * @param string $postCodeId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setPostCodeId($postCodeId)
    {
        return $this->setData(self::POST_CODE_ID, $postCodeId);
    }
}
