<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<form action="" method="POST" role="form">
			<div class="form-group">
				<label for="">Title</label>
				<input type="text" class="form-control" id="title" placeholder="Write some title here" required>
				<label for="">Message</label>
				<textarea placeholder="Write some message here" id="message" class="form-control" required></textarea>
			</div>
			<button type="button" id="sbtn" class="btn btn-success"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Notify</button>
		</form>

	</div>
</body>
</html>
<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="./easyNotify.js"></script>
<script>
	$( document ).ready(function() {
		$( "#sbtn" ).click(function(e) {
			e.preventDefault();
			var nTitle = $('#title').val();
			var nDescription = $('#message').val();
			var myImg = "./notification.png";
		 	var options = {
				title: nTitle,
				options: {
					body: nDescription,
					icon: myImg,
					lang: 'en-US',
					onClick: redirectNotification, // onClick callback
				}
	    	};
			$("#easyNotify").easyNotify(options);
		});
	});

	function redirectNotification(){
		alert("notification triggered");
	}
</script>
