<?php


namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers\CollectionFactory as AccountManagersCollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AccountManagers as ResourceAccountManagers;
use Vaimo\UserAccountPostcodeManagement\Api\AccountManagersRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersSearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;

class AccountManagersRepository implements AccountManagersRepositoryInterface
{

    protected $dataObjectHelper;

    private $storeManager;

    protected $accountManagersFactory;

    protected $accountManagersCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $dataAccountManagersFactory;


    /**
     * @param ResourceAccountManagers $resource
     * @param AccountManagersFactory $accountManagersFactory
     * @param AccountManagersInterfaceFactory $dataAccountManagersFactory
     * @param AccountManagersCollectionFactory $accountManagersCollectionFactory
     * @param AccountManagersSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceAccountManagers $resource,
        AccountManagersFactory $accountManagersFactory,
        AccountManagersInterfaceFactory $dataAccountManagersFactory,
        AccountManagersCollectionFactory $accountManagersCollectionFactory,
        AccountManagersSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->accountManagersFactory = $accountManagersFactory;
        $this->accountManagersCollectionFactory = $accountManagersCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAccountManagersFactory = $dataAccountManagersFactory;
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
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface $accountManagers
    ) {
        try {
            $this->resource->save($accountManagers);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the accountManagers: %1',
                $exception->getMessage()
            ));
        }
        return $accountManagers;
    }

    /**
     * {@inheritdoc}
     */
    public function get($accountManagersId)
    {
        $accountManagers = $this->accountManagersFactory->create();
        $this->resource->load($accountManagers, $accountManagersId);
        if (!$accountManagers->getEntityId()) {
            throw new NoSuchEntityException(__('account_managers with id "%1" does not exist.', $accountManagersId));
        }
        return $accountManagers->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->accountManagersCollectionFactory->create();
        
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
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AccountManagersInterface $accountManagers
    ) {
        try {
            $accountManagersModel = $this->accountManagersFactory->create();
            $this->resource->load($accountManagersModel, $accountManagers->getAccountManagersId());
            $this->resource->delete($accountManagersModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the account_managers: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($accountManagersId)
    {
        return $this->delete($this->get($accountManagersId));
    }
}
