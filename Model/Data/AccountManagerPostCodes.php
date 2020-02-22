<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\Data;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface;

class AccountManagerPostCodes implements AccountManagerPostCodesInterface
{

    /**
     * Get account_manager_post_codes_id
     * @return string|null
     */
    public function getAccountManagerPostCodesId()
    {
        return $this->_get(self::ACCOUNT_MANAGER_POST_CODES_ID);
    }

    /**
     * Set account_manager_post_codes_id
     * @param string $accountManagerPostCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setAccountManagerPostCodesId($accountManagerPostCodesId)
    {
        return $this->setData(self::ACCOUNT_MANAGER_POST_CODES_ID, $accountManagerPostCodesId);
    }

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get account_manager_id
     * @return string|null
     */
    public function getAccountManagerId()
    {
        return $this->_get(self::ACCOUNT_MANAGER_ID);
    }

    /**
     * Set account_manager_id
     * @param string $accountManagerId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setAccountManagerId($accountManagerId)
    {
        return $this->setData(self::ACCOUNT_MANAGER_ID, $accountManagerId);
    }

    /**
     * Get post_code_id
     * @return string|null
     */
    public function getPostCodeId()
    {
        return $this->_get(self::POST_CODE_ID);
    }

    /**
     * Set post_code_id
     * @param string $postCodeId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface
     */
    public function setPostCodeId($postCodeId)
    {
        return $this->setData(self::POST_CODE_ID, $postCodeId);
    }
}
