<div class="modal" id="hangup" style="width:90%;">
    <div class="modal-content">
        <h5 class="center">Server Hang-up Andon List</h5>
        <div class="row">
            <div class="col s6">
               <p> <button class="btn #37474f blue-grey darken-3" onclick="uncheck_all()">Uncheck All</button>
               </p>
            </div>
            <div class="col s6">
             <p style="text-align:right;">   <button class="btn #37474f blue-blue darken-3" onclick="fix_hangup()">Start Fixing</button>
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
                                <input type="checkbox" name="" id="select_hangup_all" onclick="select_hangup()">
                                <span></span>
                            </label>
                        </p>
                    </th>
                            <th>Line</th>
                            <th>Problem</th>
                            <th>Request By</th>
                            <th>Department</th>
                            <th>Request Time</th>
                        </thead>
                        <tbody id="hangup_request"></tbody>
                    </table>
            </div>
        </div>
    </div>
</div>