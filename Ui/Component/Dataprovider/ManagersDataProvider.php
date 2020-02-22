<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 01/02/2020
 * Time: 10:44 AM
 */

namespace Vaimo\UserAccountPostcodeManagement\Ui\Component\DataProvider;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Vaimo\UserAccountPostcodeManagement\Api\AccountManagerPostCodesRepositoryInterface;
use Magento\Framework\App\ResourceConnection;

/**
 * Class ManagersDataProvider
 * @package Vaimo\UserAccountPostcodeManagement\Ui\Component\DataProvider
 */
class ManagersDataProvider extends DataProvider
{

    /**
     * @var AccountManagerPostCodesRepositoryInterface
     */
    private $_accountManagerPostCodesRepository;

    /**
     * @var ResourceConnection
     */
    private $_connection;

    /**
     * ManagersDataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param AccountManagerPostCodesRepositoryInterface $accountManagerPostCodesRepository
     * @param ResourceConnection $connection
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        AccountManagerPostCodesRepositoryInterface $accountManagerPostCodesRepository,
        ResourceConnection $connection,
        array $meta = [],
        array $data = []
    )
    {

        $this->_accountManagerPostCodesRepository = $accountManagerPostCodesRepository;
        $this->_connection = $connection;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
    }

    /**
     * @return array
     */
    public function getData()
    {
        $connection = $this->_connection->getConnection();
        $query = $connection->select()
            ->from(['pc'=>$connection->getTableName('post_codes')],
                ['am.manager_name',
                    'pc.code',
                    'ampc.entity_id as id',
                    'ampc.account_manager_id'
                ])
            ->join(['ampc'=>$connection->getTableName('account_manager_post_codes')], 'ampc.post_code_id = pc.entity_id')
            ->join(['am'=>$connection->getTableName('account_managers')], 'ampc.account_manager_id=am.entity_id');

        $items = $connection->fetchAll($query);

        $result = [];

        foreach ($items as $item)
        {
            $result[$item['id']] = [
                'manager_name'=>$item['manager_name'],
                'code' => $item['code'],
                'id'=>$item['id']
                ];
        }
        return $result;
    }

}