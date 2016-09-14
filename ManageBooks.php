<?php
$PageName="ManageBooks";
$TooltipRequired=1;
$SearchRequired=1;
$FormRequired=1;
$TableRequired=1;
include("Include.php");

if(!isset($_SESSION['ListBookToken']))
$Token=PasswordGenerator(30);
elseif(isset($_SESSION['ListBookToken']))
$Token=isset($_SESSION['ListBookToken']);

unset($_SESSION['ListBookToken']);
IsLoggedIn();
include("Template/HTML.php");
?>    
<script type="text/javascript">
	$(document).ready(function() {
		$('table#links td a.delete').click(function()
		{
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				var parent = $(this).parent().parent();
				$.ajax(
				{
				   type: "POST",
				   url: "/DeleteRow.php",
				   data: { id: id, Action: 'ListBook'},
				   cache: false,

				   success: function()
				   {
						parent.fadeOut('slow', function() {$(this).remove();});
				   },
				   error: function()
				   {
				   }
				 });                
			}
		});
	});
</script>
<?php
include("Template/Header.php");
?>

<?php
include("Template/Sidebar.php");
?>

        <div id="content" class="clearfix">
            <div class="contentwrapper">
                <?php $BreadCumb="Manage Assets"; BreadCumb($BreadCumb); ?>
				<?php DisplayNotification(); ?>

				<?php
				$Action=isset($_GET['Action']);
				$Id=isset($_GET['UniqueId']);
				$ListAllSubject=$ButtonContent=$ButtonContentSet=$AddButton=$UpdateBookId=$Purpose=$SubjectId=$Price=$Publisher=$AuthorName=$BookName="";
				if($Id!="")
				{
					$query1="select * from book where BookId='$Id' and BookStatus='Active' ";
					$check1=mysqli_query($CONNECTION,$query1);
					$count1=mysqli_num_rows($check1);
					if($count1>0 && $Action=="Update")
					{
						$row1=mysqli_fetch_array($check1);
						$BookName=$row1['BookName'];
						$AuthorName=$row1['AuthorName'];
						$Publisher=$row1['Publisher'];
						$Price=$row1['Price'];
						$SubjectId=$row1['SubjectId'];
						$Purpose=$row1['Purpose'];
						$ButtonContent="Update";
						$ButtonContentSet=1;
						$AddButton="Update <a href=ManageBooks><span class=\"cut-icon-plus-2 addbutton\"> Add</span></a>";
						$UpdateBookId=$Id;
					}
					elseif($count1>0 && $Action=="Delete")
					{
						$row1=mysqli_fetch_array($check1);
						$DeleteBookName=$row1['BookName'];	
					}
				}
				if($ButtonContentSet!=1)
				{
					$ButtonContent="Add";
					$AddButton="Add Asset";
				}
				
				$query2="select SubjectName,SubjectId from subject where Session='$CURRENTSESSION' and SubjectStatus='Active' ";
				$check2=mysqli_query($CONNECTION,$query2);
				$Selected="";
				while($row2=mysqli_fetch_array($check2))
				{
					$SubjectNameArray[]=$row2['SubjectName'];
					$SubjectIdArray[]=$row2['SubjectId'];
					$ComboSubjectId=$row2['SubjectId'];
					$ComboSubjectName=$row2['SubjectName'];
					if($row2['SubjectId']==$SubjectId)
					$Selected="selected";
					else
					$Selected="";
					$ListAllSubject.="<option value=\"$ComboSubjectId\" $Selected>$ComboSubjectName</option>";
				}
								
				$query3="select MasterEntryId,MasterEntryValue from masterentry where MasterEntryStatus='Active' ";
				$check3=mysqli_query($CONNECTION,$query3);
				while($row3=mysqli_fetch_array($check3))
				{
					$MasterEntryIdArray[]=$row3['MasterEntryId'];
					$MasterEntryValueArray[]=$row3['MasterEntryValue'];
				}
				
				$query5="select BookId,Count(ListBookId) as TotalBook from listbook where ListBookStatus='Active' group by BookId ";
				$check5=mysqli_query($CONNECTION,$query5);
				while($row5=mysqli_fetch_array($check5))
				{
					$CountBookIdArray[]=$row5['BookId'];
					$CountTotalBook[]=$row5['TotalBook'];
				}
				
				$query4="Select BookId,BookName,AuthorName,Publisher,Purpose,SubjectId from book where 
					BookStatus='Active'";
				$check4=mysqli_query($CONNECTION,$query4);
				$count4=mysqli_num_rows($check4);
				$DATA=array();
				$QA=array();
				$ListTotalBook=$count1=0;
				$Print3=$ListBookList=$Print2="";
				while($row4=mysqli_fetch_array($check4))
				{
					$ListBookId=$row4['BookId'];	
					$ListBookName=$row4['BookName'];
					if($CountBookIdArray!="")
					{
						$CountBookSearchIndex=array_search($ListBookId,$CountBookIdArray);
						if($CountBookSearchIndex===FALSE) { $ListTotalBook=0; }
						else { $ListTotalBook=$CountTotalBook[$CountBookSearchIndex]; }
					}
					else
					$ListTotalBook=0;
					$ListAuthorName=$row4['AuthorName'];
					$ListBookList.="<option value=\"$ListBookId\">$ListBookName ($ListAuthorName)</option>";
					$ListPublisher=$row4['Publisher'];
					$ListPurpose=$row4['Purpose'];
					$PurposeSearchIndex=array_search($ListPurpose,$MasterEntryIdArray);
					$ListPurposeName=$MasterEntryValueArray[$PurposeSearchIndex];
					$ListSubject=$row4['SubjectId'];
					if($ListSubject==0){ $ListSubjectName="";}
					else
					{
						if($SubjectIdArray!="")
						{
							$SubjectSearchIndex=array_search($ListSubject,$SubjectIdArray);
							$ListSubjectName=$SubjectNameArray[$SubjectSearchIndex];
						}
						else
						$ListSubjectName="";
					}
					$Edit="<a href=ManageBooks/Update/$ListBookId><span class=\"icon-edit tip\" title=\"Update\"></span></a>";
					$QA[]=array($ListBookName,$ListAuthorName,$ListPublisher,$ListPurposeName,$ListSubjectName,$ListTotalBook,$Edit);
					$Print3.="<tr class=\"odd gradeX\">
							<td>$ListBookName</td>
							<td>$ListAuthorName</td>
							<td>$ListPublisher</td>
							<td>$ListPurposeName</td>
							<td>$ListSubjectName</td>
							<td>$ListTotalBook</td>
						</tr>";
				}
				$DATA['aaData']=$QA;
				$fp = fopen('plugins/Data/data1.txt', 'w');
				fwrite($fp, json_encode($DATA));
				fclose($fp);
				?>
				
                <div class="row-fluid">
					<div class="span4">
                       
						
                        <div class="box calendar gradient">
                            <div class="title">
                                <h4>
                                    <span><?php echo $AddButton; ?></span>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            <div class="content noPad clearfix"> 
								<form class="form-horizontal" action="Action" name="ManageBooks" id="ManageBooks" method="Post">
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
											<label class="form-label span4" for="Subject">Asset Category</label> 
												<div class="span8 controls sel">    
												<select tabindex="1" name="SubjectId" id="SubjectId" class="nostyle" style="width:100%;" >
												<option></option>
												<?php echo $ListAllSubject; ?>
												</select>
												</div> 
											</div>
										</div> 
									</div>
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
											<label class="form-label span4" for="Purpose">Purpose</label> 
												<div class="span8 controls sel">   
													<?php
													GetCategoryValue('BookPurpose','Purpose',$Purpose,'','','','',2,'');
													?>
												</div> 
											</div>
										</div> 
									</div>
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
												<label class="form-label span4" for="BookName">Asset Name</label>
												<input tabindex="3" class="span8" id="BookName" type="text" name="BookName" value="<?php echo $BookName; ?>" />
											</div>
										</div>
									</div>
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
												<label class="form-label span4" for="AuthorName">Asset Description</label>
												<input tabindex="4" class="span8" id="AuthorName" type="text" name="AuthorName" value="<?php echo $AuthorName; ?>" />
											</div>
										</div>
									</div>
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
												<label class="form-label span4" for="Publisher">Asset Condition</label>
												<input tabindex="5" class="span8" id="Publisher" type="text" name="Publisher" value="<?php echo $Publisher; ?>" />
											</div>
										</div>
									</div>
									<div class="form-row row-fluid">
										<div class="span12">
											<div class="row-fluid">
												<label class="form-label span4" for="Price"> Asset Value</label>
												<input tabindex="6" class="span8" id="Price" type="text" name="Price" value="<?php echo $Price; ?>" />
											</div>
										</div>
									</div>
									<input type="hidden" name="Action" value="ManageBooks" readonly />
									<input type="hidden" name="RandomNumber" value="<?php echo $TOKEN; ?>" readonly>
									<?php if($count1>0) { echo "<input type=\"hidden\" name=\"BookId\" value=\"$UpdateBookId\" readonly>"; } ?>
									<?php ActionButton($ButtonContent,7); ?>	
								</form>
                            </div>
                        </div>
					</div>
					<div class="span8">
					
					
                        <div class="box calendar gradient">
                            <div class="title">
                                <h4>
                                    <span>List All Office Assets</span>
									<?php if($count4>0) { ?>
									<div class="PrintClass">
										<form method=post action=Print target=_blank>
										<input type="hidden" name="Action" value="Print" readonly>
										<input type="hidden" name="SessionName" value="PrintBookList" readonly>
										<input type="hidden" name="HeadingName" value="PrintBookHeading" readonly>
										<button class="icomoon-icon-printer-2 tip" title="Print Book List"></button>
										</form>
									</div>
									<?php } ?>
                                </h4>
                                <a href="#" class="minimize">Minimize</a>
                            </div>
                            <div class="content noPad clearfix"> 
							<?php
								$Print1="<table id=\"BookTable\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"responsive dynamicTable display table table-bordered\" width=\"100%\">
									<thead>
										<tr>
											<th>Asset Name</th>
											<th>Asset Description</th>
											<th>Asset Condition</th>
											<th>Purpose</th>
											<th>Asset Category</th>
											<th>Lost Items</th>";
											echo $Print1;
											echo "<th><span class=\"icon-edit tip\" title=\"Update\"></span></th>";
											$Print="</tr>
									</thead>
									<tbody>";
									echo $Print2;
									$Print4="</tbody>
								</table>";
								echo $Print4;
								$PrintList="$Print1 $Print2 $Print3 $Print4";
								$_SESSION['PrintBookList']=$PrintList;
								$PrintBookHeading=" List of Office Assets";
								$_SESSION['PrintBookHeading']=$PrintBookHeading;
							?>
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
		
