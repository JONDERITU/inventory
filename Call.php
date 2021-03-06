<?php
$PageName="Call";
$FormRequired=1;
$TableRequired=1;
$TooltipRequired=1;
$SearchRequired=1;
include("Include.php");
IsLoggedIn();
include("Template/HTML.php");
?>    

<?php
include("Template/Header.php");
?>

<?php
include("Template/Sidebar.php");
?>

        <div id="content" class="clearfix">
            <div class="contentwrapper">
                <?php $BreadCumb="Machinery Records"; BreadCumb($BreadCumb); ?>
				<?php DisplayNotification(); ?>
				<?php
				$Action=isset($_GET['Action']) ? $_GET['Action'] : '';
				$CId=isset($_GET['CallId']) ? $_GET['CallId'] : '';
				$ButtonContentSet=$ButtonContent=$AddButton=$UpdateCallId=$Name=$FollowUpDate=$Mobile=$Landline=$CallResponse=$NoOfChild=$DOC=$Remarks=$Address=$ResponseDetail=$count1="";
				if($CId!="")
				{
					$query1="select * from calling where CallId='$CId' and CallStatus='Active' ";
					$check1=mysqli_query($CONNECTION,$query1);
					$count1=mysqli_num_rows($check1);
					if($count1>0 && $Action=="Update")
					{
						$row1=mysqli_fetch_array($check1);
						$Name=$row1['Name'];
						$Mobile=$row1['Mobile'];
						$Landline=$row1['Landline'];
						$CallResponse=$row1['CallResponse'];
						$NoOfChild=$row1['NoOfChild'];
						$ResponseDetail=br2nl($row1['ResponseDetail']);
						$Address=br2nl($row1['Address']);
						$Remarks=br2nl($row1['Remarks']);
						$DOC=date("d-m-Y H:i",$row1['DOC']);
						$FollowUpDate=$row1['FollowUpDate'];
						if($FollowUpDate!="")
						$FollowUpDate=date("d-m-Y H:i",$FollowUpDate);
						$ButtonContent="Update";
						$ButtonContentSet=1;
						$AddButton="Update <a href=Call><span class=\"cut-icon-plus-2 addbutton\"> Add</span></a>";
						$UpdateCallId=$CId;
					}
					elseif($count1>0 && $Action=="Delete")
					{
						$row1=mysqli_fetch_array($check1);
						$DeleteCallName=$row1['Name'];	
					}
				}
				if($ButtonContentSet!=1)
				{
					$ButtonContent="Add";
					$AddButton="Add plant and Machinery	";
				}
				?>
				
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box chart gradient">
                            <div class="title">
                                <h4>
                                    <span><?php echo $AddButton; ?></span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>				
							<div class="content" style="width:98%; margin-bottom:10px; float:left; clear:both; ">
								<form class="form-horizontal" action="Action" name="ManageCall" id="ManageCall" method="Post">
									<div class="span4">
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
												<label class="form-label span4" for="CallResponse">Machinery Type </label> 
													<div class="span8 controls sel">   
														<?php
														GetCategoryValue('EnquiryResponse','CallResponse',$CallResponse,'','','','',1,'');
														?>
													</div> 
												</div>
											</div> 
										</div>
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="Name">Registration Number</label>
													<input tabindex="2" class="span8" id="Name" type="text" name="Name" value="<?php echo $Name; ?>" />
												</div>
											</div>
										</div>
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="DOC">Date of purchase</label>
													<input tabindex="3" class="span8" type="text" name="DOC" id="DOC" value="<?php echo $DOC; ?>" readonly />
												</div>
											</div>
										</div>
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="NoOfChild" readonly>Years of service</label>
													<input tabindex="4" class="span8" id="NoOfChild" type="text" name="NoOfChild" value="<?php echo $NoOfChild; ?>" />
												</div>
											</div>
										</div>
									</div>
									<div class="span4">
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="Mobile">Driver Contacts</label>
													<input tabindex="5" class="span8" id="Mobile" type="text" name="Mobile" value="<?php echo $Mobile; ?>" />
												</div>
											</div>
										</div>
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="Landline" readonly>Driver</label>
													<input tabindex="6" class="span8" id="Address" type="text" name="Address" value="<?php echo $Landline; ?>" />
												</div>
											</div>
										</div>
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="Address" readonly>Condition</label>
													<div class="span8 controls-textarea">
													<textarea tabindex="7" id="Address" name="Address" class="span12"><?php echo $Address; ?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="span4">
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="FollowUpDate">Date Added</label>
													<input tabindex="8" class="span8" type="text" name="FollowUpDate" id="FollowUpDate" value="<?php echo $FollowUpDate; ?>" readonly />
												</div>
											</div>
										</div>
										<div class="form-row row-fluid">
											<div class="span12">
												<div class="row-fluid">
													<label class="form-label span4" for="ResponseDetail" readonly> Added by</label>
													<div class="span8 controls-textarea">
													<textarea tabindex="9" id="ResponseDetail" name="ResponseDetail" class="span12"><?php echo $ResponseDetail; ?></textarea>
													</div>
												</div>
											</div>
										</div>
										<input type="hidden" name="RandomNumber" value="<?php echo $TOKEN; ?>" readonly>
										<?php if($count1>0) { echo "<input type=\"hidden\" name=\"CallId\" value=\"$UpdateCallId\" readonly>"; } ?>
											<input type="hidden" name="Action" value="ManageCall" readonly>
										   <?php ActionButton($ButtonContent,10); ?>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">	
					<div class="span12">
					<?php
					if($Action=="Delete" && $count1>0)
					{
					$CallCount=0;
						$query2="select Count(FollowUpId) from followup where FollowUpUniqueId='$CId' and FollowUpStatus='Active' and FollowUpType='Call'";
						
						$check2=mysqli_query($CONNECTION,$query2);
						while($row2=mysqli_fetch_array($check2))
						$CallCount+=$row2['Count(FollowUpId)'];
					?>
						<div class="box gradient">
							<div class="title">
								<h4>
									<span>Delete this vehicle, Registration Number "<?php echo $DeleteCallName; ?>" ??</span>
								</h4>
								<br><a href="#" class="minimize tip" title="Minimize">Minimize</a>
							</div>
							<div class="content noPad clearfix">
							<?php if($CallCount>0) { ?>
								<div class="alert alert-error">This record has some insurance follow ups. Delete them first!!</div>
							<?php } else { ?>
								<form class="form-horizontal" action="ActionDelete" name="DeleteCall" id="DeleteCall" method="Post">
									<br><div class="alert alert-error">You will require an admin password to perform this operation</div>
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
												<label class="form-label span4" for="normal">Password</label>
												<input tabindex="21" class="span8" type="password" name="Password" id="Password" placeholder="Password" />
											</div>
										</div>
									</div>
									<input type="hidden" name="RandomNumber" value="<?php echo $TOKEN; ?>" readonly>
									<input type="hidden" name="Action" value="DeleteCall" readonly />
									<input type="hidden" name="CallId" value="<?php echo $CId; ?>" readonly />
									<?php SetDeleteButton(22); ?>
								</form>
							<?php } ?>
							</div>
						</div>
					<?php
					}
					$query="select * from calling,masterentry where calling.CallResponse=masterentry.MasterEntryId and calling.CallStatus='Active' order by DOC";
					$result=mysqli_query($CONNECTION,$query);
					$count=mysqli_num_rows($result);
					$DATA=array();
					$QA=array();
					$PrintCall3="";
					while($row=mysqli_fetch_array($result))
					{
						$CallId=$row['CallId'];	
						$NoOfChild=$row['NoOfChild'];
						$Name=$row['Name'];	
						$Mobile=$row['Mobile'];	
						$CallResponse=$row['MasterEntryValue'];
						$Tag="<b>$CallResponse</b>";
						$FollowUpDate=$row['FollowUpDate'];
						$Date=date("d M Y,h:ia",$row['DOC']);
						if($FollowUpDate!="")
						$FollowUp="<a href=FollowUp/Call/$CallId><span class=\"brocco-icon-phone tip\" title=\"Follow Up\"></span></a>";
						else
						$FollowUp="";
						if($FollowUpDate!="")
						$FollowUpDate=date("d M Y,h:ia",$FollowUpDate);
						else
						$FollowUpDate="No";
						$Edit="<a href=Call/Update/$CallId><span class=\"icon-edit tip\" title=\"Update\"></span></a>";
						$ActionConfirmMessage="Are you sure want to delete?";
						$ActionConfirm=ActionConfirm($ActionConfirmMessage);
						$Delete="<a href=Call/Delete/$CallId><span class=\"icomoon-icon-cancel tip\" title=\"Delete\"></span></a>";
						$Note="<a href=\"Note/Call/$CallId\" data-toggle=\"modal\" data-target=\"#myModal\"><span class=\"silk-icon-notes\"></span></a>";
						$QA[]=array($Name,$Mobile,$NoOfChild,$Date,$FollowUpDate,$FollowUp,$Edit,$Delete);
						$PrintCall3.="<tr class=\"odd gradeX\">
								<td>$Name ($Tag)</td>
								<td>$Mobile</td>
								<td>$NoOfChild</td>
								<td>$Date</td>
								<td>$FollowUpDate</td>
							</tr>";
					}
					$DATA['aaData']=$QA;
					$fp = fopen('plugins/Data/data1.txt', 'w');
					fwrite($fp, json_encode($DATA));
					fclose($fp);	
					?>
						<div class="box gradient">
							<div class="title">
								<h4>
									<span>List of Plants and machinery</span>
									<?php if($count>0) { ?>
									<div class="PrintClass">
										<form method=post action=Print target=_blank>
										<input type="hidden" name="Action" value="Print" readonly>
										<input type="hidden" name="PrintCategory" value="PrintCategory" readonly>
										<input type="hidden" name="SessionName" value="PrintCallList" readonly>
										<input type="hidden" name="HeadingName" value="PrintCallHeading" readonly>
										<button class="icomoon-icon-printer-2 tip" title="Print Call List"></button>
										</form>
									</div>
									<?php } ?>
								</h4>
							<a href="#" class="minimize">Minimize</a>
							</div>
							<div class="content noPad clearfix">
							<?php
								$PrintCall1="<table id=\"CallingTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"responsive dynamicTable display table table-bordered\" width=\"100%\">
									<thead>
										<tr>
											<th>Registration Number	</th>
											<th>Driver Contacts	</th>
											<th>Years of service</th>
											<th>Purchase date</th>
											<th>Date Added</th>";
											echo $PrintCall1;
											echo "<th><span class=\"brocco-icon-phone tip\" title=\"Insurance\"></span></th>
											<th><span class=\"icon-edit tip\" title=\"Update\"></span></th>
											<th><span class=\"icomoon-icon-cancel tip\" title=\"Delete\"></span></th>";
											$PrintCall2="</tr>
									</thead>
									<tbody>";
									echo $PrintCall2;
									$PrintCall4="</tbody>
								</table>";
								echo $PrintCall4;
								$PrintCallList="$PrintCall1 $PrintCall2 $PrintCall3 $PrintCall4";
								$_SESSION['PrintCallList']=$PrintCallList;
								$PrintCallHeading="List of plants and Machinery	";
								$_SESSION['PrintCallHeading']=$PrintCallHeading;
								$_SESSION['PrintCategory']="Call";
							?>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
 	
