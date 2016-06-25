<!DOCTYPE html>
<html lang="en">
    <body>
         <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <a class="brand" href="/">GW Map</a>
              <div class="nav-collapse">
                <ul class="nav">
                  <li><a href="#" onclick="$('#aboutModal').modal('show'); return false;"> About </a></li>
                  <li><a href="#" onclick="$('#visualizationModal').modal('show'); return false;"> Reports </a></li>              
                  <li><a href="#" onclick="$('#resourcesModal').modal('show'); return false;"> Resources </a></li>
                  <li><a href="#" onclick="$('#contactModal').modal('show'); return false;"> Contact </a></li>
                </ul>
                <form class="navbar-form pull-right">
                   <span style="padding-right: 20px;"><a class='btn btn-success' data-toggle="modal" href="#addmeModal"><i class="icon-plus-sign icon-white"></i> Add a new marker</a></span>
                </form>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
