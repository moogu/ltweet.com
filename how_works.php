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
    			<h1 class="info-title">How it works</h1>
	             <div class="info-text">
	            	What do people often do when they want put up longer text on
                    twitter? They go write a long post, put it online somewhere and
                    use a URL shortening service, so they can write at least a few
                    words alongside the link as an intro in their tweet.<br /><br />
                    
                    The problem? People are sick of having to navigate away from
                    twitter throughout the day just to read people&#39;s &quot;tweets&quot;. They
                    rarely click though anymore.<br /><br />
                    
                    The solution? Simply spread out your post over a few tweets.
                    Ltweet is a service that allows you to put in up to 5 messages
                    worth of text, or 700 characters, and it will automatically break
                    them up and post them to twitter for you.<br /><br />
                     
                    You don&#39;t have to sit
                    and try to keep your train of thought as you press the &quot;tweet&quot;
                    button and wait for it to load so you can continue writing. Just do
                    what you do best, write what&#39;s on your mind, and leave the rest to
                    us!
	            </div>   
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
