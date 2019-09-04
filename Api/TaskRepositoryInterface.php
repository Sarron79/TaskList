<?php
/**
 * Service Container Task Repository Interface
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Api;

use KtTeam\TaskList\Api\Data\TaskInterface;
use KtTeam\TaskList\Api\Data\TaskSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface TaskRepositoryInterface
{
    /**
     * @param int $id id
     * @return TaskInterface
     */
    public function get(int $id): TaskInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria search criteria
     * @return TaskSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param TaskInterface $task task
     * @return TaskInterface
     */
    public function save(TaskInterface $task);

    /**
     * @param TaskInterface $task task
     * @return bool
     */
    public function delete(TaskInterface $task): bool;

    /**
     * @param int $id id
     * @return bool
     */
    public function deleteById(int $id): bool;
}
