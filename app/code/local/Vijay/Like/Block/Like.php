<?php
class Vijay_Like_Block_Like extends Mage_Core_Block_Template
{ 
	public function getprodlikes($prodid)
	{
		$collection = Mage::getModel("like/like")->getCollection()->addFieldToFilter('product_id',array(array('eq' => $prodid)));
		$collection->getSelect()->columns('count(*) as like_count')->group('product_id');
		$count = 0;
		if ($collection) {
			$like_count = $collection->getData();
			$count = ($like_count[0]['like_count']) ?$like_count[0]['like_count'] : 0 ;
		}
		return $count;
	}

	public function getuser()
	{
		$user = Mage::getSingleton('customer/session')->getCustomerId();
		return $user;
	}
	
	public function getuserlike($prodid, $user)
	{
		$collection = Mage::getModel("like/like")->getCollection()->addFieldToFilter('product_id',array(array('eq' => $prodid)))->addFieldToFilter('customer_id',array(array('eq' => $user)));
		$liked = 0;
		if ($collection) {
			foreach ($collection as $like) {
				$liked++;
			}
		}
		return $liked;
	}
   	public function getTotalOrder($prodid) 
	{
		/* $prodid = Mage::registry('current_product')->getId(); */
		$ret = 0;
		if($prodid) {
			$collection = Mage::getModel('sales/order')->getCollection();
			$collection->addAttributeToSelect('increment_id');
			$collection->addAttributeToSelect('grand_total' );
			$collection->addAttributeToSelect('status');
			$collection->getSelect()->join(array('sub' => $collection->getTable('sales/order_item')),'main_table.entity_id = sub.order_id', array('product_id' => 'product_id', 'qty_canceled' =>'qty_canceled', 'qty_refunded'=>'qty_refunded', 'qty_ordered' => 'qty_ordered'));		
			$collection->getSelect()->columns(' CAST(SUM(qty_ordered- qty_canceled - qty_refunded)as UNSIGNED) AS qty')->group(array('product_id', 'status'));
			$collection->getSelect()->where('product_id = '. $prodid);
			
			$totalOrder = $collection->getData();
			if(count($totalOrder) > 0) {
				$ret = $totalOrder[0]['qty'];
			}
		}
		return $ret;
	}
}
?>