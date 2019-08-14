<?php
class Fp_Followprice_Block_Adminhtml_System_Config_Style extends Mage_Adminhtml_Block_System_Config_Form_Field{
    const CONFIG_PATH = 'Fp_Followprice_Config/section_three/Fp_Followprice_Style';
    protected $_values = null;
    protected function _construct()
    {
        $this->setTemplate('Fp_Followprice/system/config/style.phtml');
        return parent::_construct();
    }
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setNamePrefix($element->getName())
            ->setHtmlId($element->getHtmlId());
        return $this->_toHtml();
    }
    public function getValues(){
        $values = array();
        //get the available values (use the source model from your question)
        foreach (Mage::getSingleton('Fp_Followprice/style')->toOptionArray() as $value){
            $values[$value['value']] = $value['label'];
        }
        return $values;
    }
    public function getIsChecked($name){
        return in_array($name, $this->getCheckedValues());
    }
    public function getCheckedValues(){
        if (is_null($this->_values)){
            $data = $this->getConfigData();
            if (isset($data[self::CONFIG_PATH])){
                $data = $data[self::CONFIG_PATH];
            }
            else{
                $data = '';
            }
            $this->_values = explode(',', $data);
        }
        return $this->_values;
    }
}