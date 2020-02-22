<?php


namespace Vaimo\UserAccountPostcodeManagement\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface AccountManagersRepositoryInterface
{

    /**
     * Save account_managers
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface $accountManagers
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface $accountManagers
    );

    /**
     * Retrieve account_managers
     * @param string $accountManagersId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($accountManagersId);

    /**
     * Retrieve account_managers matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete account_managers
     * @param \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface $accountManagers
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface $accountManagers
    );

    /**
     * Delete account_managers by ID
     * @param string $accountManagersId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($accountManagersId);
}
