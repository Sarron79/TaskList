<?php
/**
 * Save Action
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */

namespace KtTeam\TaskList\Controller\Adminhtml\Task;

use KtTeam\TaskList\Api\TaskRepositoryInterface;
use KtTeam\TaskList\Model\Task;
use KtTeam\TaskList\Model\TaskFactory;
use Magento\Backend\App\Action;

class Save extends Action
{
    /** @var TaskFactory */
    private $taskFactory;
    /** @var TaskRepositoryInterface */
    private $taskRepository;

    public function __construct(
        Action\Context $context,
        TaskFactory $taskFactory,
        TaskRepositoryInterface $taskRepository
    ) {
        $this->taskFactory = $taskFactory;
        $this->taskRepository = $taskRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return;
        }
        $taskId = $this->getRequest()->getParam('entity_id', false);
        $title = $this->getRequest()->getParam('title', '');

        try {
            if ($taskId) {
                $taskModel = $this->taskRepository->get($taskId);
            } else {
                /** @var Task $taskModel */
                $taskModel = $this->taskFactory->create();
            }
            $taskModel->setTitle($title);
            $this->taskRepository->save($taskModel);

            $this->messageManager->addSuccessMessage(__('The Task has been saved.'));

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', ['id' => $taskModel->getId(), '_current' => true]);
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $this->_redirect('*/*/edit', ['id' => $taskId]);
    }
}
