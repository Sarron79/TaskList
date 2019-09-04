<?php
/**
 * Task Data Provider
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Model\Task;

use KtTeam\TaskList\Model\ResourceModel\Task\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    private $loadedData = [];

    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        CollectionFactory $taskCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $taskCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }

        foreach ($this->collection->getItems() as $task) {
            $this->loadedData[$task->getId()] = $task->getData();
        }

        return $this->loadedData;
    }
}
