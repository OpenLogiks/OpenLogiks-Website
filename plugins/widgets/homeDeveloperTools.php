<section class="section b-b bg-light">
                <div class="container">
                    <div class="section-heading text-center">
                        <i data-feather="box" width="36" height="36" class="stroke-primary"></i>
                        <h2 class="bold">Developer tools</h2>
                        <p class="lead text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, assumenda autem consequatur cum dignissimos dolores doloribus eius eum iusto laborum quasi quidem sapiente sit.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-3 ms-lg-auto order-md-2">
                            <nav id="sw-nav-developers" class="nav flex-md-column justify-content-between justify-content-md-start nav-pills nav-pills-light nav-fill"><a class="nav-item nav-link bold text-md-start active" href="#" data-step="1"><i class="icon fas fa-code"></i> HTML Structure </a><a class="nav-item nav-link bold text-md-start" href="#" data-step="2"><i class="icon fab fa-sass"></i> SASS compiler </a><a class="nav-item nav-link bold text-md-start" href="#" data-step="3"><i class="icon fas fa-retweet fa-rotate-90"></i> Ajax enabled </a><a class="nav-item nav-link bold text-md-start" href="#" data-step="4"><i class="icon fas fa-exclamation-triangle"></i> Form validation</a></nav>
                            <hr class="mt-5">
                            <a href="javascript:;" class="nav-link text-primary">All Resources <i class="icon fas fa-long-arrow-alt-right"></i></a>
                        </div>
                        <div class="col-md-8">
                            <div class="swiper-container mt-4 mt-md-0" data-sw-navigation="#sw-nav-developers">
                                <div class="swiper-wrapper line-numbers">
                                    <div class="swiper-slide">
                                        <pre class="language-html">
                            <code>
&lt;header class="main-header"&gt;
    ...
&lt;/header&gt;

&lt;div class="main-body"&gt;
    &lt;nav class="side-nav"&gt;
        ...
    &lt;/div&gt;

    &lt;main&gt;
        ...
    &lt;/main&gt;

    &lt;aside class="quick-view"&gt;
        ...
    &lt;/div&gt;
&lt;/div&gt;

&lt;footer class="main-footer"&gt;
    ...
&lt;/footer&gt;
                                </code>
                                            </pre>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <pre class="language-javascript">
                                                            <code>
                                var gulp = require('gulp');
                                var sass = require('gulp-sass');
                                var autoprefixer = require('gulp-autoprefixer');
                                
                                gulp.task('sass', function () {
                                    return gulp
                                        .src('../sass/*.scss')
                                        .pipe(sass({
                                            includePaths: ['./bower_components']
                                        }))
                                        .pipe(autoprefixer({
                                            browsers: ['last 2 version', '> 5%']
                                        }))
                                        .pipe(gulp.dest('./css'));
                                });
                                
                                gulp.task('default', ['scss']);</code></pre>
                                                                    </div>
                                                                    <div class="swiper-slide">
                                                                        <pre class="language-javascript">
                                                            <code>
                                var apiUrl = 'https://api.5studios.net/';
                                
                                this.getLoggedUser = function() {
                                    return $.ajax({
                                        url: apiUrl + 'user/login?inc=name,location,email,picture',
                                        dataType: 'json'
                                    });
                                };
                                
                                this.getPendingTasks = function () {
                                    return $.getJSON(apiUrl + 'data/tasks/pending', function() {
                                        console.log("Tasks loaded");
                                    });
                                };
                            </code>
                                </pre>
                        </div>
                        <div class="swiper-slide">
                            <pre class="language-javascript">
                <code>
                                $("#register-form").validate({
                                  rules: {
                                    username: {
                                      required: true,
                                      minLength: 2,
                                      remote: "register.php"
                                    }
                                  },
                                  messages: {
                                    username: {
                                      required: "Enter your username",
                                      minLength: "At least 2 characters are necessary",
                                      remote: String.format("The name {0} is already in use")
                                    }
                                  }
                                });</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>