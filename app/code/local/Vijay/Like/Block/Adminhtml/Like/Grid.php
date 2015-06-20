<?php
class Vijay_Like_Block_Adminhtml_Like_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('likeGrid');
        $this->setDefaultSort('product_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('like/like')->getCollection();
		$collection->getSelect()->columns('count(*) as like_count')->group('product_id');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        /*
		$this->addColumn('like_id', array(
            'header'    => Mage::helper('like')->__('Like ID'),
            'align'     => 'right',
			'type'		=> 'number',
            'index'     => 'like_id',
			'filter' 	=> false,
			'sortable'  => true,
        ));
		*/

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('like')->__('Product Id'),
            'align'     => 'right',
			'width'		=> '120px',
            'index'     => 'product_id',
        )); 
 
        $this->addColumn('product_name', array(
            'header'    => Mage::helper('like')->__('Product Name'),
            'align'     => 'left',
			'width'		=> '200px',
            'index'     => 'product_id',
			'filter' 	=> false,
			'sortable'  => false,
			'renderer'	=> 'Vijay_Like_Block_Adminhtml_Renderer_Productname'
        ));
        $this->addColumn('product_sku', array(
            'header'    => Mage::helper('like')->__('Product SKU'),
            'align'     => 'left',
			'width'		=> '120px',
            'index'     => 'product_id',
			'filter' 	=> false,
			'sortable'  => false,
			'renderer'	=> 'Vijay_Like_Block_Adminhtml_Renderer_Productsku'
        ));
		/*
        $this->addColumn('customer_id ', array(
            'header'    => Mage::helper('like')->__('Customer Id'),
            'align'     => 'left',
			'width'		=> '120px',
            'index'     => 'customer_id',
			'filter' 	=> false,
			'sortable'  => false,
			'renderer'	=> 'Vijay_Like_Block_Adminhtml_Renderer_Customername'
        ));
		*/
		$this->addColumn('like_count', array(
			'header'    => Mage::helper('like')->__('Like Count'),
			'width'     => '150',
			'index'     => 'like_count',
			'filter' 	=> false,
			'sortable'  => false,
			
		));
			
		$this->addExportType('*/*/exportCsv', Mage::helper('like')->__('CSV'));
		// $this->addExportType('*/*/exportXml', Mage::helper('like')->__('XML'));		
        return parent::_prepareColumns();
    }
	
	
	protected function _prepareMassaction()
    {
        // $this->setMassactionIdField('id');
        // $this->getMassactionBlock()->setFormFieldName('like');
		
        // $this->getMassactionBlock()->addItem('delete', array(
             // 'label'    => Mage::helper('like')->__('Delete'),
             // 'url'      => $this->getUrl('*/*/massDelete'),
             // 'confirm'  => Mage::helper('like')->__('Are you sure Want to Delete?')
        // ));
		
        // return $this;
    }
	
    // public function getRowUrl($row) {
       // return $this->getUrl('*/*/view', array('id' => $row->getId()));
    //}
	
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
}