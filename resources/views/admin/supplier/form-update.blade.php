<form class="ui form formUpdateSupplier" action="#" id="formUpdateSupplier" method="post">
    <div class="ui error message">
        {{--  --}}
    </div>
    <div class="field">
            <div class="field">
                <label>SUPPLIER NAME</label>
                <input type="text" name="supplier_name" placeholder="SUPPLIER NAME" id="supplier_name">
            </div>
            <div class="field">
                <label>PROVINCE</label>
                <div class="ui selection dropdown" id="supplier_province">
                    <input type="hidden" name="supplier_province">
                    <i class="dropdown icon"></i>
                    <div class="default text">PROVINCE</div>
                    <div class="menu">
                      
                    </div>
                </div>
            </div>
    </div>
    <div class="field">
            <div class="field">
                <label>MUNICIPALITY</label>
                <div class="ui selection dropdown" id="supplier_municipality">
                    <input type="hidden" name="supplier_municipality">
                    <i class="dropdown icon"></i>
                    <div class="default text">MUNICIPALITY</div>
                    <div class="menu">
                      
                    </div>
                </div>
            </div>
            <div class="field">
                <label>BARANGAY</label>
                <div class="ui selection dropdown" id="supplier_barangay">
                    <input type="hidden" name="supplier_barangay">
                    <i class="dropdown icon"></i>
                    <div class="default text">BARANGAY</div>
                    <div class="menu">
                      
                    </div>
                </div>
            </div>
    </div>

    <div class="field">
        <div  class="two fields">
            <div class="field">
                <input type="text" name="supplier_latitude" placeholder="LATITUDE" id="supplier_latitude">
            </div>
            <div class="field">
                <input type="text" name="supplier_longitude" placeholder="LONGITUDE" id="supplier_longitude">
            </div>
            <div class="ui labeled button" tabindex="0">
                <div class="ui red button">
                  <i class="location arrow icon"></i> 
                </div>
                <a class="ui basic red left pointing label">
                 LOCATION
                </a>
              </div>
        </div>
    </div>
</form>