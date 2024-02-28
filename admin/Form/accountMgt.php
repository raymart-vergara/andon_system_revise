<?php require_once '../processor/conn.php';?>
<div class="row">
    <div class="col s12">
    <h4 class="header center">User Account Viewer</h4>
    <!-- FITLER BY CARMAKER -->
        <div class="input-field col s3">
            <select name="" id="filter_carmaker" class="browser-default z-depth-5">
                <option value="">--Filter by Carmaker--</option>
                <?php
                    $query = "SELECT carMaker FROM tblcarmaker";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();
                    foreach($stmt->fetchALL() as $x){
                ?>
                    <option value="<?=$x['carMaker'];?>"><?=$x['carMaker'];?></option>
                <?php
                    }
                ?>
            </select>
        </div>
    <!-- FILTER BY  PRODUCTION-->
            <div class="input-field col s3">
            <select name="" id="filter_production" class="browser-default z-depth-5">
                <option value="">--Filter by Production</option>
                <option value="Initial">Initial</option>
                <option value="Final">Final</option>
            </select>
            </div>
    <!-- FILTER BY  ACCOUNT TYPE-->
            <div class="input-field col s3">
                <select name="" id="filter_rank" class="browser-default z-depth-5">
                <option value="">--Filter by Account Rank--</option>
                <?php
                    $query ="SELECT DISTINCT accountType FROM tblaccount";
                    $stmt=$conn->prepare($query);
                    $stmt->execute();
                    foreach($stmt->fetchAll() as $x){
                ?>
                <option value="<?=$x['accountType'];?>"><?=$x['accountType'];?></option>
                <?php
                    }
                ?>
                </select>
            </div>
        <!-- SEARCH BUTTON -->
            <div class="input-field col s3">
                <button class="btn z-depth-5 blue col s12" style="border-radius:30px;" onclick="filterAccount()" id="generateAcctbtn">Generate</button>
            </div>

            <!-- search -->
            <div class="input-field col s12" style="display:none;" id="search_area">
                <input type="text" name="" id="filter_acct"><label>Search</label>
            </div>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <table class="centered">
            <thead>
                <th>ID Number</th>
                <th>Full Name</th>
                <th>Carmaker/Department</th>
                <th>Production</th>
            </thead>
            <tbody id="account_list"></tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $('#generateAcctbtn').click(function(){
        $('#search_area').fadeIn(500);
    });
    $(document).ready(function(){
        $("#filter_acct").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#account_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>