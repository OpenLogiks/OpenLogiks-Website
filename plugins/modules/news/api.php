<?php
if(!defined('ROOT')) exit('No direct script access allowed');

if(!function_exists("getNewsDetails")) {
    
    function getNewsDetails(){
        
        $data =array();
        $sql = _db()->_selectQ("news","*",['blocked'=>'false'])->_orderBy("news_date desc")->_get();
        
        if(count($sql)>0){
            
            $data = $sql;
        }
        
        return $data;
    }
}
?>