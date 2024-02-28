<?php require_once '../processor/conn.php';?>
<div class="row">
    <div class="col s12">
    <h5 class="header center">Machine Process</h5>
        <div class="input-field col s3">
        <select name="" id="filter_machine" class="browser-default z-depth-5" style="border-radius:20px;" onchange="filterProcess()">
            <option value="" selected disabled>--Select Machine--</option>
            <option value="all_machine_process">All Machine</option>
            <?php
                $q = "SELECT DISTINCT machineName FROM tblprocess";
                $stmt = $conn->prepare($q);
                $stmt->execute();
                foreach($stmt->fetchALL() as $x){
            ?>
            <option value="<?=$x['machineName'];?>"><?=$x['machineName'];?></option>
            <?php
                }
            ?>
        </select>
        </div>
        <div class="input-field col s2">
            <button class="btn-large blue z-depth-5 modal-trigger" data-target="addProcessModal" style="border-radius:30px;" onclick="loadProcessForm()">Add Process</button>
        </div>
        <!-- FILTER -->
          <div class="input-field col s4 right">
            <input type="text" name="" id="filter_process"><label>Search</label>
        </div>
    </div>
</div>
<div class="row">
    <table class="centered" id="processTable">
        <thead>
            <th>Department</th>
            <th>Machine Name</th>
            <th>Machine Process</th>
        </thead>
        <tbody id="process_list"></tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#filter_process").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#process_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>