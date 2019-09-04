<?php
/**
 * Task Collection
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Model\ResourceModel\Task;

use KtTeam\TaskList\Model\Task;
use KtTeam\TaskList\Model\ResourceModel\Task as TaskResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * init model and resource model
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(Task::class, TaskResource::class);
    }
}
