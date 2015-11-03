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
class Yireo_AdminPreviousNext_Block_Order extends Yireo_AdminPreviousNext_Block_Abstract
{
    /**
     * @return Mage_Sales_Model_Order
     */
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

    /**
     * @return Mage_Sales_Model_Order
     */
    public function getNext()
    {
        $orderIds = $this->getOrderIds();
        $currentId = Mage::registry('current_order')->getId();
        $currentKey = array_search($currentId, $orderIds);
        $nextKey = $currentKey + 1;
        if(isset($orderIds[$nextKey])) {
            $nextId = $orderIds[$nextKey];
            $next = Mage::getModel('sales/order')->load($nextId);
            $next->setUrl(Mage::helper('adminhtml')->getUrl('adminhtml/sales_order/view', array('order_id' => $nextId)));
            $next->setLabel(Mage::helper('adminpreviousnext')->__('Next'));

            return $next;
        }
    }

    /**
     * @return array
     */
    public function getOrderIds()
    {
        $collection = Mage::getModel('sales/order')->getCollection();
        $orderIds = $collection->getAllIds();
        return $orderIds;
    }
}
