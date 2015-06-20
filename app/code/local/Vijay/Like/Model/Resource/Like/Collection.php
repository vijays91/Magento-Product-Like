<?php
class Vijay_Like_Model_Resource_Like_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init('like/like');
    }
}

