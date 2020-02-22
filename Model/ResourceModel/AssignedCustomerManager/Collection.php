<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:25 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Vaimo\UserAccountPostcodeManagement\Model\AssignedCustomerManager::class,
            \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager::class
        );
    }
}