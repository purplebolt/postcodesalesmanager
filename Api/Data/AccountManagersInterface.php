<?php


namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface AccountManagersInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const MANAGER_NAME = 'manager_name';
    const ENTITY_ID = 'entity_id';
    const ACCOUNT_MANAGERS_ID = 'account_managers_id';

    /**
     * Get account_managers_id
     * @return string|null
     */
    public function getAccountManagersId();

    /**
     * Set account_managers_id
     * @param string $accountManagersId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setAccountManagersId($accountManagersId);

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setEntityId($entityId);

    /**
     * Get manager_name
     * @return string|null
     */
    public function getManagerName();

    /**
     * Set manager_name
     * @param string $managerName
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface
     */
    public function setManagerName($managerName);
}
