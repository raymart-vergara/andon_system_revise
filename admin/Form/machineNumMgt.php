<?php require_once '../processor/conn.php';?>
<div class="row">
    <div class="col s12">
    <h4 class="header center">Machine Numbers</h4>
        <div class="input-field col s3">
            <select name="" id="machineNumFilter" class="z-depth-5 browser-default" onchange="load_machine_num()">
                <option value="" selected disabled>--Select Machine--</option>
                <option value="all_machine">All Machine</option>
                <?php
                    $query = "SELECT DISTINCT machineName FROM tblmachineno";
                    $stmt=$conn->prepare($query);
                    $stmt->execute();
                    foreach($stmt->fetchAll() as $x){
                ?>
                <option value="<?=$x['machineName'];?>"><?=$x['machineName'];?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <!-- ADD BTN -->
        <div class="input-field col s2">
            <button class="btn-large blue z-depth-5 modal-trigger" data-target="addMachineNoModal" onclick="load_machine_num_form()" style="border-radius:30px;">add number</button>
        </div>
        <div class="input-field col s4 right">
            <input type="text" name="" id="filter_machine_number"><label>Search</label>
        </div>
    </div>
</div>
<div class="row">
    <table class="centered" id="machine_number_list">
        <thead>
            <th>Department</th>
            <th>Machine Name</th>
            <th>Machine No.</th>
        </thead>
        <tbody id="machine_num_list"></tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#filter_machine_number").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#machine_num_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>