<?php
class Fp_Followprice_FeedController extends Mage_Core_Controller_Front_Action
{
    public function showAction(){
      $this->loadLayout();
      $this->getResponse()->setHeader('Content-Type','text/xml');
      $this->renderLayout();
    }
}