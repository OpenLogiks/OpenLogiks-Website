<?php
if(!defined('ROOT')) exit('No direct script access allowed');

loadModule("pages");

function pageSidebar() {
  // <form role='search'>
  //     <div class='form-group'>
  //       <input type='text' class='form-control' placeholder='Search'>
  //     </div>
  // </form>
  return "<div id='componentTree' class='componentTree list-group list-group-root well'></div>";
}

function pageContentArea() {
  return file_get_contents(__DIR__."/ui.html");
}

echo _css("blogEditor");
echo _js(["blogEditor"]);

printPageComponent(false,[
    "toolbar"=>[
        "refreshPage"=>["icon"=>"<i class='fa fa-refresh'></i>"],
        "openCreateModal"=>["icon"=>"<i class='fa fa-upload'></i>","tips"=>"Upload"],
        ['type'=>"bar"],
        "deleteContent"=>["icon"=>"<i class='fa fa-trash'></i>","class"=>"onsidebarSelect"],
    ],
    "sidebar"=>false,//"pageSidebar",
    "contentArea"=>"pageContentArea"
]);
?>
<script>
const FORSITE='{$_REQUEST["forsite"]}';
function refreshPage() {
    window.location.reload();
}
function loadPhotos() {
    
}
function uploadPhotos() {
    
}
function deletePhotos() {
    
}
</script>