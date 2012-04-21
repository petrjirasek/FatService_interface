<?php

use Nette\Database\Connection;

class OrderRepository extends \Nette\Database\Table\Selection
{

    public function __construct(Connection $connection)
    {
        parent::__construct('order', $connection);
    }

    /**
     * @param int $id
     * @return Order
     */
    public function findById($id)
    {
        $row = $this->get($id);
        $order = new Order(
            $row->id,
            $row->order,
            $row->datetime,
            $row->delivered
        );
        return $order;
    }

    /**
     * @param null $limit
     * @return \Order[]
     */
    public function findAll()
    {
        $rows = $this->order('datetime DESC');
        $orders = array();
        foreach ($rows as $row) {
            $order = new Order(
                $row->id,
                $row->order,
                $row->datetime,
                $row->delivered
            );
            $orders[] = $order;
        }
        return $orders;
    }


    /**
     * @param Order $order
     * @return \OrderRepository
     */
    public function persist(Order $order)
    {
        if ($order->getId() === null) {
        $row = $this->where(array('id' => $order->getId()))->insert(array(
            'order'  =>  $order->getOrder(),
            'datetime' =>  $order->getDatetime(),
            'delivered' =>  $order->getDelivered(),
        ));

        $order->setId($row->id);
        } else {
            $this->where(array('id' => $order->getId()))->update(array(
                'order'  =>  $order->getOrder(),
                'datetime' =>  $order->getDatetime(),
                'delivered' =>  $order->getDelivered(),
            ));
        }

        return $this;
    }


    /**
     * @param Order $order
     * @return \OrderRepository
     */
    public function remove(Order $order)
    {
        $this->where(array('id' => $order->getId()))->delete();
        return $this;
    }

}