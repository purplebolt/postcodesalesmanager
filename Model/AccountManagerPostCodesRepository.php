<?php


namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterfaceFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Vaimo\UserAccountPostcodeManagement\Api\AccountManagerPostCodesRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes as ResourceAccountManagerPostCodes;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagerPostCodes\CollectionFactory as AccountManagerPostCodesCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesSearchResultsInterfaceFactory;

class AccountManagerPostCodesRepository implements AccountManagerPostCodesRepositoryInterface
{

    protected $dataObjectHelper;

    private $storeManager;

    protected $dataAccountManagerPostCodesFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    protected $resource;

    protected $accountManagerPostCodesFactory;

    protected $accountManagerPostCodesCollectionFactory;


    /**
     * @param ResourceAccountManagerPostCodes $resource
     * @param AccountManagerPostCodesFactory $accountManagerPostCodesFactory
     * @param AccountManagerPostCodesInterfaceFactory $dataAccountManagerPostCodesFactory
     * @param AccountManagerPostCodesCollectionFactory $accountManagerPostCodesCollectionFactory
     * @param AccountManagerPostCodesSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceAccountManagerPostCodes $resource,
        AccountManagerPostCodesFactory $accountManagerPostCodesFactory,
        AccountManagerPostCodesInterfaceFactory $dataAccountManagerPostCodesFactory,
        AccountManagerPostCodesCollectionFactory $accountManagerPostCodesCollectionFactory,
        AccountManagerPostCodesSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->accountManagerPostCodesFactory = $accountManagerPostCodesFactory;
        $this->accountManagerPostCodesCollectionFactory = $accountManagerPostCodesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAccountManagerPostCodesFactory = $dataAccountManagerPostCodesFactory;
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
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface $accountManagerPostCodes
    ) {
        
        try {
            $this->resource->save($accountManagerPostCodes);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the accountManagerPostCodes: %1',
                $exception->getMessage()
            ));
        }
        return $accountManagerPostCodes;
    }

    /**
     * {@inheritdoc}
     */
    public function get($accountManagerPostCodesId)
    {
        $accountManagerPostCodes = $this->accountManagerPostCodesFactory->create();
        $this->resource->load($accountManagerPostCodes, $accountManagerPostCodesId);
        if (!$accountManagerPostCodes->getEntityId()) {
            throw new NoSuchEntityException(__('account_manager_post_codes with id "%1" does not exist.', $accountManagerPostCodesId));
        }
        return $accountManagerPostCodes->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getByPostCode($postCodeId)
    {
        $accountManagerPostCodes = $this->accountManagerPostCodesFactory->create();
        $this->resource->load($accountManagerPostCodes, $postCodeId, 'post_code_id');
        if (!$accountManagerPostCodes->getEntityId()) {
            throw new NoSuchEntityException(__('account_manager_post_codes with id "%1" does not exist.', $postCodeId));
        }
        return $accountManagerPostCodes->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->accountManagerPostCodesCollectionFactory->create();
        
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
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagerPostCodesInterface $accountManagerPostCodes
    ) {
        try {
            $accountManagerPostCodesModel = $this->accountManagerPostCodesFactory->create();
            $this->resource->load($accountManagerPostCodesModel, $accountManagerPostCodes->getAccountManagerPostCodesId());
            $this->resource->delete($accountManagerPostCodesModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the account_manager_post_codes: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($accountManagerPostCodesId)
    {
        return $this->delete($this->get($accountManagerPostCodesId));
    }
}
