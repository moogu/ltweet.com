<?php

$alert_text = '';

$name = '';
$email = '';
$subject = '';
$msg = '';

if( $_POST ){

	require_once('clsTwitterDB.php');
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
		  
		  	if (@mail($contact_email, $subject, $msg, "FROM: $email\n")){
				$alert_text = "Thanks for sending us your comments, we're going to answer you soon! ";
				$email = '';
				$subject = '';
				$msg = '';
			}else{
				$alert_text = "Oh no! There was an error, please try sending your comments again ";
			}
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
			$(function(){				
				$('#name').val('<?php echo $name ?>');
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
        	<?php echo $common_design->rightColumn(false, false) ?>
			
    		<div id="left">
                <h1 class="info-title">Contact Us</h1>
                <div class="info-text">
                    We welcome your feedback! If you have a suggestion for how we
                    may improve the service, feel free to use the contact form below
                    to get in touch with us. We also encourage you to report any bugs
                    or glitches that you may experience when using our site. We do
                    not need to hear from you if you get the infamous twitter &quot;Fail
                    Whale&quot; when trying to use our service as that is an issue with their
                    servers not ours, but we won&#39;t get angry if you write us about it
                    anyway!
                </div>
	             <form class="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			        <table width="420" border="0">
			
			            <tr>
			                <td width="auto">
			                    <label for="name"> Name:</label>			                    
			                </td>
			                <td width="auto">
			                    <input name="name" id="name" type="text" size="37" class="txt" />
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
