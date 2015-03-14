<?php
namespace Hfrahmann\TodoList\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Hfrahmann.TodoList".    *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * The Todo Repository
 *
 * @Flow\Scope("singleton")
 * @api
 */
class TodoRepository extends \TYPO3\Flow\Persistence\Repository {

    /**
     * Construct
     */
    public function __construct() {
        $this->defaultOrderings = array('done' => 'ASC', 'creationDate' => 'DESC');
        parent::__construct();
    }

}

?>