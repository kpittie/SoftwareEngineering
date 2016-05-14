<?php
/**
 * Created by NOTEPAD++
 * User: INDRANIL OJHA
 * Date: 14-04-2016
 * Time: 1:10 PM
 */
session_start();
?>
<!DOCTYPE html>
<html >
  <head>
    <title>Login/Sign-In</title>
    
    
    <link rel="stylesheet" href="../../styles/normalize.css">

    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../styles/style.css">
    

    
    <style>
  #side1
  {
  float:right;
  }
  .jumbotron {
      background-color:  #ccffe6;
      color: #fff;
      padding: 160px 35px;
      font-family: Montserrat, sans-serif;
  }
#clock{
  position:absolute;
  left:500px;
  top:0px;
  width:190px;
  height:43px;
}
  
  
  </style>
    
  </head>

  <body>
<?php
include("db_connect.php");
extract($_POST);
if(!isset($_SESSION['secure']))
{
$_SESSION['secure']=rand(1000,9999);
}
if(isset($submit))
{
    $passhash=crypt($pass,'$2a$'.$loginid);
  $rs=mysqli_query($connect,"select * from engineer where id='$loginid' and password='$passhash'");
  //print_r($rs);
   
  if(mysqli_num_rows($rs)<1)
  {
    $found="N";
     
  }
  else
    {
        if($_SESSION['secure']==$_POST['secure'])
        {
        $_SESSION['id']=$loginid;
        $_SESSION['secure']=rand(1000,9999);
    
        }
        else{
            $abc="N";
            $_SESSION['secure']=rand(1000,9999);
            }
    }
}
?>
<?php
if(isset($_SESSION['id']))
{
echo '<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
  <a class="navbar-brand" href="#myPage"><img class="img-circle" src="../../images/logo.png" width="50px" height="38px"></a>
      <a class="navbar-brand" href="#">ENGINEER\'S PORTAL</a>
   <a class="navbar-brand" href="#myPage"> <div id="clock">
  <object width="200" height="50" data="../../images/clock.swf"></object>
  </div></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="signout1.php"><span class="glyphicon glyphicon-home">Home</span></a></li>
     
    </ul>
  <ul class="nav navbar-nav navbar-right">
      <li><a href="signout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>';
    echo '<div class="container">';
   
  echo "<br><br><br><br>";
  echo "<b>&nbsp&nbsp&nbsp&nbsp&nbsp<span class='glyphicon glyphicon-user'></span>&nbspWELCOME ENGINEER&nbsp".$_SESSION['id']."</b><br><br></div>";
  
  
  
echo "<div class='jumbotron text-center'>";
  
    echo '<table width="28%"  border="0" align="center">
  <tr>
    <td width="7%" height="65" valign="bottom"><img src="../../images/b1.jpg" width="50" height="50" align="middle"></td>
    <td width="93%"valign="bottom" bordercolor="#0000FF"> <a href="ongoing.php"><h3>ONGOING  PROBLEMS </h3></a></td>
  </tr>
  <tr>
  <td></td>
  </tr>
  <tr>
    <td height="58" valign="bottom"><img src="../../images/b2.jpg" width="43" height="43" align="absmiddle"></td>
    <td valign="bottom" bordercolor="#0000FF"> <a href="complete.php" ><h3>&nbsp&nbspCOMPLETED PROBLEMS</h3></a></td>
  </tr>
</table>';
echo "</div>";
exit;
    
}
?>
    <div class="logmod">
  <div class="logmod__wrapper">
    <span class="logmod__close">Close</span>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        
        <li data-tabtar="lgm-2"><a href="#">LOGIN</a></li>
    <li data-tabtar="lgm-1"><a href="#">GUIDE</a></li>
    
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Engineer Login Portal allows engineers to see <strong>ongoing and completed problems</strong></span>
        </div>
        <div class="logmod__form">
          <p>&nbsp&nbsp&nbsp&nbsp&nbsp Sign In with Your Username and Password</p>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="#" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Like us in <strong>Facebook</strong></span>
              </div>
            </a>
              
            <a href="#" class="connect googleplus">
              <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
              </div>
              <div class="connect__context">
                <span>For updates give your <strong>Google+</strong>account</span>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="logmod__tab lgm-2">
        
        <div class="logmod__form">
          <form method="POST" action="" name="form1" accept-charset="utf-8"  class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">LOGIN-ID*</label>
                <input class="string optional" maxlength="255" name="loginid" placeholder="Login-ID" type="text" size="50" />
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" name="pass" placeholder="Password" type="password" size="50" />
                            <span class="hide-password">Show</span>
              </div>
            </div>
      <div class="sminputs">
      <div class="input string optional">
                <label class="string optional" for="user-pw-repeat">CAPTCHA *</label>
                <input class="string optional" maxlength="255"  name="secure" placeholder="CAPTCHA" type="text" size="50" />
              </div>
        <div class="input string optional">
                
                <img src="generate.php" alt="captcha" id="a2" title="Enter CAPTCHA!!">
              </div>
        </div>
       
            <div class="simform__actions">
      <?php
      if(isset($found))
      {
        echo "<b>Invalid Username or Password</b>";
      }
      ?>
      
              <input class="sumbit" name="submit" type="submit" value="Log In" />
              <?php
      if(isset($abc))
      {
      echo '<b>Incorrect Captcha</b>';
      }
      ?>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="#" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Sign in with <strong>Facebook</strong></span>
              </div>
            </a>
            <a href="#" class="connect googleplus">
              <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
              </div>
              <div class="connect__context">
                <span>Sign in with <strong>Google+</strong></span>
              </div>
            </a>
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="../../scripts/index.js"></script>

    
    
    
  </body>
</html>