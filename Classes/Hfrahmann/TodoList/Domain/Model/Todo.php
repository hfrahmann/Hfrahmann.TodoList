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
    protected $content = "";

    /**
     * @var \DateTime
     * @Flow\Validate(type="NotEmpty")
     */
    protected $creationDate = NULL;

    /**
     * @var Category
     * @ORM\ManyToOne(inversedBy="todos")
     */
    protected $category = NULL;

    /**
     * @var bool
     */
    protected $done = FALSE;

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
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
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

}

?>