<?php


class Vijay_Like_Block_Adminhtml_Like extends Mage_Adminhtml_Block_Widget_Grid_Container
{ 
   public function __construct()
    {
        $this->_controller = 'adminhtml_like';
        $this->_blockGroup = 'like';
        $this->_headerText = Mage::helper('like')->__('Product Likes Report');
        parent::__construct();
		$this->_removeButton('add');
    }
}
?>