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
	                <li><a class="logout" href='./index.php?logout=1'>Logout</a></li>
	            </ul>
	        </div>
		<?php 
		}
		
		public function rightColumn($content, $flws){
		?>
			<div id="right">    			
    			
    			<?php
    				echo '<img src="'.$content->profile_image_url.'" width="30" height="30" /> '.$content->name.'<br /><br />';
    				echo '<span class="profile-label">Description:</span> <p>'.$content->description.'</p><br />';
    				echo '<span class="profile-label">Last Tweet:</span> <p>'.$content->status->text.'</p><br />';
                    echo '<span class="profile-label">Followers:</span><br /><br />';                    
    
    				$i = 0;
    				foreach($flws as $flw)
    				{
    					if($i < 5){
    						echo '<img src="'.$flw->profile_image_url.'" width="25" height="25" /> '.$flw->screen_name.'<br />';
    						$i++;
    					}
    				}
    				    				
    			?>
                
                <!-- Google Ads -->
                <br />
                <img src="images/ads.png" />
                
    		</div>
		<?php 
		}
	
	
	}

?>