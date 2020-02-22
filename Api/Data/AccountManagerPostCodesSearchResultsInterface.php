<?php


namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface AccountManagerPostCodesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get account_manager_post_codes list.
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
