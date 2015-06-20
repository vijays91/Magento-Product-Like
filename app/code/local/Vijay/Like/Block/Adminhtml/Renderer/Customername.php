<?php
class Vijay_Like_Block_Adminhtml_Renderer_Customername extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		$customerid = $row->getData('customer_id');
		$model = Mage::getModel('customer/customer');
		$_customer = $model->load($customerid);		
		return $_customer->getName();

	}
}
?>