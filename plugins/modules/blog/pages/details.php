<main class="overflow-hidden">
            <!-- Integration Heading -->
   <header class="header section social-media-heading">
        <img src="img/bg/social/bg-shape.svg" class="social-bg-shape absolute" alt="..." data-aos="fade-left">
        <div class="container">
            <div class="row gap-y align-items-center">
                <div class="col-lg-6 col-xl-5 text-center text-lg-start">
                    <p class="badge bg-contrast text-dark rounded-pill shadow bold px-4 py-2"><span class="text-primary">80% Off</span> when registering</p>
                    <h1 class="font-md extra-bold display-md-4">Blog Details</h1>
                    <p class="lead my-5">It all begins by choosing the right tools, start with a complete set of design blocks to achieve your next success.</p>
                    <nav class="nav mt-5">
                        <!--<a href="#" class="me-3 btn btn btn-rounded btn-outline-info bw-2"><i class="fas fa-tag me-3"></i> Plans &amp; pricing </a>-->
                        <a href="#" class="btn btn-rounded btn-primary bw-2">Start now</a>
                    </nav>
                </div>
                <div class="col-lg-6 ms-lg-auto text-center text-lg-end"><img src="img/bg/inner-img.png" class="social-image" alt="" data-aos-delay="800" data-aos="zoom-in"></div>
            </div>
        </div>
    </header>
 <?php
    if(!defined('ROOT')) exit('No direct script access allowed');
    
    // $cat=$slug['category'];
    $blogData1=getBlogDetails($slug['service_slug']);
    
    if(!$blogData1) {
        echo "Blog Not Found";
        return;
    }
    ?>  
      <section class="section blog single">
        <div class="container">
            <div class="row gap-y">
                <div class="col-lg-8 b-r">
                    <div class="blog-post post-content pb-5">
                        <div class="blog-post-nav mb-3"><a href="blog.html"><i class="fas fa-long-arrow-alt-left"></i></a> <a href="blog.html"><span class="badge badge-pill badge-light">Category</span></a></div>
                       <!--  <div class="media">
                            <img class="me-3 rounded-circle icon-lg" src="../img/avatar/author.jpg" alt="">
                            <div class="media-body small"><span class="author">by <a href="#">Jane Doe</a></span> <span class="d-block text-secondary">May 5th, 2021</span></div>
                        </div> -->
                        <hr class="mb-5">
                        <p class="lead text-secondary italic mb-5"> <?= $blogData1['title'];
                                ?></p>
                        <figure class="shadow rounded mb-5">
                            <?php 
                                        if ($blogData1['photos_featured'] != '') {
                                            $image_array=explode(',',$blogData1['photos_featured']);
                                            $image_array=WEBAPPROOT.'usermedia/'.$image_array[0];  
                                        } else{
                                            
                                            $image_array=loadmedia('images/blog-banner.jpg');
                                        }
                                   ?>
                            <img class="img-responsive rounded" src="<?= $image_array?>" alt=""></figure>
                        <p> <?php
                                    $str=str_replace("%3B"," ",$blogData1['text_draft']);
                                  echo  $str1=str_replace("\'","",$str);
                                ?></p>
                        <!--<blockquote class="blog-quote text-secondary d-flex mx-auto">-->
                        <!--    <i class="quote fas fa-quote-left"></i>-->
                        <!--    <p>Dashcore is great for anyone who is looking for a great startup template.</p>-->
                        <!--</blockquote>-->
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, perspiciatis, ullam! Alias aperiam aut consequuntur corporis debitis distinctio harum in ipsum labore nesciunt odit, optio porro provident, qui rem sint.</p>-->
                        <!--<h4 class="bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h4>-->
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi deleniti dignissimos eaque id itaque minus modi molestias, odit similique tempora. Architecto aut consequuntur ex fugiat quidem quos totam ullam veniam?</p>-->
                        <!--<p>Lorem ipsum dolor sit amet, <a href="">consectetur adipisicing elit</a>. Asperiores beatae corporis deserunt eaque fugiat iure labore libero magni mollitia, quaerat rem rerum voluptate. Asperiores expedita modi nam sunt tempora veniam.</p>-->
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aspernatur atque cum ducimus eligendi ipsam iste, perspiciatis, quas rem repudiandae, <a href="">rerum suscipit tenetur!</a> Cum doloremque impedit, iusto nihil ratione repellat!</p>-->
                    </div>
                    <div class="post-author py-5 b-t b-2x">
                        <div class="d-flex align-items-center">
                            <img class="d-flex me-3 rounded-circle shadow" src="../img/avatar/author.jpg" alt="...">
                            <div class="flex-fill">
                                <h5 class="my-0 bold">Jane Doe</h5>
                                <span class="text-secondary">VP Sales, Dashcore Inc.</span>
                                <hr>
                                <p class="small text-secondary mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="post-details py-5 b-t">
                        <ul class="list-unstyled d-flex flex-wrap flex-row align-items-center">
                            <li class="me-4"><i class="fas fa-tag text-secondary"></i></li>
                            <li><a href="#" class="badge rounded-pill badge-outline-secondary me-2">app</a></li>
                            <li><a href="#" class="badge rounded-pill badge-outline-secondary me-2">development</a></li>
                            <li><a href="#" class="badge rounded-pill badge-outline-secondary me-2">software</a></li>
                            <li><a href="#" class="badge rounded-pill badge-outline-secondary">startup</a></li>
                        </ul>
                        <ul class="list-unstyled d-flex flex-wrap flex-row align-items-center">
                            <li class="me-4"><i class="fas fa-bookmark text-secondary"></i></li>
                            <li><a href="#" class="btn btn-circle btn-sm btn-secondary me-2"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" class="btn btn-circle btn-sm btn-secondary me-2"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#" class="btn btn-circle btn-sm btn-secondary"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    
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
           
   