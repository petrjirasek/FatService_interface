<?php

class ItemFacade
{

    /** @var \ItemRepository */
    private $repository;

    public function __construct(ItemRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return \Item[]
     */
    public function getAllItems()
    {
        return $this->repository->findAll(null);
    }


    /**
     * @return \Item[]
     */
    public function getAllBurgers()
    {
        return $this->repository->findAll('burgers');
    }


    /**
     * @return \Item[]
     */
    public function getAllDrinks()
    {
        return $this->repository->findAll('drinks');
    }


    /**
     * @param int $id
     * @return \Item
     */
    public function getItemById($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * @param \Item $item
     * @return \ItemService
     */
    public function remove(Item $item)
    {
        $this->repository->remove($item);
        return $this;
    }


    /**
     * @param \Item $item
     * @return \ItemService
     */
    public function persist(Item $item)
    {
        $this->repository->persist($item);
        return $this;
    }


}