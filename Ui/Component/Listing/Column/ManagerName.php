<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 02/02/2020
 * Time: 1:24 PM
 */

namespace Vaimo\UserAccountPostcodeManagement\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Vaimo\UserAccountPostcodeManagement\Api\AssignedCustomerManagerRepositoryInterface;
use Vaimo\UserAccountPostcodeManagement\Api\AccountManagersRepositoryInterface;


/**
 * Class ManagerName
 * @package Vaimo\UserAccountPostcodeManagement\Ui\Component\Listing\Column
 */
class ManagerName extends Column
{
    /**
     * @var OrderRepositoryInterface
     */
    private $_orderRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * @var AssignedCustomerManagerRepositoryInterface
     */
    private $_assignedCustomerManagerRepository;

    /**
     * @var AccountManagersRepositoryInterface
     */
    private $_accountManagersRepository;

    /**
     * ManagerName constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param OrderRepositoryInterface $orderRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param AssignedCustomerManagerRepositoryInterface $assignedCustomerManagerRepository
     * @param AccountManagersRepositoryInterface $accountManagersRepository
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        AssignedCustomerManagerRepositoryInterface $assignedCustomerManagerRepository,
        AccountManagersRepositoryInterface $accountManagersRepository,
        array $components = [],
        array $data = []
    )
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_assignedCustomerManagerRepository = $assignedCustomerManagerRepository;
        $this->_accountManagersRepository = $accountManagersRepository;
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    /**
     * @param array $dataSource
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function prepareDataSource(
        array $dataSource
    )
    {
        /*Getting all Order Ids to be used in search.
        There is need to load order Id again because quote_id isn't part of
        the data loaded in $dataSource*/
        $orderIdArray = [];
        if(!empty($dataSource['data']) && count($dataSource['data']['items']) > 0){
            foreach ($dataSource['data']['items'] as $item){
                $orderIdArray[] = $item['entity_id'];
            }
        }

        /*Creating Search Criteria for OrderRepository to load
          Orders so that quote_id can be extracted.*/
        $criteria =$this->_searchCriteriaBuilder->addFilter(
                        'entity_id',
                        $orderIdArray,
                        'in'
                    )->create();

        /* Getting list of Orders relevant to this grid loading*/
        $list = $this->_orderRepository->getList($criteria);
        $orderAndQuoteData = [];

        /*Isolating order_Id and quote_id */
        foreach ($list->getItems() as $orderItem){
            $orderAndQuoteData[$orderItem->getEntityId()] = [
                'orderId'=>$orderItem->getEntityId(),
                'quoteId'=>$orderItem->getQuoteId(),
            ];
        }

        /* Building search criteria for Managers assigned to a Quote */
        $assignmentSearch = $this->_searchCriteriaBuilder->addFilter(
            'quote_id',
            array_column($orderAndQuoteData, 'quoteId'),
            'in'
        )->create();

        /* Getting list of Managers assigned to relevant Quotes*/
        $assignmentResult = $this->_assignedCustomerManagerRepository->getList($assignmentSearch);
        $managerAssignmentArray = [];

        /* Isolating Quote Ids and Manger Ids */
        foreach ($assignmentResult->getItems() as $assignmentItem){
            $managerAssignmentArray[$assignmentItem->getQuoteId()] = [
                'quote_id'=>$assignmentItem->getQuoteId(),
                'manager_id'=>$assignmentItem->getManagerId()
            ];
        }

        /* Building Search Criteria for Managers that are relevant to this Grid */
        $managerSearch = $this->_searchCriteriaBuilder->addFilter(
            'entity_id',
            array_column($managerAssignmentArray, 'manager_id'),
            'in'
        )->create();

        /* Getting names and Ids of Managers that are relevant to this Grid */
        $managerResult = $this->_accountManagersRepository->getList($managerSearch);
        $managerArray = [];

        /*Isolating Manager Name and Manager Id*/
        foreach ($managerResult->getItems() as $managerItem){
            $managerArray[$managerItem->getEntityId()] = [
                'manager_name'=>$managerItem->getManagerName(),
                'entity_id'=>$managerItem->getEntityId()
            ];
        }

        /* Looping through the Original data source for assignment of Manager Name
           to relevant Quote Id based on $dataSource entity_id */
        if(!empty($dataSource['data']) && count($dataSource['data']['items']) > 0){
            foreach ($dataSource['data']['items'] as $k=>$item){
                $quote_id = $orderAndQuoteData[$item['entity_id']]['quoteId'];

                if(isset($managerAssignmentArray[$quote_id]['manager_id'])){
                    $manager_id = $managerAssignmentArray[$quote_id]['manager_id'];
                    $manager_name = $managerArray[$manager_id]['manager_name'];
                }else{
                    $manager_name = '-';
                }

                $dataSource['data']['items'][$k]['manager_name'] = $manager_name;
            }
        }

        return $dataSource;
    }

}