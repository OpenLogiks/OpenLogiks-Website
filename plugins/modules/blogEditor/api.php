<?php
if(!defined('ROOT')) exit('No direct script access allowed');

if(!function_exists("getCategory")) {

    function getCategory(){
          $data =array();
            $sql = _db()->_selectQ("blog_category","*",['blocked'=>'false'])->_get();
            
            if(isset($sql[0])){
                
                $data = $sql[0];
            }
            return $data;
        
    }
}
?>