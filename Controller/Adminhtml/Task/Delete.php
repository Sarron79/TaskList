<?php
/**
 * Delete Action
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */

namespace KtTeam\TaskList\Controller\Adminhtml\Task;

use KtTeam\TaskList\Api\TaskRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;

class Delete extends Action
{
    /** @var TaskRepositoryInterface */
    private $taskRepository;

    public function __construct(Action\Context $context, TaskRepositoryInterface $taskRepository)
    {
        parent::__construct($context);
        $this->taskRepository = $taskRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $taskId = (int) $this->getRequest()->getParam('id');

        if (!$taskId) {
            return;
        }

        try {
            $this->taskRepository->deleteById($taskId);
            $this->messageManager->addSuccessMessage(__('The Task has been deleted.'));
            $this->_redirect('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->_redirect('*/*/edit', ['id' => $taskId]);
        }
    }
}
