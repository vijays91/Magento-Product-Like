<?php
class Vijay_Like_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
	{	
		/*
		$collection = Mage::getModel('sales/order')->getCollection();
		$collection->addAttributeToSelect('increment_id');
		$collection->addAttributeToSelect('grand_total' );
		$collection->addAttributeToSelect('status');
		$collection->getSelect()->join(array('sub' => $collection->getTable('sales/order_item')),'main_table.entity_id = sub.order_id', array('product_id' => 'product_id', 'qty_canceled' =>'qty_canceled', 'qty_refunded'=>'qty_refunded', 'qty_ordered' => 'qty_ordered'));		
		$collection->getSelect()->columns(' CAST(SUM(qty_ordered- qty_canceled - qty_refunded)as UNSIGNED) AS qty')->group(array('product_id', 'status'));
		$collection->getSelect()->where('product_id = 1');
		echo $collection->getSelect();
		print_r($collection->getData());		
		*/
	}
	
	public function likeAction() {
		$customer_id = $this->getRequest()->getParam('cid');
		$product_id  = $this->getRequest()->getParam('pid');
		$like = $this->getRequest()->getParam('arg');		
		if($customer_id && $product_id && $like ) {
			if($like == "like")
			{
				/*- Here Unlike (delete) -*/
				$collection = Mage::getModel("like/like")->getCollection()->addFieldToFilter('product_id',array(array('eq' => $product_id)))->addFieldToFilter('customer_id',array(array('eq' => $customer_id)));
				$like_id = 0;
				foreach($collection as $row) {
					$like_id = $row->getlike_id();
				}
				Mage::getModel("like/like")->setId($like_id)->delete();	
				/*- Get Product Count -*/
				$count = $this->getLayout()->createBlock('like/like')->getprodlikes($product_id);
				$_data = array(	'succ' => 200, 'arg' => $like, 'like_count' => $count);	
			} else if($like == "unlike") {
			
				/*- Here like (Save) -*/
				$like_data = array( 'customer_id' => $customer_id, 'product_id' => $product_id, 'created_at' => date('Y-m-d H:i:s'));				
				$collection = Mage::getModel('like/like')->setData($like_data);		
				$insert_id  = $collection->save()->getId();
				/*- Get Product Count -*/
				$count = $this->getLayout()->createBlock('like/like')->getprodlikes($product_id);
				$_data = array(	'succ' => 200, 'arg' => $like, 'like_count' => $count);
				
			} else {
				$_data = array(	'fail' => 202,);
			}
			
		} else {
			$_data = array(	'fail' => 201,);
		}
		$this->getResponse()->setBody(json_encode($_data));
	}
}