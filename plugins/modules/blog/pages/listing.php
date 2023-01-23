<main class="overflow-hidden">
<!-- Integration Heading -->
<header class="header section social-media-heading">
    <img src="img/bg/social/bg-shape.svg" class="social-bg-shape absolute" alt="..." data-aos="fade-left">
    <div class="container">
        <div class="row gap-y align-items-center">
            <div class="col-lg-6 col-xl-5 text-center text-lg-start">
                <p class="badge bg-contrast text-dark rounded-pill shadow bold px-4 py-2"><span class="text-primary">80% Off</span> when registering</p>
                <h1 class="font-md extra-bold display-md-4">Blogs</h1>
                <p class="lead my-5">It all begins by choosing the right tools, start with a complete set of design blocks to achieve your next success.</p>
                <nav class="nav mt-5">
                    <!--<a href="#" class="me-3 btn btn btn-rounded btn-outline-info bw-2"><i class="fas fa-tag me-3"></i> Plans &amp; pricing </a>-->
                    <a href="#" class="btn btn-rounded btn-primary bw-2">Start now</a>
                </nav>
            </div>
            <div class="col-lg-6 ms-lg-auto text-center text-lg-end"><img src="<?= loadMEdia('images/inner-img.png')?>" class="social-image" alt="" data-aos-delay="800" data-aos="zoom-in"></div>
        </div>
    </div>
</header>
<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$slug=_slug("a/b");

loadModuleLib("blog","api");

//$num_rec_per_page=10;

if (isset($_GET["page"])) {
    $page  = $_GET["page"]; 
} else { 
    $page = 1; 
}; 


$num_rec_per_page=getConfig('RECORDS_PER_PAGE');

$start_from = ($page-1) * $num_rec_per_page; 


$blog = getBlog($start_from,$num_rec_per_page);
// printArray($blog);exit;
$table_name='blog_tbl';
// getTotalRecordCount($table_name,['blocked'=>'false', 'langs'=> $lang]);

?>

<section class="section">
    <div class="container">
        <div class="row gap-y">
            <div class="col-lg-8 b-r">
                <div class="row gap-y">
                    
                    
                    <?php  
                                        
                        if(isset($blog) && count($blog)>0){
                            //printArray($blog);exit;
                            foreach($blog as $k=>$v) {
                                if(!isset($v['slug'])) $v['slug'] = $v['id'];
                                // $link1=get_lang().'/'.$v['category']."/".$v['slug'];
                                // $link=_link($link1);
                                $link = "blog/".$v['slug'];
                    ?>
                    <div class="col-md-6">
                        <div class="card card-blog shadow-box shadow-hover border-0">
                            <a href="blog-details.html"><img class="card-img-top img-responsive" src="https://picsum.photos/350/200/?random&gravity=north" alt=""></a>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="author d-flex align-items-center">
                                        <img class="author-picture rounded-circle icon-md shadow-box" src="../img/avatar/user.png" alt="...">
                                        <p class="small bold my-0">Jenny Oliver</p>
                                    </div>
                                    <nav class="nav"><a href="javascript:;" class="d-flex align-items-center text-secondary me-3 blog-action blog-favorite"><i class="fas fa-heart text-danger me-2"></i> <span class="small">347</span> </a><a href="javascript:;" class="d-flex align-items-center text-secondary blog-action blog-bookmark"><i class="far fa-bookmark me-2"></i> <span class="small">73</span></a></nav>
                                </div>
                                <hr>
                                <p class="card-title regular"><a href="<?=_link($link)?>"><?=$v['title']?></a></p>
                                <p class="card-text text-secondary"><?=urldecode($v['text_excerpt'])?></p>
                                <p class="bold small text-secondary my-0"><small><?php
                                                                        $date=date_create($v['published_on']);
                                                                        echo date_format($date,"F d , Y");
                                                                        ?></small></p>
                            </div>
                        </div>
                    </div>
                    
                    <?php } }else{
                        
                        
                        echo "No Data Found";
                    }
                          ?>
                    
                    
                </div>
                <nav class="nav justify-content-center mt-5"><a class="btn btn-contrast btn-rounded me-5" href="#"><i class="fas fa-angle-left"></i> Previous</a> <a class="btn btn-contrast btn-rounded" href="#">Next <i class="fas fa-angle-right"></i></a></nav>
            </div>
            <div class="col-lg-4">
                <h4 class="mb-3 bold">Search</h4>
                <form class="form search-box">
                    <div class="input-group"><input type="email" name="Search[q]" class="form-control rounded-circle-left shadow-none" placeholder="Search form..." required> <button class="btn rounded-circle-right btn-contrast border-input" type="submit" data-loading-text="Searching ..."><i class="fas fa-search"></i></button></div>
                </form>
                <?= loadWidget('latestBlog')?>
                
                <h4 class="mt-4 mb-3 bold">Tags</h4>
                <div class="tags">
                    <ul class="list-unstyled d-flex flex-wrap flex-row">
                        <li><a href="#" class="badge rounded-pill badge-outline-dark me-2">app</a></li>
                        <li><a href="#" class="badge rounded-pill badge-outline-dark me-2">development</a></li>
                        <li><a href="#" class="badge rounded-pill badge-outline-dark me-2">software</a></li>
                        <li><a href="#" class="badge rounded-pill badge-outline-dark me-2">awesome</a></li>
                        <li><a href="#" class="badge rounded-pill badge-outline-dark me-2">startup</a></li>
                        <li><a href="#" class="badge rounded-pill badge-outline-dark">business</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>