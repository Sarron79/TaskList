<?php
/**
 * Task Resource Model
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Model\ResourceModel;

use KtTeam\TaskList\Api\Data\TaskInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Task extends AbstractDb
{
    const TABLE_NAME = 'kt_team_task';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, TaskInterface::ENTITY_ID);
    }
}
