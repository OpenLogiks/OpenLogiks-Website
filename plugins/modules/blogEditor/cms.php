<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$slug=_slug("a/action/c/d/e");
// printArray($slug);exit();

loadModule("pages");

$toolBar=[
//     "loadNewApplication"=>["title"=>"New Application","align"=>"right","class"=>($reportType=="new")?"active":"","policy"=>"hrApplications.new.access"],
//     "loadHistory"=>["title"=>"History","align"=>"right","class"=>($reportType=="history")?"active":"","policy"=>"hrApplications.history.access"],
//     "loadStaffHistory"=>["title"=>"Staff History","align"=>"right","class"=>($reportType=="staff_history")?"active":"","policy"=>"hrApplications.staff_history.access"],
//   /* "loadMyApplication"=>["title"=>"My Application","align"=>"right","class"=>($reportType=="main")?"active":"","policy"=>"hrApplication.main.access"],
//     "loadUpcoming"=>["title"=>"Upcoming","align"=>"right","class"=>($reportType=="upcoming")?"active":"","policy"=>"hrApplication.upcoming.access"],
//     "loadHistory"=>["title"=>"History","align"=>"right","class"=>($reportType=="history")?"active":"","policy"=>"hrApplication.history.access"]*/
    "reloadPage"=>["icon"=>"<i class='fa fa-refresh'></i>","tips"=>"Refresh"]
];
$pageSidebar = false;
$contentArea = "";

if(checkModule("multilang")) {
    loadModuleLib("multilang", "api");
}
include_once __DIR__."/compatibility.php";

switch($slug['action']) {
    case "new":
        ob_start();
        ?>
        <div class="col-xs-12">
        	<div class="row">
        		<?php
    				loadModuleLib("forms","api");
    			    $formConfig=findForm(__DIR__."/forms/main.json");
                	//printForm('update',$formConfig,'app',["md5(id)"=>md5($companyInfo['id'])]);
                	printForm('create',$formConfig,'app');
            	?>
            </div>
        </div>
        <?php
        $contentArea=ob_get_contents();
    	ob_end_clean();
    	$toolBar = false;
        break;
    case "edit":
        ob_start();
        include_once __DIR__."/comps/editor.php";
        $contentArea=ob_get_contents();
    	ob_end_clean();
        break;
    case "":
    default:
        loadModuleLib("reports","api");

        if(isset($_GET['lang']) && strlen($_GET['lang'])>0) {
            $report=__DIR__."/reports/main_lang.json";
        } else {
            $report=__DIR__."/reports/main.json";
        }
        
        echo _css("reports");
        
        ob_start();
    	echo "<div class='col-xs-12'>";// report-notoolbar
    	echo "<div class='row'>";
    	
    	echo "<div class='reportholder' style='width:100%;height:100%;'>";
    	$a=printReport($report);
    	if(!$a) {
    		echo "<h3 align=center>Panel Source Corrupted</h3>";
    	}
    	echo "</div>";
    	echo "</div>";
    	echo "</div>";
    	$contentArea=ob_get_contents();
    	ob_end_clean();
    	
    	if(!isset($_GET['lang'])) $_GET['lang'] = "";
    	
    	$toolBar['newPost'] = ["icon"=>"<i class='fa fa-plus'></i>", "title"=>"New Post","align"=>"left"];
        break;
}

printPageComponent(false,[
    "toolbar"=>$toolBar,
    "sidebar"=>$pageSidebar,
    "contentArea"=>$contentArea
]);
?>
<style>
pre {
    background: transparent;
    margin: inherit;
    text-align: left;
    padding: 0px;
    border: 0px;
    font-size: inherit;
    color: inherit;
}
.blog_title {
    color:#0073aa;
}
table.dataTable td.actionCol, table.dataTable th.actionCol {
    white-space: nowrap;
}
.formbox .formbox-content {
    /*padding: 10px;*/
}
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
<script>
$(function() {
    $('.overlayBox').on('shown.bs.modal', function () {
        //alert("XXXXX");
    });
    $('.overlayBox').on('hidden.bs.modal', function (e) {
            LGKSReports.getInstance(Object.keys(LGKSReportsInstances)[0]).reloadDataGrid();
            $(".modal-backdrop").detach();
        });
    
    <?php if(isset($toolBar['newPost'])) { ?>
    $("#pgtoolbar .navbar-right").html("<select id='languageSelector' class='form-control select' style='margin: 5px;float:right'><option value=''>Language</option><?=get_lang_list_dropdown($_GET['lang'])?></select>");
    $("#languageSelector").change(function() {
        window.location = _link("<?=PAGE?>")+"&lang="+this.value;
    });
    <?php } ?>
});
function reloadPage() {
    window.location.reload();
}
function newPost() {
    //lgksOverlayFrame(_link("modules/forms/blogEditor.main"), "New Post");
    window.location=_link("modules/blogEditor/new");
}
// function addBlogDetails(e){
//     var refid=$(e).data("hash");
//     var blog_id=e.find("td[data-key=id]").data("value");
//     window.location=_link("modules/blogEditor/edit/"+blog_id);
//  }
function viewBlogDetails(e){
    // var refid=$(e).data("hash");    
     
    // var blog_id=e.find("td[data-key=id]").data("value");
    // var hashid="id="+blog_id;
    // // lgksOverlayFrame(_link("modules/forms/blogEditor.addBlogDetails/new?"+hashid),"Add Details",function(a) {
    // //   hideLoader();
    // // });
    // window.location=_link("modules/blogEditor/edit/"+hashid)+hashid;
    
    var refid=$(e).data("hash");
    var blog_id=e.find("td[data-key=id]").data("value");
    window.location=_link("modules/blogEditor/edit/"+blog_id);
}
</script>