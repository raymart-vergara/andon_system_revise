<?php require_once '../processor/conn.php';?>
<script>load_carmaker();</script>
<div class="row">
    <div class="col s12">
        <h4 class="header center">Car Makers</h4>

        <div class="input-field col s2">
            <button class="btn-large red z-depth-5" onclick="load_carmaker()" style="border-radius:30px;">reload</button>
        </div>
        <div class="input-field col s3">
            <button class="btn-large blue z-depth-5 modal-trigger" data-target="modalAddCarmaker" style="border-radius:30px;" onclick="loadCarmakerform()">Add Car-maker</button>
        </div>
          <div class="input-field col s4 right">
            <input type="text" name="" id="filter_carmaker"><label>Search</label>
        </div>
    </div>
</div>
<div class="row">
    <table class="centered"  id="carmakerTable">
        <thead>
            <th>ID</th>
            <th>Car Model</th>
        </thead>
        <tbody id="carmaker_list"></tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#filter_carmaker").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#carmaker_list tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
</script>