<?php
 
class Fp_Followprice_Block_Adminhtml_Notifications extends Mage_Adminhtml_Block_Template
{
    public function getMessage()
    {
        $storeKey = Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Key');
        $report_url = Mage::helper("adminhtml")->getUrl("followpricedashboard/index/index/");
        $message = 'Please validate your Followprice account. Go to your Followprice <a href="' . $report_url . '">Report Menu</a> and follow the instructions.';
        if (empty($storeKey)) {
          return $message;
        } else {
          return null;
        }
    }
}