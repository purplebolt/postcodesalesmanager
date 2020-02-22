<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel;

class AccountManagers extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('account_managers', 'entity_id');
    }
}
