<!DOCTYPE html>

<html>

<body>

  <!DOCTYPE html>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div class="container">

<?
include 'nav.php';

?>

<h1> Interactive Explanation</h1>

<p>Having covered the basics, try out the following visualization
</p>

<p>Click on a philosopher to change their state. As philosophers think, their health bar will begin to deplete until they are switched to an eating state.
</p>

<center>
  <object widht="775px" height="710px">
    <embed width="775px" height ="710px" src="interactiveExplanationVisualization/example.html">
    </embed>
  </object>
</center>

      <div class="row">

        <div class="row">
          <div class="col-md-10"></div>
          <div class="col-md-2">
            <a href = "solutions.php"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
          </div>
        </div>

</div>

</body>

</html>
