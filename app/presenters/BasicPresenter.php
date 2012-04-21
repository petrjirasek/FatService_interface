<?php

/**
 * Basic presenter.
 *
 * @author     John Doe
 * @package    MyApplication
 */
class BasicPresenter extends BasePresenter
{

	public function renderDefault()
	{

	}


    public function renderOrders() {
        $new = new Order(null, 'New Big One');
        //$this->context->orderFacade->persist($new);
       // $this->context->orderFacade->remove($new);


        $this->template->orders = $this->context->orderFacade->getAllOrders();
    }


    public function actionDeleteOrder($id) {
        $order = $this->context->orderFacade->getOrderById($id);
        $this->context->orderFacade->remove($order);
        $this->flashMessage("The order has been deleted.", "success");
        $this->redirect("Basic:orders");
    }


    public function actionDeliverOrder($id) {
        $order = $this->context->orderFacade->getOrderById($id);
        $this->context->orderFacade->deliverOrder($order);
        $this->flashMessage("The order has been delivered.", "success");
        $this->redirect("Basic:orders");
    }


    public function actionDeleteItem($id) {
        $item = $this->context->itemFacade->getItemById($id);
        $this->context->itemFacade->remove($item);
        $this->flashMessage("The order has been deleted.", "success");
        $this->redirect("Basic:" . $item->getCategory());
    }


    public function renderBurgers() {
        $this->template->items = $this->context->itemFacade->getAllBurgers();
    }


    public function renderDrinks() {
        $this->template->items = $this->context->itemFacade->getAllDrinks();
    }


    public function renderStrategy() {

    }


    protected function createComponentBurgerForm()
    {
        $form = new Nette\Application\UI\Form;
        $form->addText('name', 'Burger name:', null, 50);
        $form->addHidden('category', 'burgers');
        $form->addSubmit('submit', 'Add burger');
        $form->onSuccess[] = callback($this, 'itemFormSubmitted');
        return $form;
    }


    protected function createComponentDrinkForm()
    {
        $form = new Nette\Application\UI\Form;
        $form->addText('name', 'Drink name:', null, 50);
        $form->addHidden('category', 'drinks');
        $form->addSubmit('submit', 'Add drink');
        $form->onSuccess[] = callback($this, 'itemFormSubmitted');
        return $form;
    }


    public function itemFormSubmitted($form)
    {
        try {
            $values = $form->getValues();

            $item = new Item(null, $values->name, $values->category);
            $this->context->itemFacade->persist($item);

            $this->flashMessage('The item has been added', 'success');
            $this->redirect('this');

        } catch (\Nette\Application\ApplicationException $e) {
            $form->addError($e->getMessage());
        }}


}
