<?php require_once '../processor/conn.php';?>
<div class="row">
    <div class="col s12">
    <h4 class="header center">Production Machine</h4>
        <div class="input-field col s3">
            <select name="" id="machineFilter" class="browser-default z-depth-5" onchange="load_machine()">
                <option value="" selected disabled>--Select Department--</option>
                <option value="all_dept">--All Department--</option>
                <?php
                    $q = "SELECT deptCode,description FROM tbldepartment";
                    $stmt = $conn->prepare($q);
                    $stmt->execute();
                    foreach($stmt->fetchALL() as $x){
                ?>
                    <option value="<?=$x['deptCode'];?>"><?=$x['description'];?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <!-- ADD BUTTON -->
        <div class="input-field col s2">
            <button class="btn-large z-depth-5 blue modal-trigger" data-target="addMachineModal" style="border-radius:30px;" onclick="load_machine_form()">Add Machine</button>
        </div>
        <div class="input-field col s4 right">
            <input type="text" name="" id="filter_machine_search"><label>Search</label>
        </div>
    </div>
</div>
<div class="row">
    <table class="centered" id="machine_table">
        <thead>
            <th>Category</th>
            <th>Department</th>
            <th>Machine Name</th>
        </thead>
        <tbody id="machine_list"></tbody>
    </table>
</div>
 

 <script type="text/javascript">
     $(document).ready(function(){
        $("#filter_machine_search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#machine_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
     });
 </script>