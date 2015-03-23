<?php
namespace Hfrahmann\TodoList\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Hfrahmann.TodoList".    *
 *                                                                        */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * Category for Todos
 *
 * @Flow\Entity
 * @Flow\Scope("prototype")
 */
class Category {

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=100 })
     */
    protected $name = "";

    /**
     * @var Collection<Todo>
     * @ORM\OneToMany(mappedBy="category")
     */
    protected $todos;

    /**
     * Construct
     */
    public function __construct() {
        $this->todos = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return Collection<Todo>
     */
    public function getTodos() {
        return $this->todos;
    }

    public function __toString() {
        return $this->name;
    }

}

?>