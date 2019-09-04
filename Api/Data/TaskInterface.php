<?php
/**
 * Service Container Task Interface
 *
 * @category KtTeam
 * @package  KtTeam_TaskList
 * @author   Nikita Sarychev <sarron80@yandex.ru>
 */
namespace KtTeam\TaskList\Api\Data;

interface TaskInterface
{
    const ENTITY_ID  = 'entity_id';
    const TITLE      = 'title';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @param string $title title
     * @return $this
     */
    public function setTitle(string $title);
}
