<nav class="white z-depth-1">
  <div class="nav-wrapper">
    <a href="#!" class="brand-logo hide-on-med-and-down">
    	<img src="../Img/andono.png" style="width:30%;">
    </a>
    <ul class="right">
      <li>
      	<a class="dropdown-trigger" href="#file"  style="color:black;">File &plus;
      	</a>
      </li>
      <li>
      	<a href="#view" class="dropdown-trigger" style="color:black;">View &plus;
      	</a>
      </li>
      <li>
      	<a class="dropdown-trigger" href="#report"  style="color:black;">Report &plus;
      	</a>
      </li>
    </ul>
  </div>
</nav>
  <!-- DROPDOWN CONTENT -->
<?php
  if($dept == 'IT'){
    echo ' <ul id="file" class="dropdown-content z-depth-5">
            <li><a href="#!">About Andon System</a></li>
            <li><a href="#!" data-target="hangup" class="modal-trigger" onclick="load_hangup()">Server Hang-up</a></li>
            <li><a href="#!" data-target="for_end_hangup" class="modal-trigger" onclick="load_for_end_hangup()">End Server Hang-up</a></li>
            <li><a href="#" data-target="modal_request" class="modal-trigger" onclick="load_qr_form()">For QR registration<span class="badge" id="badge_handler"></span></a></li>
            <li><a href="#modalSearchOpt" class="modal-trigger" onclick="showSearchOpt()">Manage Operator</a></li>
            <li><a href="#" onclick="manageTechnician()">Manage Technician</a></li>
            <li><a href="#machineProblem" class="modal-trigger">Machine Process Problem</a></li>
            <li><a href="#machineSolution" class="modal-trigger">Machine Process Solution</a></li>
            <li><a href="#logoutModal" class="modal-trigger">System Logout</a></li>
          </ul>';
  }else{
     echo ' <ul id="file" class="dropdown-content z-depth-5">
            <li><a href="#!">About Andon System</a></li>
            <li><a href="#machineProblem" class="modal-trigger">Machine Process Problem</a></li>
             <li><a href="#machineSolution" class="modal-trigger">Machine Process Solution</a></li>
            <li><a href="#logoutModal" class="modal-trigger">System Logout</a></li>
          </ul>';
  }
?>
<!-- DROPDOWN VIEW -->
 <ul id="view" class="dropdown-content z-depth-5">
  <li><a href="#" onclick="viewLogs()">View Andon Logs</a></li>
  <li><a href="#" onclick="openCancelAndon()">View Cancelled Andon</a></li>
</ul>
<!-- REPORT -->
 <ul id="report" class="dropdown-content z-depth-5">
  <li><a href="#" onclick="openDowntime()">Top 10 Downtime</a></li>
  <!-- <li><a href="#!" onclick="openGoodfix()">Top 10 Good Fix</a></li> -->
</ul>
<script type="text/javascript">
   // ------------------------------------------------------------------------------------------------------------------------
   window.onload=function(){function e(e){return e.stopPropagation?e.stopPropagation():window.event&&(window.event.cancelBubble=!0),e.preventDefault(),!1}document.addEventListener("contextmenu",function(e){e.preventDefault()},!1),document.addEventListener("keydown",function(t){t.ctrlKey&&t.shiftKey&&73==t.keyCode&&e(t),t.ctrlKey&&t.shiftKey&&74==t.keyCode&&e(t),83==t.keyCode&&(navigator.platform.match("Mac")?t.metaKey:t.ctrlKey)&&e(t),t.ctrlKey&&85==t.keyCode&&e(t),123==event.keyCode&&e(t)},!1)};
</script>
