<?php
  include('user.php');
?>

<!DOCTYPE html>
<html>
<head>
  <!--Bootstrap-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="settings.css">
  <!--<script src="signUpJS.js" type="text/javascript"></script>-->
  <link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quattrocento+Sans" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <title>User's Profile</title>
</head>
  <body>
    <!--Include JQuery: necessary for Bootstrap plugins-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--Include bootstrap library as needed-->
    <script src="js/bootstrap.min.js"></script>
    <!--navbar-inverse for reversing the colour of the nav menu-->
    <nav>
      <div class = "container">
        <div class = "row">
          <div class = "col-sm-4 col-md-2 col-lg-2">
            <a href="welcomeMember.php"><img src = "HELPFitLogo.jpg" alt = "HELPFitLogo" display = "inline-block"></a>
          </div>
          <div class = "col-sm-2 col-md-1 col-lg-1 col-md-offset-6">
          <a class="navlink" id = "tophover" href = "About.html">About</a>
          </div>
        <div class = "col-sm-4 col-md-1 col-lg-1">
        <a class="navlink" id = "tophover" href = "Fitness.html">Fitness</a>
        </div>
        <div class="col-sm-4 col-md-1 col-lg-2">
          <div class="nav navlink">
            <a class="dropdown-toggle" id="tophover" data-toggle="dropdown">Welcome!
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu" id="navhover">
              <?php
                  echo "<li><a href='signout.php'>Sign Out</a></li>";
               ?>
            </ul>
          </div>
        </div>
      </div>
	</div>
</nav>
<div class="container-fluid" id="bg">
  <div class="row" id="box">
    <h2>User's Details</h2>
    <br/>
    <form action="settingsPHP.php" onsubmit="return saveC()" method = "post" id="form" name="form">
          <label>Full Name: </label>
          <input type="text" id="fullname" name="fullname" style="color:black;" value="<?php echo $_SESSION['user']['fullname'];?>"/><br/>
        <br/>
        <label>New password: </label>
        <input type="password" id="oldpassword" name="newpassword" style="color:black;"/><br/>
      <br/>
          <label>Email address: </label>
      <input type="text" id="email" name="email" style="color:black;"  value="<?php echo $_SESSION['user']['email'];?>"/><br/>
      <br/>
    <label> Level: </label>
    <div name="level" id="level">
      <label class="radio">
        <input type = "radio" name="level" value="beginner" <?php if ($_SESSION['member']['level'] == "beginner"){ print "checked";} ?>>
        <div class="choice">Beginner</div>
      </label>
      <label class="radio">
        <input type = "radio" name="level" value="intermediate" <?php if ($_SESSION['member']['level'] == "intermediate"){ print "checked";} ?>>
        <div class="choice">Intermediate</div>
      </label>
      <label class="radio">
        <input type = "radio" name="level" value="expert" <?php if ($_SESSION['member']['level'] == "expert"){ print "checked";} ?>>
        <div class="choice">Expert</div>
      </label>
    </div>
    </br></br></br>
    <div>
    <button type="submit" class="selectBtn" style="padding:11px 20px;" name="submit">Save changes</button>
    <div class="divider"/>
    <button type="button" name="Cancel" class="selectBtn" style="padding:11px 20px;">Cancel</button>
    </div>
    <br/><br/>
    </form>
      </div>
    </div>
    <footer>
        <div class = "container">
          <div class ="row">
            <div class = "col-xs-5 col-sm-2 col-sm-offset-1">
              <h4>Links</h4>
              <ul class = "list-unstyled" id = "bottomhover">
                <li><a href = "About.html">About</a></li>
                <li><a href = "Fitness.html">Fitness</a></li>
                <li><a href = "signUpA1.html">Join Us</a></li>
                <li><a href = "Login.html">Login</a></li>
              </ul>
            </div>
            <div class = "col-xs-6 col-sm-5">
              <h4>Our Address</h4>
              <p>Jalan Semantan, Bukit Damansara, 50490 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur, Malaysia.</P>
            </div>

            <div class = "col-xs-6 col-sm-4">
              <h4>Find Us On</h4>
              <ul class = "list-unstyled" id = "bottomhover">
              <a href = "https://www.facebook.com/" class="btn btn-social-icon btn-facebook">
                  <span class="fa fa-facebook"></span>
              </a>
              <a href = "https://twitter.com/?lang=en"class="btn btn-social-icon btn-twitter">
                <span class="fa fa-twitter"></span>
              </a>
              <a href = "https://www.instagram.com/" class="btn btn-social-icon btn-instagram">
                <span class="fa fa-instagram"></span>
              </a>
            </ul>
            </div>
            <div class = "col-xs-12">
              <!--to provide invisible space for webiste-->
              <p style = "padding:10px;"</p>
              <p align = "center">Copyright &copy; HELPFit 2017. All Rights Reserved.</p>
            </div>
          </div>
        </div>
      </footer>
  </body>
</html>
