<?php
class Fp_Followprice_Model_Enable
{
    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>Mage::helper('Fp_Followprice')->__('Yes')),
            array('value'=>0, 'label'=>Mage::helper('Fp_Followprice')->__('No')),          
        );
    }

}
?>