<?php require_once '../processor/conn.php';?>
<div class="row">
    <div class="col s12">
        <h4 class="header center">Production Line Viewer</h4>
        <div class="input-field col s3">
            <select name="" id="line_option" class="browser-default z-depth-5" onchange="filterLine()">
                <option value="" selected disabled>--Select Car-maker--</option>
                <option value="all_line">All Carmaker</option>
                <?php
                    $q = "SELECT *FROM tblcarmaker";
                    $stmt = $conn->prepare($q);
                    $stmt->execute();
                    foreach($stmt->fetchALL() as $x){
                        if($x['carMaker'] == 'IT' || $x['carMaker'] == 'EQD' || $x['carMaker'] == 'PE')continue;
                ?>
                <option value="<?=$x['carMaker'];?>"><?=$x['carMaker'];?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <!-- ADD -->
        <div class="input-field col s2">
            <button class="btn-large z-depth-5 blue modal-trigger" data-target="addLineModal" style="border-radius:30px;" onclick=loadAddLine()>Add New Line</button>
        </div>
        <!-- FILTER -->
          <div class="input-field col s4 right">
            <input type="text" name="" id="filter_line"><label>Search</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <table class="centered" id="line_master">
            <thead>
            <th>Category</th>
            <th>Car Model</th>
            <th>Line #</th>
            </thead>
            <tbody id="line_data"></tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#filter_line").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#line_data tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>