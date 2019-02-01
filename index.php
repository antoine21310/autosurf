<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
</head>
<body>
	<script type="text/javascript">
		function ouvrir(){
			var mywindow = window.open('http://google.fr', 'window', 'menubar=no, width =500px');

			function win(mywindow){
				
				$.ajax({
					url:"geturl.php",
					type:"POST",
					dataType:"json",
					success:function(data){
						console.log(data.url);
						console.log(data.reward);
						mywindow.location.replace(data.url);
					}
				})
			}
			setInterval(function(){win(mywindow);}, 5000);

		}

		setInterval(function(){
			$.ajax({
				url:"getuserstats.php",
				type:"POST",
				dataType:"json",
				success:function(data){
					console.log(data.points);
					$('#points').html(data.points);
				}
			})
		}, 10000);

		$('#submitUrl').click(function(){
			var input = $('#url').val();

			$.ajax({
				url:"addurl.php",
				type:"POST",
				data:{url: input},
				dataType:"json",
				success:function(data){
					console.log(data.points);
					$('#points').html(data.points);
				}
			})
		}



	</script>
	<div id="points"></div>
	<button onclick="ouvrir()">ouvrir</button>
	<input type="url" id="url">
	<button id="submitUrl">Envoyer</button>


</body>
</html>