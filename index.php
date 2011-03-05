<?php
session_start();

require_once('clsTwitterDB.php');
require_once('twitteroauth/twitteroauth.php');

if($_GET['logout'])
{
	session_destroy();
}

/* Verifying token */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
	echo '<a href="./redirect.php"><img src="./images/lighter.png" alt="Sign in with Twitter" border="0" /></a>';
	exit;
}

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
	
	foreach($tw_text as $data)
	{
		if($data != '')
		{
			$connection->post('statuses/update', array('status'=>$data));
		}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>TwittPlus - André Vasconcellos</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">

		<style>
		#tw_count{
			font-family:verdana, arial;
			color:#cccccc;
			font-weight:bolder;
			width:50%;
			float:right;
			font-size:30px;
			text-align:right;
		}
		#tw_tag{
			font-weight:bolder;
			width:50%;
			float:left;
			font-size:20px;
		}
		#left input,textarea{
			background-color:#EEE;
			border:thin solid #CCC;
		}
		#left{
			font-family:verdana, arial;
			color:#000000;
			float:left;
			height:60%;
			width:820px;
			/*border:thin solid #FCC;*/
			display:box;
			background-color:#FFF;
			padding:10px;
		}
		#right{
			font-family:verdana, arial;
			color:#000000;
			float:right;
			height:100%;
			width:300px;
			/*border:thin solid #CFC;*/
			display:box;
		}
		#bottom{
			font-family:verdana, arial;
			color:#000000;
			height:40%;
			width:820px;
			/*border:thin solid #CCF;*/
			display:box;
			float:left;
		}
		</style>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
		function count_char()
		{
			rs = false;
			var text = new String($("#tw_text").val());
			var len = 675 - text.length;
			
			if(len >= 0)
			{
				$("#tw_count").html(len);
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
	<body bgcolor="#CCCCFF">
		<div id="right">
			<p><a href='./index.php?logout=1'>Logout</a></p>
			Userdata:<br />
			<?php
				echo '<img src="'.$content->profile_image_url.'" width="25" height="25" /> '.$content->name.'<br /><br />';
				echo '<p>Description: <br />'.$content->description.'</p><br /><br />';
				echo '<p>Last Twitt: <br />'.$content->status->text.'</p><br /><br />Followers:<br />';

				$i = 0;
				foreach($flws as $flw)
				{
					if($i < 5){
						echo '<img src="'.$flw->profile_image_url.'" width="25" height="25" /> '.$flw->screen_name.'<br />';
						$i++;
					}
				}
			?>
		</div>
		<div id="left">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div id="tw_tag">
				What's Happening
				</div>
				<div id="tw_count">
				675
				</div>
				<br />
				<textarea name="tw_text" id="tw_text" cols="100" rows="7" maxlength="675" onkeyup="count_char();"></textarea><br />
				<input type="submit" name="btn_sign" value="Tweet" />
			</form>
		</div>
		<div id="bottom">
			Home timeline:
			<?php
				foreach($timeline as $tw)
				{
					echo '<p><img src="'.$tw->user->profile_image_url.'" width="25" height="25" /> '.$tw->text.'</p>';
				}
			?>
		</div>
	</body>
</html>
