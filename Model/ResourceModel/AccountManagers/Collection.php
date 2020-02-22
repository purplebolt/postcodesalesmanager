<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers;

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
            \Vaimo\UserAccountPostcodeManagement\Model\AccountManagers::class,
            \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers::class
        );
    }
}
