<?php


namespace Vaimo\UserAccountPostcodeManagement\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface PostCodesRepositoryInterface
{

    /**
     * Save post_codes
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface $postCodes
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface $postCodes
    );

    /**
     * Retrieve post_codes
     * @param string $postCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($postCodesId);

    /**
     * Retrieve post_codes matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete post_codes
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface $postCodes
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface $postCodes
    );

    /**
     * Delete post_codes by ID
     * @param string $postCodesId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($postCodesId);
}
