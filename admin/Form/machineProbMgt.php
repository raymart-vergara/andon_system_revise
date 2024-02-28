<?php require_once '../processor/conn.php';?>
<div class="row">
    <div class="col s12">
    <h5 class="header center">Machine Problem Viewer</h5>
        <div class="input-field col s3">
        <select name="" id="filter_machine" class="browser-default z-depth-5" style="border-radius:20px;" onchange="filterProblem()">
            <option value="" selected disabled>--Select Machine--</option>
            <option value="all_machine_prob">All Machine</option>
            <?php
                $q = "SELECT DISTINCT machineName FROM tblmachinename";
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
        <!-- FILTER -->
          <div class="input-field col s4 right">
            <input type="text" name="" id="filter_problem"><label>Search</label>
        </div>
    </div>
</div>
<div class="row">
    <table class="centered" id="problemTable">
        <thead>
            <th>Department</th>
            <th>Machine Name</th>
            <th>Problem Encountered</th>
        </thead>
        <tbody id="problem_list"></tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#filter_problem").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#problem_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>