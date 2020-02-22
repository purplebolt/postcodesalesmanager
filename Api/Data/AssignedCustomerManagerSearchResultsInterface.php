<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 12:39 PM
 */

namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface AssignedCustomerManagerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get assigned_customer_manager list.
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}