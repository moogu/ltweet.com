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
    			<h1 class="info-title">Disclaimer</h1>
	             <div class="info-text">
	            	Ltweet is an application that makes use of the Twitter API. This
                    service is provided for your use completely free of charge. 
                    <br /><br />
                    No tweets are ever stored on our servers. We are a gateway for you
                    to use your Twitter account with the enhancement Ltweet
                    provides.
	            </div>   
        	</div>
        	<div style="clear:both;height:30px;"></div>
        </div>
	</body>
</html>
