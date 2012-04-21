<?php

class OrderFacade
{

    /** @var \OrderRepository */
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Order[]
     */
    public function getAllOrders()
    {
        return $this->repository->findAll();
    }


    /**
     * @param int $id
     * @return \Order
     */
    public function getOrderById($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * @param \Order $order
     * @return \OrderService
     */
    public function remove(Order $order)
    {
        $this->repository->remove($order);
        return $this;
    }


    /**
     * @param \Order $order
     * @return \OrderService
     */
    public function persist(Order $order)
    {
        $this->repository->persist($order);
        return $this;
    }


    public function deliverOrder(Order $order) {
        $order->setDelivered(TRUE);
        $this->persist($order);

        return $this;
    }

}