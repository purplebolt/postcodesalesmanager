<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:29 AM
 */
namespace Vaimo\UserAccountPostcodeManagement\Model\Data;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface;

class AssignedCustomerManager implements AssignedCustomerManagerInterface
{

    /**
     * Get assigned_customer_manager_id
     * @return string|null
     */
    public function getAssignedCustomerManagerId()
    {
        return $this->_get(self::ASSIGNED_CUSTOMER_MANAGER_ID);
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
        return $this->_get(self::ENTITY_ID);
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
        return $this->_get(self::QUOTE_ID);
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
        return $this->_get(self::MANAGER_ID);
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