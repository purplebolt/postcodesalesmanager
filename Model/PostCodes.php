<?php

namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface;
use Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class PostCodes extends \Magento\Framework\Model\AbstractModel implements PostCodesInterface
{

    protected $dataObjectHelper;

    protected $post_codesDataFactory;

    protected $_eventPrefix = 'post_codes';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PostCodesInterfaceFactory $post_codesDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes $resource
     * @param \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PostCodesInterfaceFactory $post_codesDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes $resource,
        \Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes\Collection $resourceCollection,
        array $data = []
    ) {
        $this->post_codesDataFactory = $post_codesDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve post_codes model with post_codes data
     * @return PostCodesInterface
     */
    public function getDataModel()
    {
        $post_codesData = $this->getData();
        
        $post_codesDataObject = $this->post_codesDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $post_codesDataObject,
            $post_codesData,
            PostCodesInterface::class
        );
        
        return $post_codesDataObject;
    }


    /**
     * Get post_codes_id
     * @return string|null
     */
    public function getPostCodesId()
    {
        return $this->_getData(self::POST_CODES_ID);
    }

    /**
     * Set post_codes_id
     * @param string $postCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     */
    public function setPostCodesId($postCodesId)
    {
        return $this->setData(self::POST_CODES_ID, $postCodesId);
    }

    /**
     * Get entity_id
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param int $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Get code
     * @return string|null
     */
    public function getCode()
    {
        return $this->_getData(self::CODE);
    }

    /**
     * Set code
     * @param string $code
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }
}
