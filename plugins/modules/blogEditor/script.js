function viewBlogDetails(e){
    var refid=$(e).data("hash");    
     
    var blog_id=e.find("td[data-key=id]").data("value");
    var hashid="id="+blog_id;
    // lgksOverlayFrame(_link("modules/forms/blogEditor.addBlogDetails/new?"+hashid),"Add Details",function(a) {
    //   hideLoader();
    // });
    window.location=_link("modules/blogEditor/edit/"+hashid)+hashid;
 }