<div class="modal" id="for_end_hangup" style="width:90%;">
    <div class="modal-content">
        <h5 class="center">End Server Hang-up Andon List</h5>
        <div class="row">
            <div class="col s6">
               <p> <button class="btn #37474f blue-grey darken-3" onclick="uncheck_all_hangup()">Uncheck All</button>
               </p>
            </div>
            <div class="col s6">
             <p style="text-align:right;">   <button class="btn #37474f red darken-3" onclick="fix_hangups()">Done Fixing</button>
             </p>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
              <table class=" z-depth-5 table table-sm table-hover table-bordered table-striped">
                        <thead  style="background:#ada2a1;">
                    <th style="text-align:center;">
                        <p>
                            <label>
                                <input type="checkbox" name="" id="select_for_end_hangup_all" onclick="select_hangups()">
                                <span></span>
                            </label>
                        </p>
                    </th>
                            <th>Line</th>
                            <th>Problem</th>
                            <th>Action By</th>
                            <th>Department</th>
                            <th>Start Time</th>
                            <th>Requested By</th>
                        </thead>
                        <tbody id="hangup_request_for_end"></tbody>
                    </table>
            </div>
        </div>
    </div>
</div>