<?php
/**
 * Yireo AdminPreviousNext for Magento 
 *
 * @package     Yireo_AdminPreviousNext
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright 2015 Yireo (http://www.yireo.com/)
 * @license     Open Source License
 */

/**
 * AdminPreviousNext Abstract block
 */
class Yireo_AdminPreviousNext_Block_Product extends Yireo_AdminPreviousNext_Block_Abstract
{
    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getPrevious()
    {
        $productIds = $this->getProductIds();
        $currentId = Mage::registry('current_product')->getId();
        $currentKey = array_search($currentId, $productIds);
        $previousKey = $currentKey - 1;
        if($previousKey >= 0 && isset($productIds[$previousKey])) {
            $previousId = $productIds[$previousKey];
            $previous = Mage::getModel('catalog/product')->load($previousId);
            $previous->setUrl($this->getProductUrl($previousId));
            $previous->setLabel(Mage::helper('adminpreviousnext')->__('Previous'));
            return $previous;
        }
    }

    /**
     * @return Mage_Catalog_Model_Product
     */
    public function getNext()
    {
        $productIds = $this->getProductIds();
        $currentId = Mage::registry('current_product')->getId();
        $currentKey = array_search($currentId, $productIds);
        $nextKey = $currentKey + 1;
        if(isset($productIds[$nextKey])) {
            $nextId = $productIds[$nextKey];
            $next = Mage::getModel('catalog/product')->load($nextId);
            $next->setUrl($this->getProductUrl($nextId));
            $next->setLabel(Mage::helper('adminpreviousnext')->__('Next'));
            return $next;
        }
    }

    /**
     * @return array
     */
    protected function getProductIds()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $productIds = $collection->getAllIds();
        return $productIds;
    }

    protected function getProductUrl($productId)
    {
        $arguments = array('id' => $productId);
        $currentParameters = array('store', 'active_tab');

        foreach ($currentParameters as $currentParameter) {
            $currentValue = Mage::app()->getRequest()->getParam($currentParameter);
            if (!empty($currentValue)) {
                $arguments[$currentParameter] = $currentValue;
            }
        }

        return Mage::helper('adminhtml')->getUrl('adminhtml/catalog_product/edit', $arguments);
    }
}
