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
class Yireo_AdminPreviousNext_Block_Order extends Yireo_AdminPreviousNext_Block_Abstract
{
    public function getPrevious()
    {
        $orderIds = $this->getOrderIds();
        $currentId = Mage::registry('current_order')->getId();
        $currentKey = array_search($currentId, $orderIds);
        $previousKey = $currentKey - 1;
        if($previousKey >= 0 && isset($orderIds[$previousKey])) {
            $previousId = $orderIds[$previousKey];
            $previous = Mage::getModel('sales/order')->load($previousId);
            $previous->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/sales_order/view', array('order_id' => $previousId)));
            $previous->setLabel(Mage::helper('adminpreviousnext')->__('Previous'));
            return $previous;
        }
    }

    public function getNext()
    {
        $orderIds = $this->getOrderIds();
        $currentId = Mage::registry('current_order')->getId();
        $currentKey = array_search($currentId, $orderIds);
        $nextKey = $currentKey + 1;
        if(isset($orderIds[$nextKey])) {
            $nextId = $orderIds[$nextKey];
            $next = Mage::getModel('sales/order')->load($previousId);
            $next->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/sales_order/view', array('order_id' => $nextId)));
            $next->setLabel(Mage::helper('adminpreviousnext')->__('Next'));
            return $next;
        }
    }

    public function getOrderIds()
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $orderIds = $collection->getAllIds();
        return $orderIds;
    }
}
