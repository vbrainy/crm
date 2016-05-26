<?php if( ! empty($qtemplate_products) ){?>
					    									<?php foreach( $qtemplate_products as $qtemplate_product){ 
					   
					    $product_res=$this->quotations_model->get_pricelist_version_product($pricelist_version->id,$qtemplate_product->product_id);
					    									
					    if($product_res!=0)
					    {
							$product_price= $product_res;
						}
						else
						{
							$product_price=$qtemplate_product->price;	
						}
					   
					    									?> 
									                      <tr class="remove_tr" id="qo_product_id_<?php echo $qtemplate_product->id;?>"><td>
									                      <input type="hidden" name="qtemplate_product_id[]" id="qtemplate_product_id" value="<?php echo $qtemplate_product->id;?>" />
									                      <input type="hidden" name="p_id[]" id="p_id" value="<?php echo $qtemplate_product->product_id;?>" readOnly><input type="text" name="product_name[]" id="product_name" value="<?php echo $qtemplate_product->product_name;?>" class="form-control" readOnly></td><td><textarea name=description[]" id="description" rows="2" class="form-control" readOnly><?php echo $qtemplate_product->discription;?></textarea></td><td><input type="text" name="quantity[]" id="quantity<?php echo $qtemplate_product->product_id;?>" value="<?php echo $qtemplate_product->quantity;?>" class="form-control" onchange="product_price_changes('quantity<?php echo $qtemplate_product->product_id;?>','<?php echo $product_price;?>','sub_total<?php echo $qtemplate_product->product_id;?>');"></td><td><input type="text" name="product_price[]" id="product_price" value="<?php echo $product_price;?>" class="form-control" readOnly></td><td><input type="text" name="taxes[]" id="taxes<?php echo $qtemplate_product->product_id;?>" value="<?php echo number_format($qtemplate_product->quantity*$product_price*config('sales_tax')/100,2,'.',' ');?>" class="form-control" readonly></td><td><input type="text" name="sub_total[]" id="sub_total<?php echo $qtemplate_product->product_id;?>" value="<?php echo number_format($product_price*$qtemplate_product->quantity,2,'.',' ');?>" class="form-control" readOnly></td><td><a href="javascript:void(0)" class="delete btn btn-sm btn-danger" onclick="delete_product(<?php echo $qtemplate_product->id;?>)"><i class="icons-office-52"></i></a></td></tr>
									                      <?php } ?>
					 									<?php } ?> 