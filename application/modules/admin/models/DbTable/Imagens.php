<?php

class Admin_Model_DbTable_Imagens extends Zend_Db_Table_Abstract
{

    protected $_name = 'imagens';
    protected $_primary = 'idImagens';
    
    public function pesquisarImagens($id = null, $where = null, $order = null, $limit = null){
        if( !is_null($id) ){
            $arr = $this->find($id)->toArray();
            return $arr[0];
        }else{
            $select = $this->select()->from($this)->order($order)->limit($limit);
            if(!is_null($where)){
                $select->where($where);
            }
            return $this->fetchAll($select)->toArray();
        }
    }


}

