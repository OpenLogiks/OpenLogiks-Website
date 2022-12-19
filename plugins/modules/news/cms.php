<?php
if(!defined('ROOT')) exit('No direct script access allowed');

$slug = _slug("module/subtype/type/refid");
$type=$slug['subtype'];

if($type==null || strlen($type)<=0){
    $type="panel";
	header("Location:"._link("modules/news/panel"));
	return;
    
}

$basePath = __DIR__."/{$type}/";

if(!is_dir($basePath)) {
	print_error("Component Not Supported Yet");
	return;
}

$report=$basePath."report.json";
$form=$basePath."form.json";
//echo $report;

loadModule("datagrid");
?>
<style>
 form .nicEdit-main {
   
        min-height: 400px !important;
    }
    .validate .form-group [unselectable="on"] + div{
        max-height: unset !important;
    }
.formbox .formbox-content {
	border:0px !important;
	-webkit-box-shadow: none !important;
	-moz-box-shadow: none !important;
	box-shadow: none !important;
}
</style>
<div class='col-xs-12 col-md-12 col-lg-12'>
	<div class='row'>
		<?php
			printDataGrid($report,$form,$form,["slug"=>"module/subtype/type/refid","glink"=>_link("modules/news/{$type}")],"app");
		?>
	</div>
</div>