<?php
/**
 * View Block
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Block;

use KtTeam\TaskList\Api\TaskRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;

class View extends Template
{
    /** @var TaskRepositoryInterface */
    private $taskRepository;
    /** @var SearchCriteriaBuilder */
    private $searchCriteriaBuilder;

    public function __construct(
        Template\Context $context,
        TaskRepositoryInterface $taskRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        array $data = []
    ) {
        $this->taskRepository = $taskRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    public function getTasks()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->taskRepository->getList($searchCriteria)->getItems();
    }
}
