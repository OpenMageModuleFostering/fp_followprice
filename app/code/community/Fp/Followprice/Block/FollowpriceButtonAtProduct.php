<?php
class Fp_Followprice_Block_FollowpriceButtonAtProduct extends Mage_Core_Block_Template
{
	public $product;
	public $productPrice;
	public $url;
	public $media;
	public $key;
	public $position;

    /**
     * Constructor. Set template.
     */
    protected function _construct()
    {
    	if (Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Enable')){
			$this->setTemplate('fp/followprice_button.phtml');
		}
		$this->product = Mage::registry('current_product');
		$this->productPrice = number_format($this->product->getPrice(),2);
		$this->url = $this->helper('core/url')->getCurrentUrl();
		$this->media = $this->helper('catalog/image')->init($this->product, 'image');
		$this->key = Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Key');
		$this->position = Mage::getStoreConfig('Fp_Followprice_Config/section_two/Fp_Followprice_Position');
    }
	
	protected function getProduct() {
		return $this->product;
	}

	protected function getPUrl() {
		return $this->url;
	}	
	
	protected function getMedia() {
		return $this->media;
	}

	protected function getKey() {
		return $this->key;
	}

	protected function getPosition() {
		return $this->position;
	}
}
?>