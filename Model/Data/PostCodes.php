<?php


namespace Vaimo\UserAccountPostcodeManagement\Model\Data;

use Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface;

class PostCodes implements PostCodesInterface
{

    /**
     * Get post_codes_id
     * @return string|null
     */
    public function getPostCodesId()
    {
        return $this->_get(self::POST_CODES_ID);
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
     * @return string|null
     */
    public function getEntityId()
    {
        return $this->_get(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entityId
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
        return $this->_get(self::CODE);
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
