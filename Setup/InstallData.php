<?php
/**
 * Created by PhpStorm.
 * User: BOBLEE
 * Date: 30/01/2020
 * Time: 2:08 PM
 */

namespace Vaimo\UserAccountPostcodeManagement\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 * @package Vaimo\UserAccountPostcodeManagement\Setup
 */
class InstallData implements InstallDataInterface
{

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $installer->getConnection()->insertMultiple(
            InstallSchema::POST_CODE_TABLE_NAME,
            $this->preparePostCodeForInsert()
        );

        $installer->getConnection()->insertMultiple(
            InstallSchema::ACCOUNT_MANAGERS_TABLE_NAME,
            $this->prepareManagerNamesForInsert()
        );

        $managerAttached = $this->_attachManagerId($installer);
        $managerCodes = $this->_attachPostCodeId($installer, $managerAttached);

        $installer->getConnection()->insertMultiple(
            InstallSchema::ACCOUNT_MANAGER_POST_CODES_TABLE_NAME,
            $managerCodes
        );
        $installer->endSetup();
    }

    /**
     * @return array
     */
    public function getPostCodeData(){

        return [
                ['GU1 1','Dave Lister'],
                ['GU1 2','Arnold Rimmer'],
                ['GU1 3','Arthur Dent'],
                ['GU1 4','Ford Prefect'],
                ['GU1 9','Dave Lister'],
                ['GU10 1','Arnold Rimmer'],
                ['GU10 2','Arthur Dent'],
                ['GU10 3','Ford Prefect'],
                ['GU10 4','Dave Lister'],
                ['GU10 5','Arnold Rimmer'],
                ['GU11 1','Arthur Dent'],
                ['GU11 2','Ford Prefect'],
                ['GU11 3','Dave Lister'],
                ['GU11 9','Arnold Rimmer'],
                ['GU12 4','Arthur Dent'],
                ['GU12 5','Ford Prefect'],
                ['GU12 6','Dave Lister'],
                ['GU14 0','Arnold Rimmer'],
                ['GU14 4','Arthur Dent'],
                ['GU14 6','Ford Prefect'],
                ['GU14 7','Dave Lister'],
                ['GU14 8','Arnold Rimmer'],
                ['GU14 9','Arthur Dent'],
                ['GU15 1','Ford Prefect'],
                ['GU15 2','Dave Lister'],
                ['GU15 3','Arnold Rimmer'],
                ['GU15 4','Arthur Dent'],
                ['GU15 9','Ford Prefect'],
                ['GU16 6','Dave Lister'],
                ['GU16 7','Arnold Rimmer'],
                ['GU16 8','Arthur Dent'],
                ['GU16 9','Ford Prefect'],
                ['GU17 0','Dave Lister'],
                ['GU17 9','Arnold Rimmer'],
                ['GU18 5','Arthur Dent'],
                ['GU19 5','Ford Prefect'],
                ['GU2 4','Dave Lister'],
                ['GU2 7','Arnold Rimmer'],
                ['GU2 8','Arthur Dent'],
                ['GU2 9','Ford Prefect'],
                ['GU20 6','Dave Lister'],
                ['GU21 2','Arnold Rimmer'],
                ['GU21 3','Arthur Dent'],
                ['GU21 4','Ford Prefect'],
                ['GU21 5','Dave Lister'],
            ];
    }

    /**
     * @return array
     */
    public function getAccountManagers()
    {

        $data = $this->getPostCodeData();
        $managers = [];
        foreach($data as $dt){
            $managers[] = $dt[1];
        }

        return array_unique($managers);
    }

    /**
     * @return array
     */
    public function getPostCodes()
    {

        $data = $this->getPostCodeData();
        $postCodes = [];
        foreach($data as $dt){
            $postCodes[] = $dt[0];
        }

        return $postCodes;
    }

    /**
     * @return array
     */
    public function getManagerPostCodes()
    {

        $data = $this->getPostCodeData();
        $result = [];

        foreach ($data as $dt){
            if(empty($result[$dt[1]]))
            {
                $result[$dt[1]] = [];
            }
            $result[$dt[1]][] = $dt[0];
        }

        return $result;
    }

    /**
     * @return array
     */
    public function preparePostCodeForInsert(){
        $postCodes = $this->getPostCodes();
        $rows = [];

        foreach ($postCodes as $code){
            $rows[] = ['code'=>$code];
        }
        return $rows;
    }


    /**
     * @return array
     */
    public function prepareManagerNamesForInsert()
    {
        $names = array_keys($this->getManagerPostCodes());
        $rows = [];
        foreach ($names as $name){
            $rows[] = ['manager_name'=>$name];
        }
        return $rows;
    }

    private function _attachManagerId($installer){

        $select = $installer->getConnection()
            ->select()
            ->from(
                InstallSchema::ACCOUNT_MANAGERS_TABLE_NAME,
                ['entity_id', 'manager_name']);
        $rows = $installer->getConnection()->fetchAll($select);

        $manager = [];

        $managerPostCodes = $this->getManagerPostCodes();

        if($rows){
            foreach ($rows as $row){
                $manager[$row['entity_id']] = $managerPostCodes[$row['manager_name']];
            }
        }
        return $manager;
    }

    /**
     * @param ModuleDataSetupInterface $installer
     * @param array $attachedManagers
     * @return array
     */
    private function _attachPostCodeId($installer, $attachedManagers){

        $select = $installer->getConnection()
            ->select()
            ->from(
                InstallSchema::POST_CODE_TABLE_NAME,
                ['entity_id', 'code']);
        $rows = $installer->getConnection()->fetchAll($select);

        $postcodes = [];

        if($attachedManagers){
            foreach ($attachedManagers as $managerId=>$managerCodes){
                foreach ($managerCodes as $each)
                {
                    $index = array_search($each, array_column($rows, 'code'));
                    $postcodes[] = [
                        'account_manager_id'=>$managerId,
                        'post_code_id'=>$rows[$index]['entity_id']
                    ];
                }
            }
        }
        return $postcodes;
    }
}