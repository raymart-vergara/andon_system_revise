<div class="modal" id="modalEditOperator" style="">
    <div class="modal-content">
        <h5 class="center">Edit Account</h5>
        <input type="hidden" id="recordID">
        <div class="row col s12">
            <!-- FIELD -->
        <div class="col s6">
            <label for="">ID Number</label>
            <input type="text" value="" id="idnumber">
        </div>
        <!-- FIRSTNAME -->
        <div class="col s6">
            <label for="">Firstname</label>
            <input type="text" id="fname">
        </div>
        <!-- LASTNAME -->
        <div class="col s6">
           <label for="">Lastname</label>
            <input type="text" id="lname">
        </div>
        <!-- CARMAKER  -->
        <div class="input-field col s6">
            <select name="" id="newCarmaker" class="browser-default">
                <option value="">-SELECT CARMAKER-</option>
                <?php
                    include '../processor/conn.php';
                    $qry = "SELECT carMaker FROM tblcarmaker";
                    $stmt = $conn->prepare($qry);
                    $stmt->execute();
                    $res = $stmt->fetchall();
                        foreach($res as $x){
                            if($x['carMaker'] == 'IT' || $x['carMaker'] == 'EQD' || $x['carMaker'] == 'PE')continue;
                            echo '<option value="'.$x['carMaker'].'">'.$x['carMaker'].'</option>';
                        }
                ?>
            </select>
        </div>
        <!-- CATEGORY -->
        <div class="input-field col s6">
             <select name="newCategory" id="" class="browser-default">
                <option value="">-SELECT CATEGORY-</option>
                <option value="Initial">Initial</option>
                <option value="Final">Final</option>
            </select>
        </div>
        </div>
        <!-- BUTTON -->
        <div class="row">
            <button class="btn blue" onclick="updateOperator()">Update</button>
            <button class="btn-flat modal-close">Cancel</button>
        </div>
    </div>
</div>