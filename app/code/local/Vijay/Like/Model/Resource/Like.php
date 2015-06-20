<?php
class Vijay_Like_Model_Resource_Like extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('like/like', 'like_id');
    }
}