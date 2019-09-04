<?php
/**
 * Generic Button
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Block\Adminhtml\Task\Edit;

class GenericButton
{
    protected $context;

    public function __construct(\Magento\Backend\Block\Widget\Context $context)
    {
        $this->context = $context;
    }

    /**
     * @return int |null
     */
    public function getId()
    {
        return $this->context->getRequest()->getParam('id');
    }

    public function getUrl($route = '', $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
