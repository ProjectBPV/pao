<!DOCTYPE html>
<html>
	<head>
	    <title>Login</title>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
	    <link rel="stylesheet" href="{DIR}assets/style/login.css">
	    
	    <script src="{DIR}assets/lib/jquery/jquery-2.1.3.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
		    <form class="form-signin">
	            <fieldset>
	                <legend>Login</legend>
	                <div class="control-group">
	                    <label class="control-label" for="name">Gebruikersnaam</label>
	                    <div class="controls">
	                        <input type="text" class="input-xlarge" name="name" id="name">
	                    </div>
	                </div>
	                <div class="control-group">
	                    <label class="control-label" for="email">Wachtwoord</label>
	                    <div class="controls">
	                        <input type="password" class="input-xlarge" name="password" id="password">
	                    </div>
	                </div>
	                <div class="form-actions">
	                    <button type="submit" class="btn btn-primary btn-large">Aanmelden</button>
	                </div>
	            </fieldset>
		    </form>
		</div>
	</body>
</html>