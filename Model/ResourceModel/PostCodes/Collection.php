<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes;

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
            \Vaimo\UserAccountPostcodeManagement\Model\PostCodes::class,
            \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes::class
        );
    }
}
