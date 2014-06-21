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
 * AdminPreviousNext helper
 */
class Yireo_AdminPreviousNext_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getPreviousProduct()
    {
        $productIds = $this->getProductIds();
        $currentId = Mage::registry('current_product')->getId();
        $currentKey = array_search($currentId, $productIds);
        $previousKey = $currentKey - 1;
        if($previousKey >= 0 && isset($productIds[$previousKey])) {
            return $productIds[$previousKey];
        }
    }

    public function getNextProduct()
    {
        $productIds = $this->getProductIds();
        $currentId = Mage::registry('current_product')->getId();
        $currentKey = array_search($currentId, $productIds);
        $nextKey = $currentKey + 1;
        if(isset($productIds[$nextKey])) {
            return $productIds[$nextKey];
        }
    }

    public function getProductIds()
    {
        // @todo Limit this in some way - start at entity_id X and set page size to 1
        $productIds = Mage::getModel('catalog/product')->getCollection()->getAllIds();
        return $productIds;
    }
}
