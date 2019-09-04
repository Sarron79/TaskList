<?php
/**
 * Task Repository
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Model;

use KtTeam\TaskList\Api\Data\TaskInterface;
use KtTeam\TaskList\Api\Data\TaskSearchResultInterface;
use KtTeam\TaskList\Api\TaskRepositoryInterface;
use KtTeam\TaskList\Model\ResourceModel\Task as TaskResource;
use KtTeam\TaskList\Model\ResourceModel\Task\CollectionFactory as TaskCollectionFactory;
use KtTeam\TaskList\Api\Data\TaskSearchResultInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Api\SearchResultsInterface;


class TaskRepository implements TaskRepositoryInterface
{

    /** @var TaskInterface[] */
    private $cache = [];

    /** @var TaskResource */
    private $taskResource;

    /** @var TaskFactory */
    private $taskFactory;

    /** @var TaskCollectionFactory */
    private $taskCollectionFactory;

    /** @var TaskSearchResultInterfaceFactory */
    private $taskSearchResultFactory;

    /** @var CollectionProcessorInterface */
    private $collectionProcessor;

    public function __construct(
        TaskResource $taskResource,
        TaskFactory $taskFactory,
        TaskCollectionFactory $taskCollectionFactory,
        TaskSearchResultInterfaceFactory $taskSearchResultFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->taskResource = $taskResource;
        $this->taskFactory  = $taskFactory;
        $this->taskCollectionFactory = $taskCollectionFactory;
        $this->taskSearchResultFactory = $taskSearchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param int $id id
     * @return TaskInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): TaskInterface
    {
        if (!isset($this->cache[$id])) {
            /** @var Task $task */
            $task = $this->taskFactory->create();
            $this->taskResource->load($task, $id);

            if (!$task->getId()) {
                throw new NoSuchEntityException(__('Requested Task does not exist'));
            }

            $this->cache[$id] = $task;
        }

        return $this->cache[$id];
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria search criteria
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var TaskResource\Collection $taskCollection */
        $taskCollection = $this->taskCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $taskCollection);

        /** @var TaskSearchResultInterface $searchResult */
        $searchResult = $this->taskSearchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($taskCollection->getItems());
        $searchResult->setTotalCount($taskCollection->getSize());
        return $searchResult;
    }

    /**
     * @param TaskInterface $task task
     * @return TaskInterface
     * @throws StateException
     */
    public function save(TaskInterface $task)
    {
        try {
            $this->taskResource->save($task);
            $this->cache[$task->getId()] = $task;
        } catch (\Exception $e) {
            throw new StateException(__('Unable to save task #%1', $task->getId()));
        }
        return $this->cache[$task->getId()];
    }

    /**
     * @param TaskInterface $task task
     * @return bool
     * @throws StateException
     */
    public function delete(TaskInterface $task): bool
    {
        try {
            /** @var TaskInterface $task */
            $this->taskResource->delete($task);
            unset($this->cache[$task->getId()]);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove task #%1', $task->getId()));
        }

        return true;
    }

    /**
     * @param int $id id
     * @return bool
     * @throws \Exception
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->get($id));
    }
}
