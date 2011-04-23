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
<b>We respect your privacy</b><br/>
Any personal information you provide to us including and similar to your name, username and e-mail address will
not be released, sold, or rented to any entities or individuals outside of our organization.<br/><br/>
<b>External Sites.</b><br/>
We are not responsible for the content of external internet sites. You are advised to read the privacy policy of external sites before disclosing any personal information.<br/><br/>
<b>Cookies</b><br/>
A "cookie" is a small data text file that is placed in your browser and allows us to recognize you each time you visit this site (personalization, etc). Cookies themselves do not contain any personal information, and we do not use cookies to collect personal information. Cookies may also be used by 3rd party content providers such as newsfeeds.
	            </div>
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
