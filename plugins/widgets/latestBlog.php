<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$page=PAGE;
loadModuleLib("blog","api");
$slug=_slug("a/b/c");

$cat1=$slug['b'];
$start_from=1;
$num_rec_per_page=5;
$cat='';
$thumb='';

$featured=[];
// $lang=get_lang();

$featured=getBlog($start_from,$num_rec_per_page);
//var_dump($featured);exit;
if(isset($featured) && count($featured) > 0){

?>
<h4 class="mt-5 mb-3 bold">Latest Posts</h4>
    <ul class="list-unstyled">
        <?php foreach($featured as $k=>$v) { 
                    $link1=$v['slug'];
                    if($v['photos_featured'] && strlen($v['photos_featured'])>0)  $thumb=WEBAPPROOT."/usermedia/".$v['photos_featured'];
                    else $thumb=loadmedia('images/blog-banner.jpg');
                  
                ?>
        <li class="d-flex align-items-center">
            <a href="<?= _link($link1)?>" class="d-flex me-3 py-2"><img class="rounded-circle icon-xl shadow" src="<?= $thumb?>" alt="..."></a>
            <div class="flex-fill">
                <h6 class="semi-bold mt-0 mb-1"><a href="<?= _link($link1)?>" class="text-dark">
                <?php 
                    $str=str_replace('%3B','',$v['title']);
                    echo $str;?>
                </a></h6>
                <span class="small text-muted"><i class="fas fa-calendar"></i>
                <?php
                    $date=date_create($v['published_on']);
                    echo date_format($date,"F d , Y");
                ?>
                </span>
            </div>
        </li>
         <?php } ?>
        
       
    </ul>
<?php
}
?>