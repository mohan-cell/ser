<?php require("login.class.php") ?>
<?php 
	if(isset($_POST['submit'])){
		$user = new LoginUser($_POST['name'], $_POST['contact']);
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Admin&mdash; UVC Play</title>
    <link rel="stylesheet" href="style.css"><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<style type="text/css">
		.material-symbols-outlined {
			font-size: 14pt;
			vertical-align: bottom;
			font-variation-settings:
			  'FILL' 0,
			  'wght' 400,
			  'GRAD' 0,
			  'opsz' 48
		}
	</style>
  </head>
  <body bgcolor="#072564" style="color: #FFFFFF;">
    <div class="container">
      <img src="logo.png" alt="Logo">

	<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="form-group">
          <label for="name">username:</label>
		<input type="text" name="name">
          
        </div>
        <div class="form-group">
          <label for="contact">Password:</label>
		<input type="text" name="contact">
          
        </div>
        <button type="submit" name="submit">Login Now</button>
      </form>
	      </div>
  </body>
</html>