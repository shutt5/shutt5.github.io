<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<body>
<div class="container">


  <?
  include 'nav.php';
  $SESSION['started'] = "t";
  ?>

<h2> So we've seen the problem... </h2>
  But what does it mean?

  The dining philosphers is an interesting representation of a problem. A problem that is directly transferrable to Operating Systems.
  There are many different guises of the problem, for example

  <? include 'example.html' ?>

  <h2> But what does this mean for Operating Systems </h2>

  In an operating systems situation we can think of the following:

  <ul>
    <li> Philosophers are Processes</li>
    <li> The chopsticks are the resources that the processes need for example certain files</li>
    <li> All the processes need to run correctly</li>
 </ul>

The problems that exist for the philosphers also exist for operating systems.

 <ul>
    <li> Deadlock would mean nothing would run, process would not be completed </li>
    <li> Starvation would mean certain porcesses would never finish </li>
</ul>

Either of these conditions would result in the Operating system failing to perform it's task.

So how do we solve it?

<div class="row">

<div class="row">
  <div class="col-md-10"></div>
  <div class="col-md-2">
    <a href = "code.html"><button type="button" class="btn btn-lg btn-primary">Next</button></a>
  </div>
</div>

</div>
</body>
</html>
