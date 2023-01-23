<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$blogDetails = _db()->_selectQ("blog_tbl", "*", ["id"=>$slug['c']])->_GET();

if(!$blogDetails) {
    echo "<h3 align=center><br>Blog Not Found<h3>";
    return;
}
loadModuleLib("blog", "api");

$mediaBanner = loadMedia($blogDetails[0]['photos_featured']);
if(strlen($mediaBanner)<=0) {
    $mediaBanner= loadMedia("images/nopic.jpg");
}
// echo $mediaBanner;
// printArray($blogDetails[0]);

$toolBar = [
        "gotoReport"=>["icon"=>"<i class='fa fa-chevron-left'></i>","tips"=>"Back to listing"],
        "reloadPage"=>["icon"=>"<i class='fa fa-refresh'></i>","tips"=>"Refresh"],
        
        "editPost"=>["icon"=>"<i class='fa fa-pencil'></i>", "tips"=>"Edit Blog", "title"=>"Edit"],
        "viewPost"=>["icon"=>"<i class='fa fa-link'></i>", "tips"=>"View Blog", "title"=>"View"],
        
        
        "publishArticle"=>["title"=>"Publish","align"=>"right","class"=>"active"],//"class"=>($reportType=="new")?"active":"","policy"=>"blog.editor.publish",
        "deleteArticle"=>["title"=>"","align"=>"right","class"=>"","icon"=>"<i class='fa fa-trash'></i>"],
	];
	
$blogCategories = _db()->_selectQ("blog_category", "*", ["blocked"=>"false"])->_GET();
if(!$blogCategories) $blogCategories = [];

$blogLink = current(explode("?",_link($blogDetails[0]['langs']."/{$blogDetails[0]['category']}/".$blogDetails[0]['slug'])))."?site=".CMS_SITENAME;
?>
<style>
h2 {
    font-size: 36px;
}
.ck {
    height: 300px;
}
a:hover {
    text-decoration: none
}
.image_box {
    width: 100%;
    height:200px;
    text-align: center;
    overflow: hidden;
    border: 1px dotted #CCC;
}
.image_box img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    margin:auto;
}
</style>
<div class="col-xs-9 col-lg-9 col-md-9">
    <div class='row'>
        <div class="col-xs-12 col-lg-12 col-md-12">
            <h2><?=urldecode($blogDetails[0]['title'])?></h2>
        </div>
    </div>
    <div class="row">
		<?php
		    $blogContent = _db()->_selectQ("blog_contents", "*", ["blog_id"=>$slug['c']])->_GET();
		    if(!$blogContent) {
		        _db()->_insertQ1("blog_contents", [
		                "guid"=>$_SESSION['SESS_GUID'],
		                "blog_id"=>$slug['c'],
		                "created_by"=>$_SESSION['SESS_USER_ID'],
		                "created_on"=>date("Y-m-d H:i:s"),
		                "edited_by"=>$_SESSION['SESS_USER_ID'],
		                "edited_on"=>date("Y-m-d H:i:s"),
		            ])->_RUN();
		            
		        $blogContentID = _db()->get_insertID();
		    } else {
		        $blogContentID = $blogContent[0]['id'];
		    }
			loadModuleLib("forms","api");
		    $formConfig=findForm(dirname(__DIR__)."/forms/addBlogDetails.json");
		    $formConfig['gotolink'] = _link("modules/blogEditor/edit/{$slug['c']}");
		    $formConfig['reportlink'] = _link("modules/blogEditor");///edit/{$slug['c']}
		    
        	printForm('update',$formConfig,'app',["id"=>$blogContentID]);
    	?>
    </div>
</div>
<div class="col-xs-3 col-lg-3 col-md-3">
    <div class='row'>
        <div class="col-xs-12 col-lg-12 col-md-12">
            <strong style='line-height:30px;'>Featured Image</strong>
            <form target=uploadTarget action="<?=_service("blogEditor", "uploadFeaturedImage")?>" method="post" enctype="multipart/form-data">
                <input type='hidden' name='blogid' value='<?=$blogDetails[0]['id']?>' />
                <input type='hidden' name='old_path' value='<?=$blogDetails[0]['photos_featured']?>' />
                <input name='attachment' type="file" class='btn btn-sm pull-right' onchange="uploadStarted(this)">
                <input type='hidden' name='forsite' value='<?=$_GET['forsite']?>' />
                <button type="submit" style='display: none;'>Upload</button>
            </form>
            <div class='image_box' title='Featured Images'>
                <img src='<?=SiteLocation."apps/".CMS_SITENAME."/usermedia/{$mediaBanner}"?>' alt='Featured media' />
            </div>
        </div>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        
        
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Permalink
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
            <h5>URL</h5>
            <?=$blogDetails[0]['slug']?>
            <h5>Preview</h5>
            <a href='<?=$blogLink?>'><?=$blogLink?></a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
          Article status
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
            <table class='table'>
                <tr>
                    <th>Published</th>
                    <td><?=$blogDetails[0]['published']?"<span class='label label-success'>Yes</span>":"<span class='label label-info'>No</span>"?></td>
                </tr>
                <tr>
                    <th>Published On </th>
                    <td><?=_date($blogDetails[0]['published_on'])?></td>
                </tr>
                <tr>
                    <th>Published By</th>
                    <td><?=$blogDetails[0]['published_by']?></td>
                </tr>
            </table>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Categories
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <ul class='list-group list-categories'>
        <?php
            $blogCategoriesData = explode(",", strtolower($blogDetails[0]['category']));
            foreach($blogCategories as $row) {
                if(in_array(strtolower($row['slug']), $blogCategoriesData))
                    echo "<li class='list-group-item' data-value='{$row['id']}' data-slug='{$row['slug']}'><input name='blog_categories' value='{$row['slug']}' type='checkbox' checked /> {$row['title']}</li>";
                else
                    echo "<li class='list-group-item' data-value='{$row['id']}' data-slug='{$row['slug']}'><input name='blog_categories' value='{$row['slug']}' type='checkbox' /> {$row['title']}</li>";
            }
        ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Tags
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <?=$blogDetails[0]['tags']?>
      </div>
    </div>
  </div>
