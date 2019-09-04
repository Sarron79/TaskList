<?php
/**
 * Service Container Task Search Result Interface
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TaskSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return TaskInterface[]
     */
    public function getItems();

    /**
     * @param TaskInterface[] $items items
     * @return SearchResultsInterface
     */
    public function setItems(array $items);
}
