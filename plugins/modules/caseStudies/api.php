<?php
if(!defined('ROOT')) exit('No direct script access allowed');

/**
 * @use: use to get all case Studies from database
 * @author : vivek
 * @params : start position,end position for pagination
 * @return : data array
 * 
 * */

if(!function_exists("getCasestudies")) {
    
    function getCasestudies($start_from,$num_rec_per_page){
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 0,3";
        }
       $data =array();
      $sql=_db()->_selectQ("casestudies_tbl","slug,title,thumbnail,category,link,industry,technology", ['blocked'=>'false'])->_orderBy("id asc")->_get();
        
        if(count($sql)>0){
            $data = $sql;
        }
        return $data;
        
    }
}

 if(!function_exists("getRelatedCasestudies")) {
     
 function getRelatedCasestudies($start_from, $num_rec_per_page,$service_cat){
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 0,3";
        }
        $data =array();
        $sql=_db()->_selectQ("casestudies_tbl","slug,title,thumbnail,desc_short,created_on",['blocked'=>'false','service_subcategory'=>$service_cat])->_orderBy("created_on desc $limit")->_get();
        if(count($sql)>0){
            $data = $sql;
        }
        return $data;
    }
 }
 
 

if(!function_exists("getCaseStudiesHome")) {
    function getCaseStudiesHome(){
        $limit = "LIMIT 0,4";
       $data =array();
       $whr= ['blocked'=>'false'];
     $sql=_db()->_selectQ("casestudies_tbl","slug,title,thumbnail,desc_short,created_on",$whr)->_orderBy("created_on desc $limit")->_get(); 
        if(count($sql)>0){
            $data = $sql;
        }
        return $data;
    }
}


if(!function_exists("getCasestudiDetails")) {
    function getCasestudiDetails($slug){
        $data =array();
       $sql = _db()->_selectQ("casestudies_tbl","id,slug,title,photos,title,desc_short,descs",['blocked'=>'false','slug'=>$slug])->_get();
        if(isset($sql[0])){
            $data = $sql[0];
        }
        return $data;
    }
}

if(!function_exists('getCaseStudiesSlug')){
    function getCaseStudiesSlug($slug){
        $sql = _db()->_selectQ('casestudies_tbl',"id,slug, created_on",['slug'=>$slug])->_orderBy("id")->_get();
        if(isset($sql)){ 
           $data = $sql;
        }
        return $data;
    }
}
