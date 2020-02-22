<?php


namespace Vaimo\UserAccountPostcodeManagement\Api\Data;

interface PostCodesInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ENTITY_ID = 'entity_id';
    const CODE = 'code';
    const POST_CODES_ID = 'post_codes_id';

    /**
     * Get post_codes_id
     * @return string|null
     */
    public function getPostCodesId();

    /**
     * Set post_codes_id
     * @param string $postCodesId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     */
    public function setPostCodesId($postCodesId);

    /**
     * Get entity_id
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param int $entityId
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     */
    public function setEntityId($entityId);

    /**
     * Get code
     * @return string|null
     */
    public function getCode();

    /**
     * Set code
     * @param string $code
     * @return \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface
     */
    public function setCode($code);
}
