<?php
	include "connect.php";
	require ('core.php');
	if((isset($_SESSION['user_id'])&&!empty($_SESSION['user_id']))||(isset($_COOKIE['user_id'])&&!empty($_COOKIE['user_id']))){
		if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
			$user_id = $_SESSION['user_id'];
		} else if(isset($_COOKIE['user_id'])&&!empty($_COOKIE['user_id'])){
			$user_id = $_COOKIE['user_id'];
		}
		$query = "SELECT * FROM `chat` WHERE `user-id`='".mysql_real_escape_string($user_id)."'";
		if($query_run = mysqli_query($dbc, $query)){
			$query_num_rows = mysqli_num_rows($query_run);
			if($query_num_rows==0){
?>
<a><li><div class="chat-body clearfix"><h2>We are here to provide you whatever you want.</h2></div></li></a>

<?php
			} else {
				while($user_row = mysqli_fetch_array($query_run)){
					$chat_text = $user_row['chat-text'];
					$chat_who = $user_row['by'];
					if($chat_who == 'user'){
						
?>
<a><li id="float-right" class="right clearfix">
    <div class="chat-body clearfix">
        <p><?php echo $chat_text; ?>
			<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>Just now</small>
        </p>
    </div>
</li></a>

<?php
					} else if($chat_who == 'admin'){
?>
<a><li id="float-left" class="left clearfix">
	<div  id="move-right" class="chat-body clearfix">
        <p><?php echo $chat_text; ?>
		<small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>Just now</small>
        </p>
    </div>
</li></a>

<?php
					}
				}	
			}
		}
	}
?>