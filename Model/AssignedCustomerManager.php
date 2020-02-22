<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:18 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterfaceFactory;

class AssignedCustomerManager
    extends \Magento\Framework\Model\AbstractModel
    implements AssignedCustomerManagerInterface
{

    protected $assigned_customer_managerDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'assigned_customer_manager';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AssignedCustomerManagerInterfaceFactory $assigned_customer_managerDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager $resource
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        AssignedCustomerManagerInterfaceFactory $assigned_customer_managerDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager $resource,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager\Collection $resourceCollection,
        array $data = []
    ) {
        $this->assigned_customer_managerDataFactory = $assigned_customer_managerDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve assigned_customer_manager model with assigned_customer_manager data
     * @return AssignedCustomerManagerInterface
     */
    public function getDataModel()
    {
        $assigned_customer_managerData = $this->getData();

        $assigned_customer_managerDataObject = $this->assigned_customer_managerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $assigned_customer_managerDataObject,
            $assigned_customer_managerData,
            AssignedCustomerManagerInterface::class
        );

        return $assigned_customer_managerDataObject;
    }

    /**
     * Get assigned_customer_manager_id
     * @return string|null
     */
    public function getAssignedCustomerManagerId()
    {
        return $this->_getData(self::ASSIGNED_CUSTOMER_MANAGER_ID);
    }

    /**
     * Set assigned_customer_manager_id
     * @param string $assignedCustomerManagerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setAssignedCustomerManagerId($assignedCustomerManagerId)
    {
        return $this->setData(self::ASSIGNED_CUSTOMER_MANAGER_ID, $assignedCustomerManagerId);
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
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get quote_id
     * @return string|null
     */
    public function getQuoteId()
    {
        return $this->_getData(self::QUOTE_ID);
    }

    /**
     * Set quote_id
     * @param string $quoteId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setQuoteId($quoteId)
    {
        return $this->setData(self::QUOTE_ID, $quoteId);
    }

    /**
     * Get manager_id
     * @return string|null
     */
    public function getManagerId()
    {
        return $this->_getData(self::MANAGER_ID);
    }

    /**
     * Set manager_id
     * @param string $managerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setManagerId($managerId)
    {
        return $this->setData(self::MANAGER_ID, $managerId);
    }
}