<?php

use Nette\Database\Connection;

class ItemRepository extends \Nette\Database\Table\Selection
{

    public function __construct(Connection $connection)
    {
        parent::__construct('item', $connection);
    }

    /**
     * @param int $id
     * @return Item
     */
    public function findById($id)
    {
        $row = $this->get($id);
        $item = new Item(
            $row->id,
            $row->name,
            $row->category
        );
        return $item;
    }

    /**
     * @param null $limit
     * @return \Item[]
     */
    public function findAll($category)
    {
        $rows = $this->where('category', $category);
        $items = array();
        foreach ($rows as $row) {
            $item = new Item(
                $row->id,
                $row->name,
                $row->category
            );
            $items[] = $item;
        }
        return $items;
    }


    /**
     * @param Item $item
     * @return \ItemRepository
     */
    public function persist(Item $item)
    {
        if ($item->getId() === null) {
        $row = $this->where(array('id' => $item->getId()))->insert(array(
            'name'  =>  $item->getName(),
            'category' =>  $item->getCategory(),
        ));

        $item->setId($row->id);
        } else {
            $this->where(array('id' => $item->getId()))->update(array(
                'name'  =>  $item->getName(),
                'category' =>  $item->getCategory(),
            ));
        }

        return $this;
    }


    /**
     * @param Item $item
     * @return \ItemRepository
     */
    public function remove(Item $item)
    {
        $this->where(array('id' => $item->getId()))->delete();
        return $this;
    }

}