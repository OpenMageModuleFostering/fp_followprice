<?php
class Fp_Followprice_Model_Allignment
{
    public function toOptionArray()
    {
        return array(
            array('value'=>"", 'label'=>Mage::helper('Fp_Followprice')->__('Default')),
            array('value'=>"float:left;", 'label'=>Mage::helper('Fp_Followprice')->__('Left')),
            array('value'=>"float:right;", 'label'=>Mage::helper('Fp_Followprice')->__('Right'))             
        );
    }

}
?>