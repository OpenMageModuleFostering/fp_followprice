<?php
class Fp_Followprice_Model_Observer
{

	/**
     * @param Varien_Event_Observer $observer
     * @return Fp_Followprice_Model_Observer
     */

	public function createList (Varien_Event_Observer $observer)
	{
		$block = $observer->getBlock();
		$class = get_class($block);
			Mage::log($class);
		// Conversion check
		if (($block instanceof Mage_Checkout_Block_Onepage_Success) && !($block instanceof Mage_Downloadable_Block_Checkout_Success)){
			$transport = $observer->getTransport();
			$html = $transport->getHtml();
			$order_id = $block->getOrderId();
			$order = Mage::getModel('sales/order')->loadByIncrementId($order_id);
			
			$html .= '<script name="fp-conversions"
				data-total="' . $order->base_subtotal . '"
				data-order-id="' . $order_id . '"
				data-user-id="' . $order->customer_id . '"
				';
			$items = $order->getAllVisibleItems();
			$counter = 0;
			foreach ($items as $item) {
				$html .= ' data-products-' . $counter . '-id=' . floatval($item->item_id) . '
				data-products-' . $counter . '-price=' . floatval($item->base_price_incl_tax);
				$counter ++;
			}
			$html .= ' src="https://followprice.co/fp-conversions.js" async></script>';
			Mage::log($items);
			$transport->setHtml($html);
		}

		// List Button
		if((!Mage::registry('current_product')) && Mage::getStoreConfig('Fp_Followprice_Config/section_three/Fp_Followprice_Enablelist') && (Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Enable'))) {
			if (($block instanceof Mage_Catalog_Block_Product_Price) && ($block instanceof Mage_Catalog_Block_Product_Abstract) && ($page !== "product")) {
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
				$_categoryparent = Mage::getModel('catalog/category')
        			->load($categoryIds[0])
        			->getParentCategory();

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
				$fp_category = $_categoryparent->getName();
				$fp_subcategory = $_category->getName();

				$html .= '
				<div class="followprice-container">
					<div class="fp-button"
						data-store-key="' . Mage::getStoreConfig('Fp_Followprice_Config/section_one/Fp_Followprice_Key') . '"
						data-style="' . $button_style . '"
						data-product-title="' . htmlspecialchars($name) . '"
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
						data-product-category="' . htmlspecialchars($fp_category) . '"
						data-product-subcategory="' . htmlspecialchars($fp_subcategory) . '">
					</div>
				<div>';
				$transport->setHtml($html);
			}
			if (($block instanceof Mage_Catalog_Block_Product_List) && ($page !== "product")) {
				//Get store language code
				$locale = Mage::app()->getLocale()->getLocaleCode();
				
				$transport = $observer->getTransport();
				$html = $transport->getHtml();
				$html .= '<script>(function() { var _f = document.createElement("script");_f.type = "text/javascript"; _f.async = true; _f.src ="https://followprice.co/followbutton.js?locale="+' . json_encode($locale) . '; var s =document.getElementsByTagName("script")[0];s.parentNode.insertBefore(_f, s); })();</script>
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