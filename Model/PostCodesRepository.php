<?php


namespace Vaimo\UserAccountPostcodeManagement\Model;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes as ResourcePostCodes;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Vaimo\UserAccountPostcodeManagement\Api\PostCodesRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesSearchResultsInterfaceFactory;
use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\PostCodes\CollectionFactory as PostCodesCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class PostCodesRepository implements PostCodesRepositoryInterface
{

    protected $postCodesFactory;

    protected $dataObjectHelper;

    protected $dataPostCodesFactory;

    private $storeManager;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    protected $resource;

    protected $postCodesCollectionFactory;


    /**
     * @param ResourcePostCodes $resource
     * @param PostCodesFactory $postCodesFactory
     * @param PostCodesInterfaceFactory $dataPostCodesFactory
     * @param PostCodesCollectionFactory $postCodesCollectionFactory
     * @param PostCodesSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePostCodes $resource,
        PostCodesFactory $postCodesFactory,
        PostCodesInterfaceFactory $dataPostCodesFactory,
        PostCodesCollectionFactory $postCodesCollectionFactory,
        PostCodesSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->postCodesFactory = $postCodesFactory;
        $this->postCodesCollectionFactory = $postCodesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPostCodesFactory = $dataPostCodesFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface $postCodes
    ) {
        
        try {
            $this->resource->save($postCodes);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the postCodes: %1',
                $exception->getMessage()
            ));
        }
        return $postCodes;
    }

    /**
     * {@inheritdoc}
     */
    public function get($code)
    {
        $postCodes = $this->postCodesFactory->create();
        $this->resource->load($postCodes, $code, 'code');
        if (!$postCodes->getEntityId()) {
            throw new NoSuchEntityException(__('post_codes with id "%1" does not exist.', $code));
        }
        return $postCodes->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->postCodesCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Vaimo\UserAccountPostcodeManagement\Api\Data\PostCodesInterface $postCodes
    ) {
        try {
            $postCodesModel = $this->postCodesFactory->create();
            $this->resource->load($postCodesModel, $postCodes->getPostCodesId());
            $this->resource->delete($postCodesModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the post_codes: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($postCodesId)
    {
        return $this->delete($this->get($postCodesId));
    }
}
