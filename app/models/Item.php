<?php

class Item extends \Nette\Object
{

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $category;

    /**
     * @param int $id
     * @param string $name
     * @param string $category
     */
    public function __construct($id, $name, $category)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
    }


    public function setId($id) {
        if ($id == null)
            $this->id = $id;
    }


    public function getId() {
        return $this->id;
    }


    public function getName() {
        return $this->name;
    }


    public function getCategory() {
        return $this->category;
    }

}