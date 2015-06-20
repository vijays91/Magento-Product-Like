<?php
class Vijay_Like_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_LIKE_ENABLE   = 'like_tab/like_setting/like_active';
	
	public function conf($code, $store = null) {
        return Mage::getStoreConfig($code, $store);
    }
	
	public function like_enable($store) {
		return $this->conf(self::XML_PATH_LIKE_ENABLE, $store);
	}
}