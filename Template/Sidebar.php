       <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>
        
        <div class="collapseBtn leftbar">
             <a href="#" class="tipR" title="Hide sidebar"><span class="icon12 minia-icon-layout"></span></a>
        </div>

        <div id="sidebarbg"></div>
        <div id="sidebar">

            <div class="shortcuts">
                <ul>
                    <li><a href="DashBoard" title="DashBoard" class="tip"><span class="icon24 icomoon-icon-home-7"></span></a></li>
					
                    <li><a href="Circular" title="Reminders" class="tip"><span class="icon24 icomoon-icon-support"></span></a></li>
                    <li><a href="Calendar" title="Calendar" class="tip"><span class="icon24 brocco-icon-calendar"></span></a></li>
                </ul>
            </div> 
            <div class="sidenav">
				
                <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                    <h5 class="title" style="margin-bottom:0"><?php echo Translate('Navigation'); ?></h5>
                </div>
				
                <div class="mainnav">
                    <ul>
					<?php if(!is_numeric($USERTYPEID) && ($USERTYPEID=="Parents" || $USERTYPEID=="Student")) { ?>
					<li><a href="Payment" id="PaymentLink"><span class="icon16 icomoon-icon-target "></span><?php echo Translate('Fee Payment'); ?></a></li>
                    <?php } else { ?>
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-bus"></span><?php echo Translate('Plant & Machinery'); ?></a>
                            <ul class="sub">
                               <li><a href="DR/Receiving" id="PaymentLink"><span class="icon16 entypo-icon-user"></span><?php echo Translate('Drivers/operators'); ?></a></li>
                               
                              
                                <li><a href="Call" id="AdmissionLink"><span class="icon16 icomoon-icon-truck"></span><?php echo Translate('Machinery Records'); ?></a></li>
                                
                                
                            </ul>
                        </li>

                       
                        <li>
                            <a href="#"><span class="icon16 icomoon-icon-target"></span><?php echo Translate('Fuel management '); ?></a>
                            <ul class="sub">
								<li><a href="Expense" id="ExpenseLink"><span class="icon16 icomoon-icon-arrow-last "></span><?php echo Translate(' Record usage'); ?></a></li>
								<li><a href="Income" id="IncomeLink"><span class="icon16 icomoon-icon-arrow-first "></span><?php echo Translate(' Record supply'); ?></a></li>
							</ul>
						</li>
						 <li><a href="OCall"><span class="icon16 icomoon-icon-pencil"></span><?php echo Translate('Delivery Notes'); ?></a></li>
                              <li><a href="Supplier" id=""><span class="icon16 icomoon-icon-user-4"></span><?php echo Translate('Suppliers'); ?></a></li>

  
                                   <li><a href="Complaint"><span class="icon16 icomoon-icon-tag-3"></span><?php echo Translate('Oils & Spare Parts'); ?></a></li>   

                         <li>
                            <a href="#"><span class="icon16 icomoon-icon-books"></span><?php echo Translate('Store Keeping'); ?></a>
                            <ul class="sub">
                         
                                <li><a href="ManageStock" id="StockLink"><span class="icon16 cut-icon-cart "></span><?php echo Translate('Manage items'); ?></a></li>           
                                <li><a href="StockTransfer" id="StockTransferLink"><span class="icon16 icomoon-icon-cart-4 "></span><?php echo Translate('Issue Records'); ?></a></li>             
                                 
                               
                                <li><a href="Purchase" id="PurchaseLink"><span class="icon16 minia-icon-cart "></span><?php echo Translate('Record Supply'); ?></a></li> 
                               
                                <li><a href="#" ><span class="icon16 icomoon-icon-cube"></span><?php echo Translate('Reports'); ?></a>
                                     <ul class="sub">
                                        <li><a href="StockReport"><span class="icon16 icomoon-icon-arrow-right-2"></span><?php echo Translate('Daily Item Report'); ?></a></li>
                                      
                                      
                                        <li><a href="PurchaseReport"><span class="icon16 icomoon-icon-arrow-right-2"></span><?php echo Translate('Item supply Report'); ?></a></li>
                                    </ul>                               
                                </li>
                            </ul>
                        </li>
                       
                       
                       
                        
                      
                       
						

  <li>
                            <a href="#"><span class="icon16 icomoon-icon-mail-3 "></span><?php echo Translate('Messages'); ?></a>
                            <ul class="sub">
                              
                                <li><a href="https://toddyengineering.co.ke/webmail" target= "_blank"><span class="icon16 icomoon-icon-pencil"></span><?php echo Translate(' Compose'); ?></a></li>
                                <li><a href="https://toddyengineering.co.ke/webmail" target= "_blank"><span class="icon16 icomoon-icon-arrow-right-5"></span><?php echo Translate('Inbox'); ?></a></li>
                                <li><a href="https://toddyengineering.co.ke/webmail" target= "_blank"><span class="icon16 icomoon-icon-arrow-left-5"></span><?php echo Translate('Outbox'); ?></a></li>
                            </ul>
                        </li>
     
                    <?php } ?>
					</ul>
                </div>
            </div>
        </div>
		<div class="modal fade" id="myModal"></div>