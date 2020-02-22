<?php


namespace Vaimo\UserAccountPostcodeManagement\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface AccountManagerPostCodesRepositoryInterface
{

    /**
     * Save account_manager_post_codes
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface $accountManagerPostCodes
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface $accountManagerPostCodes
    );

    /**
     * Retrieve account_manager_post_codes
     * @param integer $accountManagerPostCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($accountManagerPostCodesId);

    /**
     * Retrieve account_manager_post_codes
     * @param integer $postCodeId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByPostCode($postCodeId);

    /**
     * Retrieve account_manager_post_codes matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete account_manager_post_codes
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface $accountManagerPostCodes
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface $accountManagerPostCodes
    );

    /**
     * Delete account_manager_post_codes by ID
     * @param string $accountManagerPostCodesId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($accountManagerPostCodesId);
}
