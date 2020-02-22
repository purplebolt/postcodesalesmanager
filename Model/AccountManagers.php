<?php


namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface;
use Magento\Framework\Api\DataObjectHelper;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterfaceFactory;

class AccountManagers
    extends \Magento\Framework\Model\AbstractModel
    implements AccountManagersInterface
{

    protected $dataObjectHelper;

    protected $account_managersDataFactory;

    protected $_eventPrefix = 'vaimo_useraccountpostcodemanagement_account_managers';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AccountManagersInterfaceFactory $account_managersDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers $resource
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        AccountManagersInterfaceFactory $account_managersDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers $resource,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers\Collection $resourceCollection,
        array $data = []
    ) {
        $this->account_managersDataFactory = $account_managersDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve account_managers model with account_managers data
     * @return AccountManagersInterface
     */
    public function getDataModel()
    {
        $account_managersData = $this->getData();
        
        $account_managersDataObject = $this->account_managersDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $account_managersDataObject,
            $account_managersData,
            AccountManagersInterface::class
        );
        
        return $account_managersDataObject;
    }

    /**
     * Get account_managers_id
     * @return string|null
     */
    public function getAccountManagersId()
    {
        return $this->_getData(self::ACCOUNT_MANAGERS_ID);
    }

    /**
     * Set account_managers_id
     * @param string $accountManagersId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setAccountManagersId($accountManagersId)
    {
        return $this->setData(self::ACCOUNT_MANAGERS_ID, $accountManagersId);
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
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get manager_name
     * @return string|null
     */
    public function getManagerName()
    {
        return $this->_getData(self::MANAGER_NAME);
    }

    /**
     * Set manager_name
     * @param string $managerName
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setManagerName($managerName)
    {
        return $this->setData(self::MANAGER_NAME, $managerName);
    }
}
