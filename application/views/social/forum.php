<!DOCTYPE html>
<html lang="en">
<head>
    <meta property="og:url"  content="<?php echo base_url('e/CommonController/get_forum_by_id/'. $company['0']->id) ?>" />
    <meta property="og:type" content="articles" />
    <meta name="image" property="og:image" content="http://dev.victam.com/upload/victamlogo.jpg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <meta property="og:title"  content="<?php echo $company['0']->name ?>" />
    <meta property="og:description" content="<?php echo $company['0']->description ?>" />
    <title><?php echo $company['0']->name ?></title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
<script>
window.location.replace("http://dev.victam.com/forums/");
</script>
</head>
<body>
<div class="container">
  <div class="well">
      <div class="media">
      	<a class="pull-left" href="#">
    		<img class="media-object" src="http://dev.victam.com/upload/victamlogo.jpg">
  		</a>
  		<div class="media-body">
    		<h4 class="media-heading"><?php echo $company['0']->name ?></h4>
            <p><?php echo $company['0']->description ?></p>
       </div>
    </div>
  </div>
</div>
</body>
</html>