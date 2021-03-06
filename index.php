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
<script type="text/javascript">

var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-21972831-3']);
_gaq.push(['_trackPageview']);

(function() {
 var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
 ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
 var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
 })();

</script>
	</head>
	<body>
    

<?php

    if(!$is_logged){
    //Showing login page
        
?>
		<img id="logo-index" src="images/logo.png" />
        <div id="welcome-text">
            It is a fact, people do not click through to read your long posts
            when you include shortened URL&#39;s in your tweets using sites like
            bit.ly or tinyurl.<br /><br />
            <span class="intro-text-2">
                Want to write longer tweets, that people actually read? Use
                ltweet.
            </span><br /> 
            <span class="intro-text-3">
                Simply log in with your twitter account and start tweeting longer
            messages using up to 5 tweets at once.
            </span> 
        </div>
        
        <div id="login-button" >
        	<a href="https://twitter.com/signup"><img src="images/sign-up.png" alt="Sign up on Twitter" border="0" /></a>
            <a href="./redirect.php"><img src="./images/lighter.png" alt="Sign in with Twitter" border="0" /></a>
        </div>
        
        <div id="footer">
        	<ul>
                <li><a href="how_works.php">How it works</a></li>
                <li><a href="privacy.php">Privacy</a></li>
                <li><a href="disclaimer.php">Disclaimer</a></li>
                <li><a href="contact.php">Contacts</a></li>
            </ul>
        </div>
        
<?php
    }else{
    
    	//Showing applications page
    	include_once('common_design.php');
    	
    	$common_design = new commonDesign();
    	
?>
        <!-- Main Menu  -->
        <?php echo $common_design->topMenu() ?>
                
        <div id="main-container">
        	
        	<!-- Right Column -->
        	<?php echo $common_design->rightColumn($content, $flws, true) ?>
    		
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
    		<div style="clear:both;height:30px;"></div>    		
        </div>
        <?php } ?>
	</body>
</html>