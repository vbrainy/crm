        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
        	<div class="row">
            <h2 class="col-md-6"><strong>Import</strong></h2> 
                       
          </div>
             
             <div class="row">
           	<div class="col-md-12">
                  <div class="panel">                    
                    <div class="panel-content">	
<div class="row">
<div class="col-sm-6">
		<div class="form-group">

			<!-- HTML for import. #csv-import is used for jquery binding -->
			<form id="csv-import">
				<?php //echo phpversion() ?>
				<div style="margin-bottom: 20px">
					<label>Data type</label>
					<select name="csv_file_type">
						<option value="contacts">Contacts</option>
						<option value="customers">Customers</option>
						<option value="leads">Leads</option>
						<option value="opportunity">Opportunity</option>
						<option value="products">Products</option>
						<option value="sales">Sales info</option>
						<option value="vertical_subvertical">Vertical and subverticals</option>
					</select>
				</div>

				<div>
					<label>CSV file</label>
					<input type="file" id="csv_file" name="csv_file" accept="" class="form-control"/>
					<input type="submit" value="Import" class="btn btn-embossed btn-primary">
				</div>
			</form>
			

		</div>
		</div>
                        </div
                        </div>
                        </div>
                      </div>
                
           	
		   		
			   
		 	   	
       		 </div>
        </div>