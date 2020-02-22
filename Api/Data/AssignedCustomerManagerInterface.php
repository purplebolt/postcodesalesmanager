<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:15 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface AssignedCustomerManagerInterface
{
    const ENTITY_ID = 'entity_id';
    const MANAGER_ID = 'manager_id';
    const ASSIGNED_CUSTOMER_MANAGER_ID = 'assigned_customer_manager_id';
    const QUOTE_ID = 'quote_id';

    /**
     * Get assigned_customer_manager_id
     * @return string|null
     */
    public function getAssignedCustomerManagerId();

    /**
     * Set assigned_customer_manager_id
     * @param string $assignedCustomerManagerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setAssignedCustomerManagerId($assignedCustomerManagerId);

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setEntityId($entityId);

    /**
     * Get quote_id
     * @return string|null
     */
    public function getQuoteId();

    /**
     * Set quote_id
     * @param string $quoteId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setQuoteId($quoteId);

    /**
     * Get manager_id
     * @return string|null
     */
    public function getManagerId();

    /**
     * Set manager_id
     * @param string $managerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     */
    public function setManagerId($managerId);
}