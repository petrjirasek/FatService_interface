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


    public function renderBurgers() {

    }


    public function renderOffers() {

    }


    public function renderStrategy() {

    }

}
