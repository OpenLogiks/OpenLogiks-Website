<main class="overflow-hidden">
            <!-- Integration Heading -->
    <header class="header section social-media-heading">
        <img src="img/bg/social/bg-shape.svg" class="social-bg-shape absolute" alt="..." data-aos="fade-left">
        <div class="container">
            <div class="row gap-y align-items-center">
                <div class="col-lg-6 col-xl-5 text-center text-lg-start">
                    <p class="badge bg-contrast text-dark rounded-pill shadow bold px-4 py-2"><span class="text-primary">80% Off</span> when registering</p>
                    <h1 class="extra-bold display-md-4">Casestudies</h1>
                    <p class="lead my-5">It all begins by choosing the right tools, start with a complete set of design blocks to achieve your next success.</p>
                    <nav class="nav mt-5">
                        <!--<a href="#" class="me-3 btn btn btn-rounded btn-outline-info bw-2"><i class="fas fa-tag me-3"></i> Plans &amp; pricing </a>-->
                        <a href="#demos" class="btn btn-rounded btn-primary bw-2">Explore now</a>
                    </nav>
                </div>
                <div class="col-lg-6 ms-lg-auto text-center text-lg-end"><img src="<?= loadMedia('images/inner-img.png')?>" class="social-image" alt="" data-aos-delay="800" data-aos="zoom-in"></div>
            </div>
        </div>
    </header>
    <?php
    if(!defined('ROOT')) exit('No direct script access allowed');
    
    loadModuleLib("caseStudies","api");
    
    $num_rec_per_page=getConfig('RECORDS_PER_PAGE');
    $table_name='casestudies_tbl';
    // getTotalRecordCount($table_name,['blocked'=>'false']);
    
    if (isset($_GET["page"])){
        $page  = $_GET["page"]; 
        
    } else { 
        $page=1; 
        
    };
    $_ENV['REC_PER_PAGE']=$num_rec_per_page;
    $_ENV['PAGELINK']=PAGE;
    $_ENV['PAGE_NO']=$page;
    $start_from = ($page-1) * $num_rec_per_page;
    $caseStudi = getCasestudies($start_from,$num_rec_per_page);

    ?>    
    <style>
    .preview-pane .preview-page img{
            height: 100%;
    object-fit: cover;
    }
        .contentBox{
                padding: 35px;
                    min-height: 223px;
        }
        .contentBox h3{
                font-size: 18px;
    font-weight: 600;
    margin-bottom: 19px;
    border-left: 3px solid #3ccad8;
    padding-left: 10px;
        }
         .contentBox .techBlock{
            
        }
         .contentBox .techBlock span{
                    font-size: 15px;
    display: block;
    margin-top: 4px;
        }
         .contentBox .techBlock i{
            width: 34%;
    /*float: left;*/
    font-style: normal;
    font-weight: 400;
         }
          .contentBox .techBlock label{
                font-weight: 500;
        }
        .casestudySection .col-md-4{
                padding: 15px !important;
        }
        .casestudySection  h4{
                font-size: 20px;
        }
    </style>
    
    <section class="section casestudySection" id="demos">
        <div class="container">
            <div class="section-heading text-center">
                <h2 class="bold">Demo Selection</h2>
                <p class="lead text-secondary">We have created multiple pre-made demos for you, please select the one you like the most to give it a try</p>
                <p class="handwritten highlight font-md">Or you can check</p>
               <!--  <a href="angular" class="btn btn-danger btn-rounded btn-lg me-3"><i class="fab fa-angular me-2"></i> Angular version </a><a href="rtl" class="btn btn-primary btn-rounded btn-lg">RTL version</a> -->
            </div>
            <div class="row gap-y">
                
                <?php 
                        if(isset($caseStudi) && count($caseStudi)>0){
                           
                            foreach($caseStudi as $k=>$v) {
                                if(isset($v['slug'])) $link='casestudies/'.$v['slug'];
                                ?>
                
                <div class="col-sm-6 col-md-4">
                    <div class="card card-demo card--blog shadow-box border-0">
                        <div class="card-body d-flex align-items-center">
                            <!--<span class="is-new badge badge-danger badge-pill">New</span>-->
                            <h4 class="card-title mb-0 text-capitalize"><?= toTitle($v['category'])?></h4>
                            <nav class="btn-group ms-auto"><a href="#" target="_blank" class="btn btn-warning rounded-pill" ><i class="icon fas fa-desktop"></i> <span class="demo-link-text">Read More</span></a></nav>
                        </div>
                        <figure class="preview-overlay m-0">
                            <?php 
                               if ($v['thumbnail'] != '') {
                                   $image_array=explode(',',$v['thumbnail']);
                                   $image_array=WEBAPPROOT.'usermedia/'.$image_array[0];  
                               ?>
                            <div class="preview-pane">
                                <div class="preview-page" data-simplebar><img class="card-img-bottom img-responsive" src="<?=$image_array?>" alt=""></div>
                            </div>
                            <?php } ?>
                        </figure>
                        <div class="contentBox">
                            <h3><?= $v['title']?></h3>
                            <div class="techBlock">
                                <span><i>Industry:</i>   <label><?=toTitle($v['industry'])?></label></span>
                                <span><i>Technology:</i>  <label><?=toTitle($v['technology'])?></label></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } }else{?>
                            <div class="col-md-8">
                               <div class="sidebar-widget-area mb-40">
                                <div class="widget search-widget mb-40 wow fadeInUp" style="width:100%">
                                    <b style="color:#000000"> Sorry No Data Found.</b>
                    
                                </div>
                            </div>
                        </div>
                  <?php      }
                        ?>
               
               
            </div>
        </div>
    </section>
  <style>

</style>          
 <style>
     .section-heading h2 {
    margin-top: 0;
    margin-bottom: 0;
    font-weight: 400;
    font-size: 48px !important;
}
.font-md {
    font-size: 52px;
}
.handwritten.highlight {
    line-height: 1.25em !important;
    -webkit-transform: rotate(-5deg);
    transform: rotate(-5deg);
}
.handwritten {
    font-family: Caveat,cursive,Poppins,sans-serif !important;
}
.extra-bold {
    font-weight: 800!important;
}
.display-md-4 {
    font-size: 56px!important;
}
 </style>    