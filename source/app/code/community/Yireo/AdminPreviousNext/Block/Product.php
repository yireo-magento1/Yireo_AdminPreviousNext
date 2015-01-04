<?php
/**
 * Yireo AdminPreviousNext for Magento 
 *
 * @package     Yireo_AdminPreviousNext
 * @author      Yireo (http://www.yireo.com/)
 * @copyright   Copyright (c) 2014 Yireo (http://www.yireo.com/)
 * @license     Open Source License
 */

/**
 * AdminPreviousNext Abstract block
 */
class Yireo_AdminPreviousNext_Block_Product extends Yireo_AdminPreviousNext_Block_Abstract
{
    public function getPrevious()
    {
        $productIds = $this->getProductIds();
        $currentId = Mage::registry('current_product')->getId();
        $currentKey = array_search($currentId, $productIds);
        $previousKey = $currentKey - 1;
        if($previousKey >= 0 && isset($productIds[$previousKey])) {
            $previousId = $productIds[$previousKey];
            $previous = Mage::getModel('catalog/product')->load($previousId);
            $previous->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/catalog_product/edit', array('id' => $previousId)));
            $previous->setLabel(Mage::helper('adminpreviousnext')->__('Previous'));
            return $previous;
        }
    }

    public function getNext()
    {
        $productIds = $this->getProductIds();
        $currentId = Mage::registry('current_product')->getId();
        $currentKey = array_search($currentId, $productIds);
        $nextKey = $currentKey + 1;
        if(isset($productIds[$nextKey])) {
            $nextId = $productIds[$nextKey];
            $next = Mage::getModel('catalog/product')->load($nextId);
            $next->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/catalog_product/edit', array('id' => $nextId)));
            $next->setLabel(Mage::helper('adminpreviousnext')->__('Next'));
            return $next;
        }
    }

    public function getProductIds()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $productIds = $collection->getAllIds();
        return $productIds;
    }
}
