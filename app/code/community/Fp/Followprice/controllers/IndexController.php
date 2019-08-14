<?php
class Fp_Followprice_IndexController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
                Mage::log('indexAction');
		$this->loadLayout();
                $this->_setActiveMenu('report/followprice');
                $this->renderLayout();
        }
        public function saveAction()
        {
                Mage::log('saveAction');
        }
}