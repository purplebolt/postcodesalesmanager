<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel;

class AccountManagerPostCodes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('account_manager_post_codes', 'entity_id');
    }
}