<script type="text/javascript">
	$(document).ready(function() {	
		$('#CallingTable').dataTable({
			"sPaginationType": "two_button",
			"bJQueryUI": false,
			"bAutoWidth": false,
			"bLengthChange": false,  
			"bProcessing": true,
			"bDeferRender": true,
			"sAjaxSource": "plugins/Data/data1.txt",
			"fnInitComplete": function(oSettings, json) {
			  $('.dataTables_filter>label>input').attr('id', 'search');
			}
		});	
		$("#CallResponse").select2();
		if($('#DOC').length) {
		$('#DOC').datetimepicker({ yearRange: "-10:+10", dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true });
		}
		if($('#FollowUpDate').length) {
		$('#FollowUpDate').datetimepicker({ yearRange: "-10:+10",dateFormat: 'dd-mm-yy',changeMonth: true, changeYear: true });
		}
		$("input, textarea, select").not('.nostyle').uniform();
		$('#CallResponse').select2({placeholder: "Select"});
		$("#ManageCall").validate({
			ignore: 'input[type="hidden"]',
			rules: {
				NoOfChild: {
					remote: "RemoteValidation?Action=IsNumeric&Id=NoOfChild"
				},
				Name: {
					required: true,
				},
				CallResponse: {
					required: true,
				},
				Mobile: {
					remote: "RemoteValidation?Action=MobileValidation&Id=Mobile"
				},
				Landline: {
					remote: "RemoteValidation?Action=LandlineValidation&Id=Landline"
				},
				ResponseDetail: {
					required: true,
				},
				DOC: {
					required: true,
				}
			},
			messages: {
				NoOfChild: {
					remote: jQuery.format("Only numeric allowed!!"),
				},
				Name: {
					required: "Please enter Name!!",
				},
				CallResponse: {
					required: "Please select Response!!",
				},
				Mobile: {
					remote: jQuery.format("Mobile should be <?php echo $MOBILENUMBERDIGIT; ?> digit Numeric!!"),
				},
				Landline: {
					remote: jQuery.format("Landline Should be <?php echo $LANDLINENUMBERDIGIT; ?> digit Numeric!!"),
				},
				ResponseDetail: {
					required: "Please enter Response!!",
				},
				DOC: {
					required: "Please enter Date and Time!!",
				}
			}   
		});
		$("#DeleteCall").validate({
			rules: {
				Password: {
					required: true,
				}
			},
			messages: {
				Password: {
					required: "Please enter this!!",
				}
			}   
		});
	});
</script>   
<?php
include("Template/Footer.php");
?>