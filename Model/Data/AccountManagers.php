<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\Data;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface;

class AccountManagers implements AccountManagersInterface
{

    /**
     * Get account_managers_id
     * @return string|null
     */
    public function getAccountManagersId()
    {
        return $this->_get(self::ACCOUNT_MANAGERS_ID);
    }

    /**
     * Set account_managers_id
     * @param string $accountManagersId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setAccountManagersId($accountManagersId)
    {
        return $this->setData(self::ACCOUNT_MANAGERS_ID, $accountManagersId);
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
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get manager_name
     * @return string|null
     */
    public function getManagerName()
    {
        return $this->_get(self::MANAGER_NAME);
    }

    /**
     * Set manager_name
     * @param string $managerName
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setManagerName($managerName)
    {
        return $this->setData(self::MANAGER_NAME, $managerName);
    }
}
