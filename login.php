<html>
<head>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src="http://www.utm.my/dev/bootstrap/js/bootstrap.min.js"></script>
<link href="http://www.utm.my/dev/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="text-center">MyUTM</h1>
					<p  class="text-center">version 0.1 alpha</p>
				</div>
				<div class="modal-body">
					<form class="form col-md-12 center-block"  action="index.php" method="post">
						<div class="form-group">
							<input type="text" class="form-control input-lg" placeholder="Username" name="username">
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="Password" name="password">
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-lg btn-block">Sign In</button>	
							
						</div>
						<p class="text-right"><a href="#">Register</a></span> | <span><a href="#">Lost your password?</a></p>
					</form>
					<div style="clear:both"> </div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
