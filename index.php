<?php
session_start();

require_once('clsTwitterDB.php');
require_once('twitteroauth/twitteroauth.php');

$is_logged = true;

if(@$_GET['logout'])
{
	session_destroy();
    $is_logged = false;
}

/* Verifying token */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
	$is_logged = false;
}else{

    /* Get session token. */
    $access_token = $_SESSION['access_token'];
    
    /* Creating OAuth object. */
    $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    
    /* User credentials by twitter API */
    $content = $connection->get('account/verify_credentials');
    
    /* Get followers. */
    $flws = $connection->get('statuses/followers');
    
    //return current user timeline
    $timeline = $connection->get('statuses/home_timeline', array('screen_name' => $content->screen_name));
    
    if($_POST)
    {//If tweet has posted
    
    	$tw = new clsTwitterDB();
    	$tw->setText($_POST['tw_text']);
    	$tw->setAuthor($content->screen_name);
    	$tw->split();
    	$tw_text = $tw->tweet();
    	
    	for($i = count($tw_text)-1 ; $i >= 0; $i--){
    		if($tw_text[$i] != '')
    		{
    			$connection->post('statuses/update', array('status'=>$tw_text[$i]));
    		}
    	
    	}
    	    	
    	//Redirect again, to display in time line the last tweet
    	
    	 header( 'Location: index.php' ) ;
    }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>.:: Welcome to ltweet.com ::.</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">

		<link rel="stylesheet" href="css/default.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
		function count_char()
		{
			rs = false;
			var text = new String($("#tw_text").val());
			var len = 675 - text.length;
			var total_tweets;

			total_tweets = Math.ceil(text.length/140);
			
			if(len >= 0)
			{				
				$("#tw_count").html(len + ' [' + total_tweets + '/5]');
				rs = true;
			}
			else
			{
				//Stop to add text
				text = text.slice(0,675);
				$("#tw_text").val(text);
			}
			return rs;
		}
		</script>
	</head>
	<body>
    

<?php

    if(!$is_logged){
    //Showing login page
        
?>
        <div id="welcome-text">
            Welcome to ltweet.com <br /> Please login with your twitter account, <br /> and then you can start
            to send biggers tweets <br />(675 characters per tweet). 
        </div>
        
        <div id="login-button" >
            <a href="./redirect.php"><img src="./images/lighter.png" alt="Sign in with Twitter" border="0" /></a>
        </div>
        
<?php
    }else{
    	//Showing applications page
?>
        <div id="menu-container">
            <ul>
                <li><a class="current" href="index.php">Home</a></li>
                <li><a href="contact.php">Contact us</a></li>
                <li><a class="logout" href='./index.php?logout=1'>Logout</a></li>
            </ul>
        </div>
        
        <div id="main-container">
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
    		<div id="left">
    			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    				<div id="tw_tag">
    				What's Happening
    				</div>
    				<div id="tw_count">
    				675 [1/5]
    				</div>
    				<br />
    				<textarea name="tw_text" id="tw_text" cols="100" rows="7" maxlength="675" onkeyup="count_char();"></textarea><br />
    				<input type="submit" name="btn_sign" id="tweet-button" value="Tweet" />
    			</form>
                <div id="time-line">
        			<span>Home timeline:</span> 
                    
        			<?php                    
        				foreach($timeline as $tw)
        				{
        					echo '<div><img src="'.$tw->user->profile_image_url.'" /> '.$tw->text.'</div>';
        				}
        			?>
        		</div>
    		</div>
    		<?php } ?>
        </div>
	</body>
</html>