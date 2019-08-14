<?php
class Fp_Followprice_Model_Style 
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label' => Mage::helper('adminhtml')->__('Show counter')),
            array('value' => 2, 'label' => Mage::helper('adminhtml')->__('Show background')),
            array('value' => 3, 'label' => Mage::helper('adminhtml')->__('Show text')),
            array('value' => 4, 'label' => Mage::helper('adminhtml')->__('Multi-line text')),
        );
    }
}