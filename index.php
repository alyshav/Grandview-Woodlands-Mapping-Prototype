
<!DOCTYPE html>
<html lang="en">
   <?php 
    include "header.php";
    include "navigation.php";
   ?>

  <body> 
    <!-- MODAL POPUP ON START -->
    <div class="modal hide fade" id="startModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h2>Welcome to the Grandview Woodlands MapX</h2>
      </div>
      <div class="modal-body">
        <p>Tools to map your public space.</p>
        <p>Find out more about the project, explore your neighbourhood, and see how you can contribute!</p>
        <p>Map your perceptions of the Granview Woodlands space by selecting "Add a new marker."</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" data-dismiss="modal">Get Started!</a>
      </div>
    </div>
    <!-- END POPUP ON START MODAL -->

    <!-- ABOUT MODAL -->
    <div class="modal hide fade" id="aboutModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h2>Project Overview</h2>
      </div>
      <div class="modal-body">
        <h4>This is a place to express your observations about the public spaces in your neighbourhood, connect with others who have observed the same issues, and empower yourselves to create impactful change. </h4>
          <p>The main objective of this project is to develop a toolkit and platform upon which local residents and organizations can easily share information about their built environment. This crowdsourced information about public space is represented geographically on the community's map. The focus is on public safety and green spaces. Examples of information represented in zones on the map include, but aren't restricted to, areas where lighting is an issue, under-utilized green space, public space maintenance issues, and inadequate pedestrian access. Our ongoing work will collaborate with local residents and community organizations to fine tune the map for easy public access and use.</p>
          <p>If we can map public spaces in Grandview Woodlands successfully, we will refine and export this concept to other interested communities and organizations. Along with the online mapping research, people will also be able to download the toolkit in order to take our project into another community zone. Stay tuned for our toolkit!</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!-- END ABOUT MODAL -->

    <!-- CONTACT MODAL -->
    <div class="modal hide fade" id="contactModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Contact us</h3>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> development@gmail.com</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!-- END CONTACT MODAL -->

    <!-- RESOURCES MODAL -->
    <div class="modal hide fade" id="resourcesModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Resources</h3>
      </div>
      <div class="modal-body">
        <p><a target="_blank" href="http://vancouver.ca/police/organization/planning-research-audit/neighbourhood-statistics.html">VPD</a></p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!-- END RESOURCES MODAL -->

    <!-- ADD MARKER TO THE MAP INSTRUCTIONS -->
    <div class="modal hide fade" id="addmeModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Map an observation</h3>
      </div>
      <div class="modal-body">        
        <p>Navigate to the incident or observation location with your cursor, and click on the map to drop the marker and submit your information.</p>
        <p>Click "Add Marker" to start!</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <a href="#" onclick="$('#addmeModal').modal('hide'); initAddMarker(); return false;"class="btn btn-success">Add Marker</a>
      </div>
    </div>
    <!-- END ADD MARKER TO THE MAP INSTRUCTIONS -->

    <!-- SUCCESS MODAL -->
    <div class="modal hide fade" id="insertSuccessModal">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>Thank you!</h3>
      </div>
      <div class="modal-body">
        <p>Thanks for helping us make the Grandview-Woodland area a better place!</p>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
      </div>
    </div>
    <!-- END SUCCESS MODAL -->



    <div id="map"></div>

    <div id="loading-mask" class="modal-backdrop" style="display:none;"></div>

    <div id="loading" style="display:none;">
        <div class="loading-indicator">
            <img src="img/ajax-loader.gif">
        </div>
    </div>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="styles/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="styles/leaflet/leaflet.js"></script>
    <script type="text/javascript" src="styles/leaflet/plugins/leaflet.markercluster/leaflet.markercluster.js"></script>



<script type="text/javascript">
    //    $(window).load(function(){
    //        $('#startModal').modal('show');
    //    });
    $(document).ready(function () {
        $.ajaxSetup({ cache: false });
        getUsers();
    });
</script>

    <!-- MAP FUNCTIONS -->
    <script type="text/javascript" src="javascript/map.js"></script>

  </body>
</html>
