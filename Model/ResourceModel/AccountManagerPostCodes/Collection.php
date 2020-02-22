<?php

namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes;

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
            \Vaimo\UserAccountPostcodeManagement\Model\AccountManagerPostCodes::class,
            \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes::class
        );
    }

    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()
            ->reset()
            ->from(['main_table'=>'account_manager_post_codes'])
            ->columns(['am.manager_name',
                'pc.code',
                'main_table.entity_id as id',
                'main_table.account_manager_id'
            ])->join(['pc'=>'post_codes'], 'main_table.post_code_id = pc.entity_id')
            ->join(['am'=>'account_managers'], 'main_table.account_manager_id=am.entity_id');
    }
}
