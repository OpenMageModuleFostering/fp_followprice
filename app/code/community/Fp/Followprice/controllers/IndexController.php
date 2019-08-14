<?php
class Fp_Followprice_IndexController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();

        //create a text block with the name of "example-block"
        $block = $this->getLayout()
        ->createBlock('core/text', 'example-block')
        ->setText("<iframe id='fpr-iframe' src='https://followprice.co/business/login?ref=header' style='width:100%; height: 800px;''></iframe>");

        $this->_addContent($block);
        $this->_setActiveMenu('report/Followprice');

        $this->renderLayout();
	}
}