</div>
</div>
<iframe style='display: none !important;' name='uploadTarget' id='uploadTarget' ></iframe>
<script>
const LINK_PREVIEW = "<?=$blogLink?>";
const LINK_EDITOR = _link("modules/forms/blogEditor.main/edit/<?=md5($blogDetails[0]['id'])?>");
var editor1 = null;
$(function() {
    $(".list-categories input[name=blog_categories]").change(function() {
        var finalList = [];
        $(".list-categories input[name=blog_categories]:checked").each(function() {
            finalList.push(this.value);
        });
        
        processAJAXPostQuery(_service("blogEditor", "update_categories"), "article=<?=$blogDetails[0]['id']?>&catgories="+finalList.join(","), function(data) {
            lgksToast(data.Data);
        }, "json");
    });
    
    ClassicEditor
        .create( $("textarea[name=text_draft]")[0], {
            //plugins: [ SimpleUploadAdapter],
            //toolbar: [ ... ],
        })
        .then( editor => {
            editor1 = editor;
            
            editor1.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                    return new MyBlogUploadAdapter( loader );
                };
            
            //console.log( editor );
        } )
        .catch( error => {
            //console.error( error );
        } );
});
function gotoReport() {
    window.location = _link("modules/blogEditor");
}
function viewPost() {
    window.open(LINK_PREVIEW);
}
function editPost() {
    window.location = LINK_EDITOR;
}
function publishArticle() {
    lgksOverlayURL(_link("popup/forms/blogEditor.publish/edit/<?=md5($blogDetails[0]['id'])?>"), "Publish Article", a=> {});
    // processAJAXPostQuery(_service("blogEditor", "publishArticle"), "article=<?=$blogDetails[0]['id']?>", function(data) {
    //         lgksToast(data.Data);
    //     }, "json");
}
function deleteArticle() {
    lgksConfirm("Are you sure about deleting this article?", "Delete article", function(ans) {
        if(ans) {
            processAJAXPostQuery(_service("blogEditor", "deleteArticle"), "article=<?=$blogDetails[0]['id']?>", function(data) {
                lgksToast(data.Data);
            }, "json");
        }
    });
}

function uploadStarted(src) {
    $(".image_box>img").hide();
    $(".image_box").append("<div class='ajaxloading ajaxloading8'></div>");
    
    $(src).closest('form')[0].submit();
}
function uploadCompleted(error, objData) {
    if(error) {
        $(".image_box>.ajaxloading").detach();
        $(".image_box>img").show()
        lgksAlert(objData);
    } else {
        $(".image_box>img").attr("src", objData);
        $(".image_box>.ajaxloading").detach();
        $(".image_box>img").show()
    }
    
    $(".image_box").parent().find("form")[0].reset();
}

class MyBlogUploadAdapter {
    constructor( loader ) {
        // CKEditor 5's FileLoader instance.
        this.loader = loader;

        // URL where to send files.
        this.url = getServiceCMD("blogEditor", "uploadEmbedImage")+"&blogid=<?=$blogDetails[0]['id']?>";
    }

    // Starts the upload process.
    upload() {
        return this.loader.file
            .then( file => new Promise( ( resolve, reject ) => {
                this._initRequest();
                this._initListeners( resolve, reject, file );
                this._sendRequest( file );
            } ) );
    }

    // Aborts the upload process.
    abort() {
        if ( this.xhr ) {
            this.xhr.abort();
        }
    }

    // Example implementation using XMLHttpRequest.
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        xhr.open( 'POST', this.url, true );
        xhr.responseType = 'json';
    }

    // Initializes XMLHttpRequest listeners.
    _initListeners( resolve, reject ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = 'Couldn\'t upload file:' + ` ${ loader.file.name }.`;

        xhr.addEventListener( 'error', () => reject( genericErrorText ) );
        xhr.addEventListener( 'abort', () => reject() );
        xhr.addEventListener( 'load', () => {
            const response = xhr.response;

            if ( !response || response.error || response.Data.error ) {
                return reject( response && response.Data.error ? response.Data.message : genericErrorText );
            }

            // If the upload is successful, resolve the upload promise with an object containing
            // at least the "default" URL, pointing to the image on the server.
            resolve( {
                default: response.Data.url
            } );
        } );

        if ( xhr.upload ) {
            xhr.upload.addEventListener( 'progress', evt => {
                if ( evt.lengthComputable ) {
                    loader.uploadTotal = evt.total;
                    loader.uploaded = evt.loaded;
                }
            } );
        }
    }

    // Prepares the data and sends the request.
    _sendRequest() {
        var tData = this.loader.data;

        const data = new FormData();
        data.append( 'upload', tData);

        this.xhr.send( data );
    }
}
</script>