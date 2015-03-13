<?php
namespace Hfrahmann\TodoList\Controller\Module;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Hfrahmann.TodoList".    *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * The Hfrahmann.TodoList module controller
 *
 * @Flow\Scope("singleton")
 */
class TodoListController extends \TYPO3\Neos\Controller\Module\AbstractModuleController
{

    public function indexAction() {

    }

    public function addAction() {
        return "Test Add";
    }

}

?>