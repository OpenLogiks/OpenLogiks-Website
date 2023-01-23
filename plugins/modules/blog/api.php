<?php
if(!defined('ROOT')) exit('No direct script access allowed');

/**
 * @use: use to get all news from database
 * @author : sarika@smartinfologics.com
 * @params : start position,end position for pagination
 * @return : data array
 * 
 * */

if(!function_exists("getBlog")) {
    
    function getBlog($start_from='', $num_rec_per_page=''){
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 1,3";
        }
        
        $data = [];
        $sql = _db()->_selectQ("blog_tbl left join blog_contents on blog_tbl.id=blog_contents.blog_id","blog_tbl.*,blog_contents.text_draft",['blog_tbl.blocked'=>'false'])->_orderBy("blog_tbl.published_on desc")->_get();
        
        if($sql && count($sql)>0){
            $data = $sql;
        }
        
        return $data;
    }
    
}   

if(!function_exists("getBlogTitle")) {
    
    function getBlogTitle($lang = "mh"){
        
        $data = [];
        $sql = _db()->_selectQ("blog_tbl","id,title,type,category,slug",['blog_tbl.blocked'=>'false','type'=>'featured','langs'=>$lang])->_orderBy("blog_tbl.published_on desc")->_get();
        if($sql && count($sql)>0){
            $data = $sql;
        }
        
        return $data;
    }
    
}   

if(!function_exists("getBlogCat")) {
    
    function getBlogCat($start_from,$num_rec_per_page,$cat,$lang){
       
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 0,3";
        }
        
        $data =array();
         $sql = _db()->_selectQ("blog_tbl left join blog_contents on blog_tbl.id=blog_contents.blog_id","blog_tbl.*,blog_contents.text_draft",['blog_tbl.blocked'=>'false','blog_tbl.category'=>$cat,'langs'=>$lang])->_orderBy("blog_tbl.published_on desc")->_get(); 
        
        if(count($sql)>0){
            
            $data = $sql;
        }
        
        return $data;
    }
    
}
if(!function_exists("getBlogAllCat")) {
    
    function getBlogAllCat($start_from,$num_rec_per_page,$lang){
       
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 0,3";
        }
        
        $data =array();
         $sql = _db()->_selectQ("blog_tbl left join blog_contents on blog_tbl.id=blog_contents.blog_id","blog_tbl.*,blog_contents.text_draft",['blog_tbl.blocked'=>'false','langs'=>$lang])->_orderBy("blog_tbl.published_on desc")->_get(); 
        
        if(count($sql)>0){
            
            $data = $sql;
        }
        
        return $data;
    }
    
}
if(!function_exists("getFeaturedBlog")) {
    function getFeaturedBlog($start_from, $num_rec_per_page, $cat,$lang,$cat1){
        
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 0,3";
        }
        
        $data =array();
        $sql = _db()->_selectQ("blog_tbl","id,slug,category,photos_featured,title,blocked,type,langs",['blocked'=>'false','type'=>$cat,'langs'=>$lang,'category'=>$cat1])->_orderBy("blog_tbl.published_on desc $limit")->_get();
        
        if(count($sql)>0){
            
            $data = $sql;
        }
        return $data;
       // printArray($data);exit;
    }
}   

if(!function_exists("getBlogCategryWise")) {
    function getBlogCategryWise($start_from, $num_rec_per_page, $cat,$lang){
        $limit='';
        if($start_from!=='' && $num_rec_per_page!==''){
            $limit = "LIMIT $start_from,$num_rec_per_page";
        }else{
            $limit = "LIMIT 1,3";
        }
        
        $data =array();
        $sql = _db()->_selectQ("blog_tbl","blog_tbl.*",['blocked'=>'false','category'=>$cat,'langs'=>$lang])->_get();
       // $sql = _db()->_selectQ("blog_tbl,blog_contents","blog_tbl.*,blog_contents.text_draft",['blog_tbl.blocked'=>'false','blog_tbl.category'=>$cat])->_orderBy("blog_tbl.published_on desc $limit")->_get();
        
        if(count($sql)>0){
            
            $data = $sql;
        }
        
        return $data;
    }
} 

/**
 * @use: use to get details of paricular news
 * @author : sarika@smartinfologics.com
 * @params : blog slug
 * @return : data array
 * 
 * */
if(!function_exists("getBlogDetails")) {
    
    function getBlogDetails($slug){
        $data = [];
        
        $sql = _db()->_selectQ("blog_tbl,blog_contents","blog_tbl.*,blog_contents.*",[
                "blog_tbl.id=blog_contents.blog_id"=> "RAW",
                'blog_tbl.blocked'=>'false',
                'blog_tbl.slug'=>$slug,
                //"category"=>$cat
            ])->_get();
        
        if(isset($sql[0])){
            
            $data = $sql[0];
        }
        
        return $data;
    }
}


/**
 * @use: use to get details of paricular news
 * @author : mita@smartinfologics.com
 * @params : blog slug
 * @return : data array
 * 
 * */
if(!function_exists("getBlogCnt")) {
    
    function getBlogCnt(){
        $data =array();
        
        $sql = _db()->_selectQ("blog_tbl","count(id) as cnt,service_category",['blocked'=>'false','status'=>'published'])->_groupBy("service_category")->_get();
        if(count($sql)>0){
            $data = $sql;
        }
        return $data;
    }
}
if(!function_exists("getCategoryCnt")) {
    function getCategoryCnt(){
        
        $data =array();
        
       //echo $cnt = _db()->_selectQ("blog_tbl,blog_category","blog_tbl.category,blog_category.slug,count(blog_tbl.id) as cnt",[])->_groupBy('blog_tbl.category')->_sql(); exit;
       $sql1 = _db()->_selectQ("blog_tbl as bt join blog_category as bc on bt.category=bc.title","bt.category,bc.slug,count(bc.id) as cnt")->_groupBy('bt.category')->_get();
       
       //$sql1 = _db()->_selectQ("blog_category","title,slug,count(*) as cnt")->_groupBy('title')->_get(); 
        //echo $sql = _db()->_selectQ("blog_category","*",['blocked'=>'false','title'=>$sql1[0]['category']])->_sql();exit;
        if(isset($sql1)){
            
            $data = $sql1;
        }
        
       
        return $data;
    }
}


?>