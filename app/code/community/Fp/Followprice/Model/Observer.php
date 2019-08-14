<?php
class Fp_Followprice_Model_Observer
{

	/**
     * @param Varien_Event_Observer $observer
     * @return Fp_Followprice_Model_Observer
     */

	public function createList (Varien_Event_Observer $observer)
	{
		if((!Mage::registry('current_product')) && Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Enablelist') && (Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Enable'))) {
			$block = $observer->getBlock();
			if (($block instanceof Mage_Catalog_Block_Product_Price) && ($block instanceof Mage_Catalog_Block_Product_Abstract)) {
				$transport = $observer->getTransport();
				$html = $transport->getHtml();

				$product = $block->getProduct();
				$name = $product->name;
				$id = $product->entity_id;
				$url = $product->url;

				$_product = Mage::getModel('catalog/product')->load($id);
				$image = Mage::helper('catalog/image')->init($_product, 'image');

				//Get category
				$categoryIds = $_product->getCategoryIds();
				$_category = Mage::getModel('catalog/category')->load($categoryIds[0]);

				//Get button style
				$style = explode(',', Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Style'));
				$stylearray = array(0,0,0,0);
				foreach ($style as $val) {
					if ($val == 1) {
						$stylearray[0] = 1;
					} else if ($val == 2) {
						$stylearray[1] = 1;
					} else if ($val == 3) {
						$stylearray[2] = 1;
					} else if ($val == 4) {
						$stylearray[3] = 1;
					}
				}

				$button_style = "";
				if ($stylearray[0] == 1) {
					$button_style .= "no-counter,";
				}
				if ($stylearray[1] == 1) {
					$button_style .= "icon-link,";
				}
				if ($stylearray[2] == 1) {
					$button_style .= "no-full-text,";
				}
				if ($stylearray[3] == 1) {
					$button_style .= "stacked-text,";
				}

				$html .= '
				<div class="followprice-container">
					<div class="fp-button"
						data-store-key="' . Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Key') . '"
						data-style="' . $button_style . '"
						data-product-title="' . $name . '"
						data-product-id="' . $id . '"
						data-product-url="' . $url . '"
						data-product-image="' . $image . '"
						data-product-price="' . number_format($product->final_price,2) . '"
						data-product-old-price="' . number_format($product->price,2) . '"
						data-product-currency="' . Mage::app()->getStore()->getCurrentCurrencyCode() . '"
						data-product-campaign-start="' . $_product->special_from_date . '"
						data-product-campaign-end="' . $_product->special_to_date . '"
						data-product-availability ="' . $_product->stock_item->is_in_stock . '"
						data-product-stock="' . $_product->stock_item->stock_qty . '"
						data-product-manufacture="' . $_product->getAttributeText('manufacturer') . '"
						data-product-category="' . $_category->getName() . '">
					</div>
				<div>';
				$transport->setHtml($html);
			}
			if ($block instanceof Mage_Catalog_Block_Product_List) {
				$transport = $observer->getTransport();
				$html = $transport->getHtml();
				$html .= '<script>(function() { var _f = document.createElement("script");_f.type = "text/javascript"; _f.async = true; _f.src ="https://followprice.co/followbutton.js"; var s =document.getElementsByTagName("script")[0];s.parentNode.insertBefore(_f, s); })();</script>
					<style>
						.followprice-container{
							width:100%;
							display:iniline-block;
						}
						.fp-button{
							display:inline-block; ' . Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Allignmentlist') . '
							margin-top: ' . Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Margin_Toplist') . 'px;
							margin-right:' . Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Margin_Rightlist') . 'px;
							margin-bottom:' . Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Margin_Bottomlist') . 'px;
							margin-left:' . Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Margin_Leftlist') . 'px;
						}
					</style>';
				$transport->setHtml($html);
			}
		}
	}
}