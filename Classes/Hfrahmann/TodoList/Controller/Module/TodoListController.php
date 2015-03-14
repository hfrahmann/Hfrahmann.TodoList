<?php
namespace Hfrahmann\TodoList\Controller\Module;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Hfrahmann.TodoList".    *
 *                                                                        */

use Hfrahmann\TodoList\Domain\Model\Category;
use Hfrahmann\TodoList\Domain\Model\Todo;
use Hfrahmann\TodoList\Domain\Repository\CategoryRepository;
use Hfrahmann\TodoList\Domain\Repository\TodoRepository;
use TYPO3\Flow\Annotations as Flow;

/**
 * The Hfrahmann.TodoList module controller
 *
 * @Flow\Scope("singleton")
 */
class TodoListController extends \TYPO3\Neos\Controller\Module\AbstractModuleController {

    /**
     * @Flow\Inject
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @Flow\Inject
     * @var TodoRepository
     */
    protected $todoRepository;

    /**
     * Index Action
     * @param Category $category
     */
    public function indexAction(Category $category = NULL) {
        $categories = $this->categoryRepository->findAll();
        $allTodosCount = $this->todoRepository->countAll();
        if($category === NULL) {
            $todos = $this->todoRepository->findAll();
        } else {
            $todos = $this->todoRepository->findByCategory($category);
        }
        $this->view->assign('categories', $categories);
        $this->view->assign('activeCategory', $category);
        $this->view->assign('todos', $todos);
        $this->view->assign('allTodosCount', $allTodosCount);
    }

    /**
     * Add Action
     */
    public function addAction() {
        $todo = new Todo();
        $categories = $this->categoryRepository->findAll();
        $this->view->assign('categories', $categories);
        $this->view->assign('todo', $todo);
    }

    /**
     * Edit Action
     */
    public function editAction(Todo $todo) {
        $categories = $this->categoryRepository->findAll();
        $this->view->assign('categories', $categories);
        $this->view->assign('todo', $todo);
    }

    /**
     * Save Action
     * @param Todo $todo
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function saveAction(Todo $todo) {
        if($this->persistenceManager->isNewObject($todo)) {
            $this->todoRepository->add($todo);
        } else {
            $this->persistenceManager->update($todo);
        }
        $this->redirect('index');
    }

    /**
     * Details Action
     * @param Todo $todo
     */
    public function detailsAction(Todo $todo) {
        $this->view->assign('todo', $todo);
    }

}

?>