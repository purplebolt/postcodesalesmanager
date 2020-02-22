<?php


namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface AccountManagersSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get account_managers list.
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
