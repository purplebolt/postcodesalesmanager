<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\ResourceModel;

class PostCodes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('post_codes', 'post_codes_id');
    }
}
