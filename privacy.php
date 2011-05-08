<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>.:: Welcome to ltweet.com ::.</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">

		<link rel="stylesheet" href="css/default.css" type="text/css" />		
		
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
    
        <?php //Showing applications page
	    	include_once('common_design.php');
	    	
	    	$common_design = new commonDesign();
    	
    	?>
    	
        <!-- Main Menu  -->
        <?php echo $common_design->topMenu() ?>
        
        <div id="main-container">
    		
			<!-- Right Column -->
        	<?php echo $common_design->rightColumn(false, false) ?>
    		
    		<div id="left">
	            <h1 class="info-title">Privacy Policy</h1>
	            <div class="info-text">
                    <strong>Your privacy is our primary concern.</strong>
                    <br /><br />
                    Under absolutely no circumstances will any of the personal
                    information you provide to us, including your name, username, or
                    email address, be sold, rented, or otherwise handed out to any
                    third-party group or individual outside of our organization.
                    <br /><br />
                    We cannot be responsible for the content or site policies of
                    twitter.com or any other Internet site external to this one. You are
                    advised to thoroughly read the privacy policy and terms of use for
                    all external sites before disclosing any of your personal
                    information.
                    <br /><br />
                    This site uses cookies. A &quot;cookie&quot; is a string of text that is
                    associated with your computer for a session and saved by your
                    browser. It allows us to recognize you and serve up personalised
                    content each time you visit. This includes things like allowing you
                    to use the site over a number of visits without having to log-in
                    each time. Cookies themselves do not contain any personal
                    information about you at all. They are simply a way for our site to
                    recognize your computer. Cookies may also be used by 3rd party
                    content providers such as news feeds.
	            </div>
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
