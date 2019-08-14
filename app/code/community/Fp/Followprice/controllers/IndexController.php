<?php
class Fp_Followprice_IndexController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();

        //create a text block with the name of "example-block"
        $block = $this->getLayout()
        ->createBlock('core/text', 'example-block')
        ->setText("<h4><a href='https://followprice.co/business/login' target='_blank'>Open in a new window.</a></h4><iframe id='fpr-iframe' src='https://followprice.co/business/login' style='width:100%; height: 800px;''></iframe>");

        $this->_addContent($block);
        $this->_setActiveMenu('report/Followprice');

        $this->renderLayout();
	}
}