<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Level 2 Loading</title>
	
	
	<script>
	
		function myFunction() {
		//var sample = document.getElementById("foobar");
		
		//setTimeout(myFunction, 7000);
		
		//sample.play();
		}
		
	
	
	</script>
	
	<style>
	
	
	.transition{
		width: 100%;
		height: 100%;	
	}

	</style>
	
</head>

	<body onload="myFunction()">
	
		
		<img class="transition" src="images/trransitionToLevel2.gif">


		<audio id="foobar" src="sounds/sound.mp3" preload="auto"> 
	</body>
	
	
	<script>
	function example(){
	
		location.href = 'Level_2.php';
	
	}
	
	setTimeout(example, 6000);
	

	</script>
	
	
	
	
	
</html>