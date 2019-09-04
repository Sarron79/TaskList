<?php
/**
 * Task Model
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Model;

use KtTeam\TaskList\Api\Data\TaskInterface;
use KtTeam\TaskList\Model\ResourceModel\Task as TaskResource;
use Magento\Framework\Model\AbstractModel;

class Task extends AbstractModel implements TaskInterface
{
    /** @var string  */
    protected $_idFieldName = TaskInterface::ENTITY_ID;

    /**
     * init resource
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(TaskResource::class);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getData(TaskInterface::TITLE);
    }

    /**
     * @param string $title title
     * @return mixed
     */
    public function setTitle(string $title)
    {
        $this->setData(TaskInterface::TITLE, $title);
        return $this;
    }
}
