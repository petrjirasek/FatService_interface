<?php

class Order extends \Nette\Object
{

    /** @var int */
    private $id;

    /** @var string */
    private $order;

    /** @var string */
    private $datetime;

    /** @var bool */
    private $delivered;
    /**
     * @param int $id
     * @param string $order
     * @param string $datetime
     * @param bool $seen
     */
    public function __construct($id, $order, $datetime = null, $delivered = false)
    {
        $this->id = $id;
        $this->order = $order;
        $this->datetime = ($datetime !== null) ? $datetime : new DateTime();
        $this->delivered = $delivered;
    }


    public function setId($id) {
        if ($id == null)
            $this->id = $id;
    }


    public function getId() {
        return $this->id;
    }


    public function getOrder() {
        return $this->order;
    }


    public function getDatetime() {
        return $this->datetime;
    }


    public function getDelivered() {
        return $this->delivered;
    }


    public function setDelivered($delivered) {
        $this->delivered = $delivered;
    }


}