<script type="text/javascript">
	$(document).ready(function() {
		$('#BookTable').dataTable({
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
		if($('#DOA').length) {
		$('#DOA').datetimepicker({ dateFormat: 'dd-mm-yy' });
		}	
		$("#Purpose").select2(); 
		$('#Purpose').select2({placeholder: "Select"}); 		
		$("#SubjectId").select2(); 
		$('#SubjectId').select2({placeholder: "Select"}); 		
		$("#BookId").select2(); 
		$('#BookId').select2({placeholder: "Select"}); 	
		
		$("#ManageBooks").validate({
			ignore: 'input[type="hidden"]',
			rules: {
				Purpose: {
					required: true,
				},
				BookName: {
					required: true,
				},
				Price: {
					required: true,
					remote: "RemoteValidation?Action=IsAmountWithoutZero&Id=Price"
				}
			},
			messages: {
				Purpose: {
					required: "Please select this!!",
				},
				BookName: {
					required: "Please enter this!!",
				},
				Price: {
					required: "Please enter this!!",
					remote: jQuery.format("Numeric & Greater than Zero!!"),
				}
			}   
		});			
		$("#ManageBookList").validate({
			ignore: 'input[type="hidden"]',
			rules: {
				BookId: {
					required: true,
				},
				AccessionNo: {
					required: true,
				}
			},
			messages: {
				BookId: {
					required: "Please select one!!",
				},
				AccessionNo: {
					required: "Please enter this!!",
				}
			}   
		});				
		$("#ListBookConfirm").validate({
			rules: {
				DOA: {
					required: true,
				},
				Remarks: {
					required: true,
				}
			},
			messages: {
				DOA: {
					required: "Please select date!!",
				},
				Remarks: {
					required: "Please enter remarks!!",
				}
			}   
		});	
		$('#ManageBookList').ajaxForm({
		  target: '#showdata',
		  success: function() {
			$('#showdata').fadeIn('slow');
			$('#ManageBookList').each (function(){
			this.reset();
			});
			$('#BookId').select2('open');
		  }
		});	
	});
</script>
<?php
include("Template/Footer.php");
?>