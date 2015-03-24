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
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\Context
     */
    protected $securityContext;

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
    public function addAction(Todo $todo = NULL) {
        if($todo === NULL) {
            $todo = new Todo();
        }
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
            $todo->setCreationDate(new \DateTime());
            $todo->setAuthor($this->securityContext->getAccount());
            $this->todoRepository->add($todo);
        } else {
            $this->todoRepository->update($todo);
        }
        $this->redirect('details', NULL, NULL, array('todo' => $todo));
    }

    /**
     * @param Todo $todo
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function deleteAction(Todo $todo) {
        $this->todoRepository->remove($todo);
        $this->redirect('index');
    }

    /**
     * @param Todo $todo
     * @param bool $done
     * @param bool $showDetails
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     * @return string
     */
    public function markTodoAction(Todo $todo, $done, $showDetails = FALSE) {
        $todo->setDone($done);
        $this->todoRepository->update($todo);

        if($showDetails === TRUE) {
            $this->redirect('details', NULL, NULL, array('todo' => $todo));
        }
        return '';
    }

    /**
     * Details Action
     * @param Todo $todo
     */
    public function detailsAction(Todo $todo) {
        $this->view->assign('todo', $todo);
    }

    /**
     *
     */
    public function editCategoriesAction() {
        $categories = $this->categoryRepository->findAll();
        $this->view->assign('categories', $categories);
    }

    /**
     * @param string $name
     * @return string
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function addCategoryAction($name) {
        $category = new Category();
        $category->setName($name);
        $this->categoryRepository->add($category);
        $this->redirect('editCategories');
        return '';
    }

    /**
     * @param Category $category
     * @return string
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function updateCategoryAction(Category $category) {
        $this->categoryRepository->update($category);
        $this->redirect('editCategories');
        return '';
    }

    /**
     * @param Category $category
     * @return string
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function deleteCategoryAction(Category $category) {
        $this->categoryRepository->remove($category);
        $this->redirect('editCategories');
        return '';
    }

}

?>