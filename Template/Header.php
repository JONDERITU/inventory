    <div id="header">
        <div class="navbar">
            <div class="navbar-inner">
              <div class="container-fluid">
                <a class="brand" href="DashBoard"><?php if($SCHOOLNAME=="") echo $APPLICATIONNAME; else echo $SCHOOLNAME; ?></a>
                <div class="nav-no-collapse">
                    <ul class="nav">
						<?php if(is_numeric($USERTYPEID)) { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="icon16 icomoon-icon-cog"></span> <?php echo Translate('Setting'); ?>
                                <b class="caret"></b>
                            </a>
							<ul class="dropdown-menu scroll" style="height:200px; overflow:auto; margin-top:10px;">
								<li><a href="GeneralSetting"><span class="icon16 icomoon-icon-cogs"></span><?php echo Translate('General Setting'); ?></a></li>
								<li><a href="MasterEntry"><span class="icon16 icomoon-icon-tools"></span><?php echo Translate('Master Entry'); ?></a></li>
								<li><a href="ManageUser"><span class="icon16 icomoon-icon-users"></span><?php echo Translate('Manage User'); ?></a></li>
								<li><a href="ManageAccounts"><span class="icon16 icomoon-icon-basket-2"></span><?php echo Translate('Manage Accounts'); ?></a></li>
							
								<li><a href="ManageLocation"><span class="icon16 icomoon-icon-home-4 "></span><?php echo Translate('Manage Location'); ?></a></li>
							
								
								<li><a href="Permission"><span class="icon16 icomoon-icon-checkmark-2"></span><?php echo Translate('Permission'); ?></a></li>
							</ul>
                        </li>
						<?php } ?>
							<?php
							$SCHOOLSESSION=isset($_SESSION['SCHOOLSESSION']) ? $_SESSION['SCHOOLSESSION'] : '';
							if($SCHOOLSESSION!="")
							{
							?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php if(!isset($CURRENTSESSION)) echo "<b>Choose Session</b>"; else echo "<b>$CURRENTSESSION</b>"; ?>
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu"> 
							
							<?php
								foreach($SCHOOLSESSION as $SchoolSession)
								{
									$_SESSION['LastPage']=CurrentPageURL();
									echo "<li><a href=\"ActionGet/SetSession/$SchoolSession\"><b>Go to $SchoolSession</b></a></li>";
								}
								?>
								</ul>
							</li>
							<?php
							}
							?>
						<?php if($ACCOUNTLIST!="" && $USERTYPE!='Parents' && $USERTYPE!='Student') { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class=""></span> Fuel Balances <b class="caret"></b></a>
                                
                            <ul class="dropdown-menu">
							<?php echo $ACCOUNTLIST; ?>
                            </ul>
                        </li>
						<?php } 
						$query103="select LanguageName,LanguageId from lang";
						$check103=mysqli_query($CONNECTION,$query103);
						$count103=mysqli_num_rows($check103);
						$ListLang=$SelectedLang="";
						if($count103>0)
						{
							while($row103=mysqli_fetch_array($check103))
							{
								$ListLanguageName=$row103['LanguageName'];
								$ListLanguageId=$row103['LanguageId'];
								if($LANGUAGE==$ListLanguageId)
								$SelectedLang=$ListLanguageName;
								$ListLang.="<li><a href=\"ActionGet/Language/$ListLanguageId\"><b>$ListLanguageName</b></a></li>";
							}
						}							
						if($SelectedLang=="")
						$SelectedLang="English";
						if($SelectedLang!="English")
						$ListLang.="<li><a href=\"ActionGet/Language/0\"><b>English</b></a></li>";
						$ListLang.="<li><a href=Language><b>Add more Language</b></a></li>";
							?>
					
						
                    </ul>
                  
                    <ul class="nav pull-right usernav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logged in as <font color="blue"><?php echo $USERNAME; ?></font>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
								<li><a href="ChangePassword"><span class="icon16 brocco-icon-key"></span>Change Password</a></li>
								<li><a href="LogOut"><span class="icon16 icomoon-icon-exit"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div id="wrapper">	