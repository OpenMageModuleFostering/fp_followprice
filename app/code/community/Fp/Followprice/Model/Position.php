<?php
class Fp_Followprice_Model_Position
{
    public function toOptionArray()
    {
        return array(
            array('value'=>0, 'label'=>Mage::helper('Fp_Followprice')->__(' Below the price')),
            array('value'=>1, 'label'=>Mage::helper('Fp_Followprice')->__(' Below "add to cart"')),              
        );
    }

}
?>