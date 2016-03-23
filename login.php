
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign In QS By Blockly</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="c_login.php">
        <h2 class="form-signin-heading"><?php if(isset($_GET['error']) > 0) { echo $_GET['error']; } else { echo "Please Login"; } ?></h2>
        <label for="server" class="sr-only">Server</label>
        <input type="text" id="server" name="server" class="form-control" placeholder="server" required value="localhost">
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required  value="admin">
        <label for="passcode" class="sr-only">Password</label>
        <input type="password" id="passcode" name="passcode" class="form-control" placeholder="Password" required  value="admin">
        <label for="domain" class="sr-only">Domain</label>
        <input type="text" id="domain" name="domain" class="form-control" placeholder="Domain" required  value="Global">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Use Credentials</button>
      </form>

    </div> <!-- /container -->
  </body>
</html>
