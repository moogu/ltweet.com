<?php
session_start();

require_once('clsTwitterDB.php');
require_once('twitteroauth/twitteroauth.php');

/* Verifying token */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
	
	$is_logged = false;
	
}else{
	
	$is_logged = true;
	
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
			$(function(){				
				$('#email').val('<?php echo $email ?>');
				$('#subject').val('<?php echo $subject ?>');
				$('#message').val('<?php echo $msg ?>');
			});
			
		</script>
	</head>
	<body>
    
        <?php //Showing applications page
	    	include_once('common_design.php');
	    	
	    	$common_design = new commonDesign();
    	
    	?>
    	
        <!-- Main Menu  -->
        <?php echo $common_design->topMenu() ?>
        
        <div id="main-container">
    		
    		<!-- Right Column -->
        	<?php echo $common_design->rightColumn($content, $flws) ?>
    		
    		<div id="left">
    			<h1 class="info-title">Disclaimer</h1>
	             <div class="info-text">
	            	ltweet is an application that uses Twitter API. It is free of charge. <br/>
                    We don't keep the tweets from the user.</br>
	            </div>   
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
