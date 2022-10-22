<div class="container content-invoice">
	<form action="<?php echo base_url(); ?>index/generate_invoice" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
					<h2 class="title">Invoice System</h2>
				</div>		    		
			</div>
			<p class="error">Some fields are missing..!!</p>
			<div  id="main_wrapper" class="row main_wrapper">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<table class="table table-bordered table-hover" id="invoiceItem">	
						<tr>
							<th width="30%">Item Name</th>
							<th width="5%">Quantity</th>
							<th width="15%">Price($)</th>								
							<th width="10%">Tax(%)</th>								
							<th width="15%">Total(excl.Tax)</th>
							<th width="15%">Total(incl.Tax)</th>
						</tr>							
						<tr class="data_value_key" id="row_1">
							<td><input type="text" name="product_name"  class="form-control product_name" autocomplete="off"></td>			
							<td><input type="number" name="quantity"  class="form-control quantity" autocomplete="off"></td>
							<td><input type="number" name="price"  class="form-control price" autocomplete="off"></td>
							<td><select name="tax" id="tax" class="form-control tax">
									<option value="0" selected="selected">0%</option>
									<option value=1>1%</option>
									<option value=5>5%</option>
									<option value=10>10%</option>
							</select></td>
							<td><input type="number" readonly name="total_notax" class="form-control total_notax" autocomplete="off"></td>
							<td><input type="number" readonly name="total_tax" class="form-control total_tax" autocomplete="off"></td>
                            <td width="15%"> <a href="javascript:void(0)" style= "margin-right:60px;" class="remove_source right">Remove</a></td>
						</tr>						
					</table>
				</div>
			</div>

			<div class="row ">
				<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<button class="btn btn-info" id="add_key" type="button">Add</button>
				</div>
			</div>
        
			<div class="row">	
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					
					<br>
					<div class="form-group">
					<input type="hidden" class="invoice_json" name="invoice_json">
						<input  type="button" name="invoice_btn" onclick="savejsonOrder()" value="Generate Invoice" class="btn btn-primary submit_btn invoice-save-btm">						
						<!-- <input  type="submit" name="invoice_btn"  value="Generate Invoice" class="btn btn-primary submit_btn invoice-save-btm">						 -->
					</div>
					
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<span class="form-inline">
						<div class="form-group">
							<label>Subtotal(excl.Tax):</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" readonly type="number" class="form-control subTotal_notax" name="subTotal_notax" id="subTotal_notax" placeholder="Subtotal(excl.Tax)">
							</div>
						</div>
                        <div class="form-group">
							<label>Discount Type</label>
                            <div class="radio">
                                <label><input type="radio" class="discount_type" name="discount_type" value="$" checked> Amount ($)</label>
                            </div>
							<div class="radio">
                                <label><input type="radio" class="discount_type" name="discount_type" value="%" > Percentage (%)</label>
                            </div>
                            
                            
						</div>


                        <div class="form-group">
							<label>Discount :</label>
							<div class="input-group">
								<div class="input-group-addon discount_icon">$</div>
								
								<input value="" type="number" class="form-control discount" name="discount"  id="discount" placeholder="Discount">
							</div>
                            
						</div>

                        <div class="form-group discount_amt_wrapper">
							<label>Discount Amount:</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" type="number" class="form-control discount_amt" name="discount_amt"  id="discount_amt" placeholder="Discount">
							</div>
                            
						</div>

                        <div class="form-group">
							<label>Subtotal(incl.Tax)</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value="" readonly type="number" class="form-control subTotal_tax" name="subTotal_tax" id="subTotal_tax" placeholder="Subtotal(incl.Tax)">
							</div>
						</div>


						<div class="form-group">
							<label>Total Amount : &nbsp;</label>
							<div class="input-group">
								<div class="input-group-addon currency">$</div>
								<input value=""readonly  type="number" class="form-control total_amt" name="total_amt" id="total_amt" placeholder="Total Amount">
							</div>
						</div>
						
					</span>
				</div>
			</div>
			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>	



