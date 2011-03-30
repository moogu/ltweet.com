<?php
session_start();

require_once('clsTwitterDB.php');
require_once('twitteroauth/twitteroauth.php');

$alert_text = 'If you have any question or want to report a bug,<br />feel free to contact us with this form';

$email = '';
$subject = '';
$msg = '';

if( $_POST ){

	//Destination email
	
	$tw = new clsTwitterDB();
	
	$contact_email = $tw->get_contact_email(); 
	 
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$msg = $_POST['message'];
	
	if ($name == '' || $email == '' || $subject == '' || $msg == ''){
		$alert_text = 'Oh no! you forgot to fill all fields, please complete them all and try again';	
	}else{
	
		$message = "
		      
			Name:  ".$nombre."	
		
		    ".$msg."";
		  
		  	if (mail($contact_email, $subject, $msg, "FROM: $email\n")){
				$alert_text = "Thanks for sending us your comments, we're going to answer you soon! ";
				$email = '';
				$subject = '';
				$msg = '';
			}else{
				$alert_text = "Oh no! There was an error, please try sending your comments again ";
			}
	}

}

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
        
        <div id="contact-text">
            <?php echo $alert_text ?> 
        </div>
        
        <div id="main-container">
    		
    		<!-- Right Column -->
        	<?php echo $common_design->rightColumn($content, $flws) ?>
    		
    		<div id="left">
	             <form class="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			        <table width="420" border="0">
			
			            <tr>
			                <td width="auto">
			                    <label for="name"> Name:</label>			                    
			                </td>
			                <td width="auto">
			                    <input name="name" id="name" type="text" size="37" class="txt" value="<?php echo $content->name ?>"/>
			                </td>
			            </tr>
			
			            <tr>
			                <td>
			                    <label for="email"> Email:</label>
			                </td>
			                <td>
			                    <input name="email" id="email" type="text" size ="37" class="txt"/>
			                </td>
			            </tr>
			
			            <tr>
			                <td>
			                    <label for="subject"> Subject:</label>
			                </td>
			                <td>
			                    <input name="subject" id="subject" type="text" size="37" class="txt"/>
			                </td>
			            </tr>
			
			            <tr>
			                <td colspan="3" align="center">
			                    <br/>
			                    <label for="message" class="comment-label">Comments</label>
			                </td>
			            </tr>
			            <tr>
			                <td colspan="3" align="center">
			                    <textarea name="message" id="message" rows="10" cols ="50" class="txt">
			                    </textarea>
			
			                </td>
			            </tr>
			            <tr>
			                <td colspan="3" align="center">
			                  <input type="submit" id="send-button" value="Send"/>
			                </td>
			            </tr>
			
			        </table>
			
			    </form>   
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
