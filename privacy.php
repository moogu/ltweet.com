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
	            <h1 class="info-title">Privacy</h1>
	            <div class="info-text">
	            	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a nunc turpis. Nulla id sodales orci. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
	            	<br/><br/>Maecenas enim mauris, semper sit amet pharetra sed, fermentum in tortor. Proin in tellus sit amet tellus interdum vestibulum sed in turpis. Quisque quam diam, volutpat in tincidunt consequat, dignissim at quam. Nulla ac magna nibh. 
	            	<br/><br/>Sed tellus risus, varius ac imperdiet vitae, tristique eget quam. Phasellus euismod, nulla sed dignissim molestie, metus ligula pharetra orci, non tincidunt est lorem volutpat lacus. Sed gravida dictum tellus, at convallis massa eleifend eget. Duis bibendum quam mattis felis tincidunt id dignissim sem tempus. 
	            	<br/><br/>In laoreet felis porta nisi interdum commodo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin ut elit in mi semper ullamcorper. Phasellus justo urna, laoreet a sodales ut, suscipit nec magna. Pellentesque condimentum sodales nulla ac vulputate. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc interdum commodo mi vitae tincidunt.
					<br/><br/>Sed id augue dui. Praesent sollicitudin felis dignissim arcu fermentum euismod. Nunc consectetur venenatis risus, dictum pretium est feugiat non. Nulla turpis purus, scelerisque at iaculis sed, dapibus at justo. Ut id sapien vel turpis feugiat posuere. Nullam eu massa vel nunc gravida faucibus. Pellentesque eu lacus nec leo mollis cursus. Nulla a risus ligula, quis suscipit arcu. In metus lacus, vulputate quis bibendum sit amet, molestie eu purus. Sed id metus vel neque convallis lacinia. In faucibus, felis ut pulvinar consequat, nibh est tristique quam, in fringilla tortor nunc fermentum metus. Aliquam at tellus massa, vitae tempor nisl. Fusce in tempus nulla. Sed dignissim arcu nec lectus porta sodales.
	            </div>
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
