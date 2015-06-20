<?php
class Vijay_Like_Adminhtml_LikeController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
		$this->loadLayout()->_setActiveMenu('like/items')
		->_addBreadcrumb(Mage::helper('adminhtml')->__('Like Form '), Mage::helper('adminhtml')->__('Like Form'));
		return $this;
    }  
	
   //** Email Notify Grid
    public function indexAction() 
	{
        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('like/adminhtml_like'));
        $this->renderLayout();
    }
	
	/**
     * Email Notify grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('like/adminhtml_like_grid')->toHtml()
        );
    }
	
	/*- Export in CSV -*/
	public function exportCsvAction()
    {
		$fileName   = 'product_like.csv';
		$content    = $this->getLayout()->createBlock('like/adminhtml_like_grid')->getCsv(); 
		$this->_prepareDownloadResponse($fileName, $content);
    }
	
	/*- Export in XML -*/
    public function exportXmlAction()
    {
        $fileName   = 'product_like.xml';
        $content    = $this->getLayout()->createBlock('like/adminhtml_like_grid')->getXml(); 
        $this->_prepareDownloadResponse($fileName, $content);
    }
	
	
}