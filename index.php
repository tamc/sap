
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="equations.js"></script>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }

      p {
        color:#222;
        font-style:italic;
      }
 
    </style>
  </head>
  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<style>
  input {
    width:80px;
  }
</style>

    <div class="container">

      <h1>SAP Worksheet 2012</h1>

      <?php require "form.html"; ?>

    </div>

    <script>
    var data = {};
    data = calculate(data);
    for (z in data) $('#'+z).attr("readonly","readonly");

    $('input').each(function()
    {
      var id = $(this).attr('id');
      data[id] = $(this).val()*1;
    });

    $('input').change(function()
    {
      var id = $(this).attr('id');
      data[id] = $(this).val()*1;
      var last = JSON.parse(JSON.stringify(data));
      data = calculate(data);
      for (z in data)
      {
        if (z!=id && last[z]!=data[z]) $("#"+z).val(data[z]);
      }
    });


    </script>

  </body>
</html>
