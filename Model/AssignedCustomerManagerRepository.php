<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 9:21 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Model;

use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager as ResourceAssignedCustomerManager;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Vaimo\UserAccountPostcodeManagement\Model\ResourceModel\AssignedCustomerManager\CollectionFactory as AssignedCustomerManagerCollectionFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterfaceFactory;
use Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerSearchResultsInterfaceFactory;
use Vaimo\UserAccountPostcodeManagement\Api\AssignedCustomerManagerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class AssignedCustomerManagerRepository implements AssignedCustomerManagerRepositoryInterface
{

    protected $dataObjectHelper;

    private $storeManager;

    protected $dataAssignedCustomerManagerFactory;

    protected $searchResultsFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;
    protected $resource;

    protected $assignedCustomerManagerFactory;

    protected $assignedCustomerManagerCollectionFactory;


    /**
     * @param ResourceAssignedCustomerManager $resource
     * @param AssignedCustomerManagerFactory $assignedCustomerManagerFactory
     * @param AssignedCustomerManagerInterfaceFactory $dataAssignedCustomerManagerFactory
     * @param AssignedCustomerManagerCollectionFactory $assignedCustomerManagerCollectionFactory
     * @param AssignedCustomerManagerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceAssignedCustomerManager $resource,
        AssignedCustomerManagerFactory $assignedCustomerManagerFactory,
        AssignedCustomerManagerInterfaceFactory $dataAssignedCustomerManagerFactory,
        AssignedCustomerManagerCollectionFactory $assignedCustomerManagerCollectionFactory,
        AssignedCustomerManagerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->assignedCustomerManagerFactory = $assignedCustomerManagerFactory;
        $this->assignedCustomerManagerCollectionFactory = $assignedCustomerManagerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAssignedCustomerManagerFactory = $dataAssignedCustomerManagerFactory;
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
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface $assignedCustomerManager
    ) {

        try {
            $this->resource->save($assignedCustomerManager);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the assignedCustomerManager: %1',
                $exception->getMessage()
            ));
        }
        return $assignedCustomerManager;
    }

    /**
     * {@inheritdoc}
     */
    public function get($assignedCustomerManagerId)
    {
        $assignedCustomerManager = $this->assignedCustomerManagerFactory->create();
        $this->resource->load($assignedCustomerManager, $assignedCustomerManagerId);
        if (!$assignedCustomerManager->getEnttyId()) {
            throw new NoSuchEntityException(__('assigned_customer_manager with id "%1" does not exist.', $assignedCustomerManagerId));
        }
        return $assignedCustomerManager->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->assignedCustomerManagerCollectionFactory->create();

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
        \Vaimo\UserAccountPostcodeManagement\Api\Data\AssignedCustomerManagerInterface $assignedCustomerManager
    ) {
        try {
            $assignedCustomerManagerModel = $this->assignedCustomerManagerFactory->create();
            $this->resource->load($assignedCustomerManagerModel, $assignedCustomerManager->getAssignedCustomerManagerId());
            $this->resource->delete($assignedCustomerManagerModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the assigned_customer_manager: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($assignedCustomerManagerId)
    {
        return $this->delete($this->get($assignedCustomerManagerId));
    }
}