        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content">
          <div class="header">
            <h2><strong><?php echo $customer->name;?></strong></h2>
            <div class="breadcrumb-wrapper">               
			    		 
            </div>              
           </div>
           <div class="row">
                        <div class="col-md-12">
                            <h3><strong>Cash</strong> information</h3>
                            <div class="widget-cash-in-hand">
                                <div class="cash">
                                    <div class="number c-primary">$<?php echo $total_sales;?></div>
                                    <div class="txt">TOAL SALES</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-green">$<?php echo $open_invoices;?></div>
                                    <div class="txt">open invoices</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-red">$<?php echo $overdue_invoices;?></div>
                                    <div class="txt">overdue invoices</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-blue">$<?php echo $paid_invoices;?></div>
                                    <div class="txt">paid invoices</div>
                                </div>
                                <div class="cash">
                                    <div class="number c-blue">$<?php echo $quotations_total;?></div>
                                    <div class="txt">quotations total</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h3 class="m-t-30 m-b-20"><strong>customer activities</strong></h3>
                            <div class="widget-infobox">
                                 
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-user bg-yellow"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-yellow pull-left"><?php echo $meetings;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">MEETINGS</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-tag bg-orange"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-orange pull-left"><?php echo $quotations;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">QUOTATIONS</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="infobox">
                                    <div class="left">
                                        <i class="fa fa-shopping-cart bg-blue"></i>
                                    </div>
                                    <div class="right">
                                        <div>
                                            <span class="c-primary pull-left"><?php echo $salesorder;?></span>
                                            <br>
                                        </div>
                                        <div class="txt">SALES ORDERS</div>
                                    </div>
                                </div>
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-note bg-purple"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-purple pull-left"><?php echo $invoices;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">INVOICES</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="infobox">
                                    <div class="left">
                                        <i class="icon-hourglass bg-dark"></i>
                                    </div>
                                    <div class="right">
                                        <div class="clearfix">
                                            <div>
                                                <span class="c-dark pull-left"><?php echo $contracts;?></span>
                                                <br>
                                            </div>
                                            <div class="txt">CONTRACTS</div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
         
        </div>
        <!-- END PAGE CONTENT -->
      