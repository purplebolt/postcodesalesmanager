<?php


namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface AccountManagerPostCodesInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ENTITY_ID = 'entity_id';
    const POST_CODE_ID = 'post_code_id';
    const ACCOUNT_MANAGER_POST_CODES_ID = 'account_manager_post_codes_id';
    const ACCOUNT_MANAGER_ID = 'account_manager_id';

    /**
     * Get account_manager_post_codes_id
     * @return string|null
     */
    public function getAccountManagerPostCodesId();

    /**
     * Set account_manager_post_codes_id
     * @param string $accountManagerPostCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setAccountManagerPostCodesId($accountManagerPostCodesId);

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setEntityId($entityId);

    /**
     * Get account_manager_id
     * @return string|null
     */
    public function getAccountManagerId();

    /**
     * Set account_manager_id
     * @param string $accountManagerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setAccountManagerId($accountManagerId);

    /**
     * Get post_code_id
     * @return string|null
     */
    public function getPostCodeId();

    /**
     * Set post_code_id
     * @param string $postCodeId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setPostCodeId($postCodeId);
}
