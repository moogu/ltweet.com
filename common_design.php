<?php 
	
	Class commonDesign{
		
		public function topMenu(){
			
			$current_page = explode('/',$_SERVER['PHP_SELF']);
			$current_page = $current_page[count($current_page) - 1 ];
			$class[$current_page] = 'current';
    				
		?>
			<div id="menu-container">
	            <ul>
	                <li><img id="logo-menu" src="images/logo-mini.png" /></li>                
	                <li><a class="<?php echo $class['index.php'] ?>" href="index.php">Home</a></li>
	                <li><a class="<?php echo $class['how_works.php'] ?>" href="how_works.php">How it works</a></li>
	                <li><a class="<?php echo $class['privacy.php'] ?>" href="privacy.php">Privacy</a></li>
	                <li><a class="<?php echo $class['disclaimer.php'] ?>" href="disclaimer.php">Disclaimer</a></li>
	                <li><a class="<?php echo $class['contact.php'] ?>" href="contact.php">Contacts</a></li>
	                <?php if(@!empty($_SESSION['access_token'])){?>
	                	<li><a class="logout" href='./index.php?logout=1'>Logout</a></li>
	                <?php } ?>
	            </ul>
	        </div>
		<?php 
		}
		
		public function rightColumn($content, $flws, $show_twitter=false){			
    			
			if(@!empty($_SESSION['access_token']) && $show_twitter){	
				echo '<div id="right">';
				echo '<img src="'.$content->profile_image_url.'" width="30" height="30" /> '.$content->name.'<br /><br />';
				echo '<span class="profile-label">Description:</span> <p>'.$content->description.'</p><br />';
				echo '<span class="profile-label">Last Tweet:</span> <p>'.$content->status->text.'</p><br />';
				
				if(@$flws){
					echo '<span class="profile-label">Followers:</span><br /><br />';                    
	
					$i = 0;
					foreach($flws as $flw)
					{
						if($i < 5){
							echo '<img src="'.$flw->profile_image_url.'" width="25" height="25" /> '.$flw->screen_name.'<br />';
							$i++;
						}
					}
				}
				//<!-- Google Ads -->
                echo '<br />';                
                echo '<script type="text/javascript">
                            <!--
                            google_ad_client = "ca-pub-6070355393344861";
                            /* 336x280, created 5/9/11 */
                            google_ad_slot = "4452831746";
                            google_ad_width = 336;
                            google_ad_height = 280;
                            //-->
                        </script>
                            <script type="text/javascript"
                            src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                        </script>';		
				echo '<br />';
				echo '</div>';
			}else{
				echo '<style type="text/css">';
				echo '	#left{margin-left: 170px}';
				echo '	#menu-container ul{width: 600px}';
				echo '</style>';
			}	
			
		}
	
	
	}

?>