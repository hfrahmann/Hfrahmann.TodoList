<?php
namespace Hfrahmann\TodoList\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Hfrahmann.TodoList".    *
 *                                                                        */

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * Todo
 *
 * @Flow\Entity
 * @Flow\Scope("prototype")
 */
class Todo {

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=1, "maximum"=250 })
     */
    protected $title = "";

    /**
     * @var string
     * @Flow\Validate(type="NotEmpty")
     * @Flow\Validate(type="StringLength", options={ "minimum"=1 })
     */
    protected $description = "";

    /**
     * @var \DateTime
     * @Flow\Validate(type="NotEmpty")
     */
    protected $creationDate = NULL;

    /**
     * @var Category
     * @ORM\ManyToOne(inversedBy="todos")
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $category = NULL;

    /**
     * @var bool
     */
    protected $done = FALSE;

    /**
     * @var \TYPO3\Flow\Security\Account
     * @ORM\ManyToOne
     * @ORM\JoinColumn(onDelete="SET NULL")
     */
    protected $author = NULL;

    /**
     * Construct
     */
    public function __construct() {
        $this->creationDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    /**
     * @return Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category) {
        $this->category = $category;
    }

    /**
     * @return boolean
     */
    public function isDone() {
        return $this->done;
    }

    /**
     * @param boolean $done
     */
    public function setDone($done) {
        $this->done = $done;
    }

    /**
     * @return \TYPO3\Flow\Security\Account
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param \TYPO3\Flow\Security\Account $author
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

}

?>