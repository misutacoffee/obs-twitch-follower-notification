<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Follower Notification</title>
<link href="https://fonts.googleapis.com/css?family=Archivo+Black" rel="stylesheet"></head>

<style>
	body{
		background:#00FF00;
		font-family: 'Archivo Black', sans-serif;
		margin:0;
		overflow:hidden;
	}
	
	#followerNotificationContainer{
		height:200px;
		position:absolute;
		width:100%;
		max-width:700px;
		top:0;
		right:0;
	}
	#followerNotificationContainer .name{
		color: #99cc33;
	}
	
	#followerNotificationContainer img{
		float:right;
		width:200px;
		height:200px;
	}
	
	#followerNotificationContainer p{
		text-align: center;
		font-weight: bold;
		font-size: 35px;
		padding: 45px 0;
		margin:0;
		word-break:break-all;
		color:#EBECD8;
	}
</style>

<body>
	
	<div id="followerNotificationContainer">
		<img src="images/toasty.png">
		<p><span class="name"></span><br>is now following!</p>
	</div>




</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js' type='text/javascript'></script>

<script type = 'text/javascript'>
	const socketToken = '[YOUR SOCKET TOKEN]'; //Socket token from /socket/token end point

	//Connect to socket
	const streamlabs = io(`https://sockets.streamlabs.com?token=${socketToken}`);

	//Perform Action on event
	streamlabs.on('event', (eventData) => {
		//console.log(eventData);
		if (!eventData.for || eventData.for === 'streamlabs' && eventData.type === 'donation') {
			//code to handle donation events
			//console.log(eventData.message);
		}
		if (eventData.for === 'twitch_account') {
			switch(eventData.type) {
				case 'follow':
				//code to handle follow events
				followerNotification(eventData.message[0].name);
				//console.log(eventData.message);
				break;
				case 'subscription':
				//code to handle subscription events
				//console.log(eventData.message);
				break;
				default:
				//default case
				//console.log(eventData.message);
			}
		}
	});
	
	function followerNotification(name){
		$("#followerNotificationContainer .name").text(name);
		$("#followerNotificationContainer").animate({right: divWidth}).delay( 8000 ).animate({right: '0'});
		console.log(name);
	}
	var divWidth=$("#followerNotificationContainer").width()+"px";
	$("#followerNotificationContainer").css( {marginRight : "-"+divWidth } )
	followerNotification("YOUR NAME");
</script>
</html>