  <nav id="navbar" class="navbar navbar-toggleable-md navbar-expand-lg double-nav" style="background:white smoke;padding:10px;">
      <!-- SideNav slide-out button -->
     

      <ul class="nav navbar-nav nav-flex-icon" >
        <li class="dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            File
          </a>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink" >
            <a class="dropdown-item" href="#"><i class="fas fa-exclamation-triangle"></i>&nbsp;About Andon System</a>
            <!-- <a class="dropdown-item" href="#" onclick="regQR()"><i class="fas fa-chart-line"></i>&nbsp;ANDON QR Request</a> -->
        </li>
      </ul> 

      <ul class="nav navbar-nav nav-flex-icons">
        <li class="dropdown">
          <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Report
    
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">   
            <a class="dropdown-item" href="#" onclick="openDowntime()"><i class="fas fa-chart-line"></i>&nbsp;Top 10 Downtime</a>
            <a class="dropdown-item" href="#" onclick="openAndonLogsProd()"><i class="fas fa-chart-line"></i>&nbsp;Andon Logs</a>
            <a class="dropdown-item" href="#" onclick="machineDownTime()"><i class="fas fa-chart-line"></i>&nbsp;Machine Downtime</a>
            <a class="dropdown-item" href="#" onclick="applicatorLogs()"><i class="fas fa-chart-line"></i>&nbsp;TRD Applicator Replacement Logs</a>
             <a class="dropdown-item" href="#" onclick="mmtrSummary()"><i class="fas fa-chart-line"></i>&nbsp;Andon Summary</a>
             <a class="dropdown-item" href="#" onclick="machineSummary()"><i class="fas fa-chart-line"></i>&nbsp;Machine Problems Summary</a>
          </div>
        </li>
      </ul>

      <div class="float-left">
        <a href="admin/" style="color:black;">Department Admin</a>
      </div>

    <div class="text-center mt-4" style="position:absolute;margin-left:73%;">
      <p id='realtime' style="font-size:12px;"></p>
    </div>


    </nav>