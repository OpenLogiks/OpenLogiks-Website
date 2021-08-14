<div id="mainWrapper" class="">
 <aside id="side-wrapper">
    <div class="sidenavMain">

        <h4>Options</h4>
        <ul>
            <li>
                <a href=""><span>+</span> Open Logiks._domPrefixes</a>
            </li>
            <li>
                <a href=""><span>+</span> Open Logiks._domPrefixes</a>
            </li>
            <li>
                <a href=""><span>+</span> Open Logiks._domPrefixes</a>
            </li>
            <li>
                <a href=""><span>+</span> Open Logiks._domPrefixes</a>
            </li>
            <li>
                <a href=""><span>+</span> Open Logiks._domPrefixes</a>
            </li>
        </ul>

    </div>
</aside>
<div id="content-wrapper" class="discriptionMain minHeight">
   
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-4 col-md-push-8">
                    <div class="downloadContent">
                        <div id="ligntEvents" class="downloadsingleBox ">
                            
                        	<div  class="rightSidebar" >
                        	 	<h2>Ambient Light Events</h2>
                        	 	<div class="subDescription">
                            	 	<h5>Description</h5>
                            	 	<p>Detects support for the API that provides information about the ambient light levels, as detected by the device's light detector, in terms of lux units.</p>
                        	 	</div>
                        	 	<div class="subDescription">
                            	 	<h5>Description</h5>
                            	 	<p>Detects support for the API that provides information about the ambient light levels, as detected by the device's light detector, in terms of lux units.</p>
                        	 	</div>
                                <div class="downloadBtn">
                                    <a href="" class="btn">Download</a>
                                </div>
                        	 </div>
                        </div>
                        <div id="cache" class="downloadsingleBox">
                            
                            <div  class="rightSidebar" >
                                <h2>Application Cache</h2>
                                <div class="subDescription">
                                    <h5>Description1</h5>
                                    <p>Detects support for the API that provides information about the ambient light levels, as detected by the device's light detector, in terms of lux units.</p>
                                </div>
                                <div class="subDescription">
                                    <h5>Description1</h5>
                                    <p>Detects support for the API that provides information about the ambient light levels, as detected by the device's light detector, in terms of lux units.</p>
                                </div>
                                <div class="downloadBtn">
                                    <a href="" class="btn">Download</a>
                                </div>
                             </div>
                        </div>
                     </div>
                </div>
                <div class="col-md-8 col-md-pull-4">
                    <div class=" menuSubheader">
                        <ul class="mainContent">
                            <li class="tablinks active"  onclick="openBlock(event, 'ligntEvents')"><a href="#"><span>+</span> Ambient Light Events</a></li>
                            <li class="tablinks"  onclick="openBlock(event, 'cache')"><a href="#"><span>+</span> Application Cache</a></li>
                            <li ><a href="#"><span>+</span> HTML5 Audio Element</a></li>
                            <li><a href="#"><span>+</span> Battery API</a></li>
                            <li><a href="#"><span>+</span> Blob constructor</a></li>
                            <li><a href="#"><span>+</span> Canvas</a></li>
                            <li><a href="#"><span>+</span> Web Cryptography</a></li>
                            <li><a href="#"><span>+</span> Custom Elements API</a></li>
                            <li><a href="#"><span>+</span> Custom protocol handler</a></li>
                            <li><a href="#"><span>+</span> CustomEvent</a></li>
                            <li><a href="#"><span>+</span> Dart</a></li>
                            <li><a href="#"><span>+</span> DataView</a></li>
                            <li><a href="#"><span>+</span> Emoji</a></li>
                            <li><a href="#"><span>+</span> Event Listener</a></li>
                            <li><a href="#"><span>+</span> EXIF Orientation</a></li>
                            <li><a href="#"><span>+</span> Flash</a></li>
                            <li><a href="#"><span>+</span> Force Touch Events</a></li>
                            <li><a href="#"><span>+</span> Fullscreen API</a></li>
                            <li><a href="#"><span>+</span> GamePad API</a></li>
                            <li><a href="#"><span>+</span> Geolocation API</a></li>
                            <li><a href="#"><span>+</span> Hashchange event</a></li>
                            <li><a href="#"><span>+</span> Hidden Scrollbar</a></li>
                             <li><a href="#"><span>+</span> History API</a></li>
                            <li><a href="#"><span>+</span> HTML Imports</a></li>
                            <li><a href="#"><span>+</span> IE8 compat mode</a></li>
                            <li><a href="#"><span>+</span> IndexedDB</a></li>
                            <li><a href="#"><span>+</span> IndexedDB Blob</a></li>
                            <li><a href="#"><span>+</span> Input attributes</a></li>
                            <li><a href="#"><span>+</span> input[search] search event</a></li>
                            <li><a href="#"><span>+</span> Form input types</a></li>
                            <li><a href="#"><span>+</span> Internationalization API</a></li>
                            <li><a href="#"><span>+</span> JSON</a></li>
                            <li><a href="#"><span>+</span> Font Ligatures</a></li>
                           
                          
                     
                           

                        </ul>

                    </div>
                </div>

            </div>

        </div>

    

   
</div>
</div>
<script>
    $('#mainWrapper').sidebar();
</script>
<script>
        $(function() {
          $(".minHeight").css({ minHeight: $(window).innerHeight() + 'px' });
          $(window).resize(function() {
            $("minHeight").css({ minHeight: $(window).innerHeight() + 'px' });
          });
          
        });
    </script>
<script>
    function openBlock(evt, downloadContents) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("downloadsingleBox");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(downloadContents).style.display = "block";
      evt.currentTarget.className += " active";
    }
</script>
<script>
$(document).ready(function(){
  $(".navbar-form .form-control").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".mainContent li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>