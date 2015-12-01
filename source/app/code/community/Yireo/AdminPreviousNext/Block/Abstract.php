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
abstract class Yireo_AdminPreviousNext_Block_Abstract extends Mage_Core_Block_Template
{
    abstract public function getPrevious();

    abstract public function getNext();
}
