<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:11 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Api;


interface AssignedCustomerManagerRepositoryInterface
{

    /**
     * Save assigned_customer_manager
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface $assignedCustomerManager
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface $assignedCustomerManager
    );

    /**
     * Retrieve assigned_customer_manager
     * @param string $assignedCustomerManagerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($assignedCustomerManagerId);

    /**
     * Retrieve assigned_customer_manager matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete assigned_customer_manager
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface $assignedCustomerManager
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface $assignedCustomerManager
    );

    /**
     * Delete assigned_customer_manager by ID
     * @param string $assignedCustomerManagerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($assignedCustomerManagerId);
}