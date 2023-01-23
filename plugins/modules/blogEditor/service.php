<?php
if(!defined('ROOT')) exit('No direct script access allowed');

handleActionMethodCalls();

function _service_update_categories() {
    if(!isset($_POST['article'])) return "Missing article";
    if(!isset($_POST['catgories'])) return "Catgories article";
    
    _db()->_updateQ("blog_tbl", [
            "category"=>$_POST['catgories'],
            "edited_on"=>date("Y-m-d H:i:s"),
            "edited_by"=>$_SESSION['SESS_USER_ID'],
        ], [
            "id"=>$_POST['article']
        ])->_RUN();
    
    return "Categories updated successfully";
}

function _service_publishArticle() {
    if(!isset($_POST['article'])) return "Missing article";
    
    _db()->_updateQ("blog_tbl", [
            "published"=>"true",
            "published_on"=>date("Y-m-d H:i:s"),
            "published_by"=>$_SESSION['SESS_USER_ID'],
            "edited_on"=>date("Y-m-d H:i:s"),
            "edited_by"=>$_SESSION['SESS_USER_ID'],
        ], [
            "id"=>$_POST['article']
        ])->_RUN();
    return "Article Published successfully";
}

function _service_deleteArticle() {
    if(!isset($_POST['article'])) return "Missing article";
    
    _db()->_updateQ("blog_tbl", [
            "blocked"=>"true",
            "edited_on"=>date("Y-m-d H:i:s"),
            "edited_by"=>$_SESSION['SESS_USER_ID'],
        ], [
            "id"=>$_POST['article']
        ])->_RUN();
    return "Article has been deleted";
}

function _service_uploadFeaturedImage() {
    if(!isset($_POST['blogid']) || !isset($_POST['old_path'])) {
        echo "<script>parent.uploadCompleted(true, 'Blog Not Defined, try reloading the page')</script>Blog Not Defined, try reloading the page";
    } elseif(!$_FILES['error']) {
        // printArray($_FILES);
        // printArray($_POST);
        
        $oldFile = CMS_APPROOT."usermedia/{$_POST['old_path']}";
        $oldFile1 = str_replace("/photos_featured/", "/photos_thumbnail/", $oldFile);
        $oldPath = dirname($_POST['old_path']);
        
        if(file_exists($oldFile)) {
            unlink($oldFile);
        }
        if(file_exists($oldFile1)) {
            unlink($oldFile1);
        }
        
        $fnameArr = explode(".", $_FILES['attachment']['name']);
        $ext = strtolower(end($fnameArr));
        $fnameArr = array_slice($fnameArr, 0, count($fnameArr)-1);
        $_FILES['attachment']['name'] = implode(".", $fnameArr);
        
        $newFile = CMS_APPROOT."usermedia/{$oldPath}/"._slugify($_FILES['attachment']['name']).".{$ext}";
        $newFile1 = str_replace("/photos_featured/", "/photos_thumbnail/", $newFile);
        
        // println($oldFile);
        // println($newFile);
        // println($oldPath);
        
        $a = move_uploaded_file($_FILES['attachment']['tmp_name'], $newFile);
        $a1 = copy($newFile, $newFile1);
        // var_dump([$a, file_exists($newFile)]);
        
        if($a) {
            $b = _db()->_updateQ("blog_tbl", [
                    "photos_featured"=>str_replace(CMS_APPROOT."usermedia/", "", $newFile),
                    "photos_thumbnail"=>str_replace(CMS_APPROOT."usermedia/", "", $newFile1),
                    "edited_on"=>date("Y-m-d H:i:s"),
                    "edited_by"=>$_SESSION['SESS_USER_ID'],
                ], [
                    "id"=>$_POST['blogid']
                ])->_RUN();
            
            $lx = str_replace(CMS_APPROOT, SiteLocation."apps/".CMS_SITENAME."/", $newFile);
            echo "<script>parent.uploadCompleted(false, '{$lx}')</script>";
        } else {
            echo "<script>parent.uploadCompleted(true, 'Upload Error (2), try again')</script>Upload Error (2), try again";
        }
    } else {
        echo "<script>parent.uploadCompleted(true, 'Upload Error, try again')</script>Upload Error, try again";
    }
}

function _service_uploadEmbedImage() {
    if(!isset($_REQUEST['blogid'])) {
        return [
            "error"=>"BLOG NOT DEFINED",
            "message"=>"Blog not found"
        ];
    } else {
        $uploadData = $_POST['upload'];
        
        $uploadDataArr = explode(";base64,", $uploadData);
        $ext = trim(str_replace("data:image/", "", $uploadDataArr[0]));
        
        $dated = date("Y_m_d_Hi");
        $fname = md5(time().session_id());
        $newFile = CMS_APPROOT."usermedia/blog_photos/blog-{$_REQUEST['blogid']}/{$dated}/{$fname}.{$ext}";
        
        if(!is_dir(dirname($newFile))) {
            mkdir(dirname($newFile), 0777, true);
        }
        
        $a = file_put_contents($newFile, base64_decode($uploadDataArr[1]));
        
        if(file_exists($newFile)) {
            return [
                "status"=>"success",
                "url"=>getWebPath($newFile),
                //"url"=>"https://g.foolcdn.com/art/companylogos/square/goog.png"
            ];
        } else {
            return [
                "error"=>"UPLOAD ERROR",
                "message"=>"Error uploading image"
            ];
        }
    }
}
?>