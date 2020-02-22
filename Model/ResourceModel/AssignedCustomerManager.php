<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:22 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel;


class AssignedCustomerManager extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('assigned_customer_manager', 'entity_id');
    }
}