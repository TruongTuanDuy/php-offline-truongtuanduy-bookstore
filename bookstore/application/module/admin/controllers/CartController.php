<?php
class CartController extends Controller
{

	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('admin/main/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	// ACTION: LIST CART
	public function indexAction()
	{
		$this->_view->_title 		= 'Cart Manager :: List';
		$totalItems					= $this->_model->countItem($this->_arrParam, null);

		$configPagination = array('totalItemsPerPage'	=> 1, 'pageRange' => 3);
		$this->setPagination($configPagination);
		$this->_view->pagination	= new Pagination($totalItems, $this->_pagination);
		$this->_view->Items 		= $this->_model->listItem($this->_arrParam, null);
		$this->_view->render('cart/index');
	}

	// ACTION: AJAX STATUS (*)
	public function ajaxStatusAction()
	{
		$result = $this->_model->changeStatus($this->_arrParam, array('task' => 'change-ajax-status'));
		echo json_encode($result);
	}

	// ACTION: AJAX DELIVERY (*)
	public function ajaxDeliveryAction()
	{
		$result = $this->_model->changeStatus($this->_arrParam, array('task' => 'change-ajax-delivery'));
		echo json_encode($result);
	}

	// ACTION: AJAX FINISH (*)
	public function ajaxFinishAction()
	{
		$result = $this->_model->changeStatus($this->_arrParam, array('task' => 'change-ajax-finish'));
		echo json_encode($result);
	}

	// ACTION: STATUS (*)
	public function statusAction()
	{
		$this->_model->changeStatus($this->_arrParam, array('task' => 'change-status'));
		URL::redirect('admin', 'cart', 'index');
	}

	// ACTION: TRASH (*)
	/*
	public function trashAction(){
		$this->_model->deleteItem($this->_arrParam);
		URL::redirect('admin', 'cart', 'index');
	}
	*/

	// ACTION: ORDERING (*)
	public function orderingAction()
	{
		$this->_model->ordering($this->_arrParam);
		URL::redirect('admin', 'cart', 'index');
	}
}
