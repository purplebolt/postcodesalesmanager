<?php


namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface PostCodesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get post_codes list.
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
