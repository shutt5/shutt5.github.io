<?

  include 'analyticstracking.php';
  $PageName = $_SERVER[REQUEST_URI];
  include 'tracking.php';
  //echo $_SESSION['stage'];
  if(!isset($_SESSION['stage'])){
    $_SESSION['stage'] = 0;
  }
//echo session_id();
//echo $pageNum;
//echo $_SESSION['stage'];
  if($pageNum > $_SESSION['stage']){
    $_SESSION['stage'] = $pageNum;
  }
?>

<script>
transaction("PageLoaded");
</script>

<h1> Placating Plato with Plates of Pasta: </h1><br/>
<h2>An Interactive Tool for Teaching the Dining Philosophers Problem </h2>
<br>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php?PID=<?=$PID?>">Placating Plato</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="index.php?PID=<?=$PID?>">Home</a></li>

        <?php
        if($_SESSION['stage'] >= 1){
          echo "<li><a href=\"intro.php?PID=$PID\">Intro</a></li>";
        }
        if($_SESSION['stage'] >= 2){
          echo "<li><a href=\"realWorld.php?PID=$PID\">Real World Example</a></li>";
        }
        if($_SESSION['stage'] >= 3){
          echo "<li><a href=\"identify.php?PID=$PID\">Identify</a></li>";
        }
        if($_SESSION['stage'] >= 4){
          echo "<li><a href=\"interactiveExplanation.php?PID=$PID\">Philosophers Game</a></li>";
        }
        if($_SESSION['stage'] >= 5){
          echo "<li><a href=\"solutions.php?PID=$PID\">Solutions</a></li>";
        }
        if($_SESSION['stage'] >= 6){
          echo "<li><a href=\"code.php?PID=$PID\">Code Game</a></li>";
        }
        if($_SESSION['stage'] >= 7){
          echo "<li><a href=\"compare.php?PID=$PID\">Compare Solutions</a></li>";
        }
         ?>



      </ul>
      <ul class="nav navbar-nav navbar-right">

        <li><a href="help.php">Contact/Help</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
