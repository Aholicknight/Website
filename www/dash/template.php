<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $PAGE_TITLE; ?> | CCDash</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Ionicons
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  Theme style -->
  <link rel="stylesheet" href="<?php echo DASH; ?>css/admin.min.css">
  <link rel="stylesheet" href="<?php echo DASH; ?>css/skin-blue.min.css">

  <!-- Pace style -->
  <link rel="stylesheet" href="<?php echo DASH;?>libs/pace/pace.min.css">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

  <style>
    a {
      cursor: pointer;
    }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<?php
  $client = new \Github\Client();
  $client->authenticate($_SESSION['token'], null, \Github\Client::AUTH_HTTP_TOKEN);
?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo DASH;?>dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CompCamps</b> Dash</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a onclick="" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php include("includes/week-select.php"); ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $client->api('current_user')->show()['avatar_url']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['name']?></span>
            </a>
            <ul class="dropdown-menu" style="width:10px;">
              <li class="footer">
                <a onclick="Dash.do('signout');">Sign Out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <?php include("includes/nav.php"); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1 id='page_header'>
        <?php echo $PAGE_HEADER; ?>
      </h1>
    </section>
    <div id='page_content'>
      <?php OutputPage(); ?>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Active</b>
      <a target="_blank" href="https://github.com/CompCamps/Website/commit/<?php echo shell_exec("git log --pretty=format:'%H' -n 1"); ?>">
        <?php echo shell_exec("git log --pretty=format:'%h' -n 1"); ?>
      </a> on <a target="_blank" href="https://github.com/CompCamps/Website/tree/<?php echo shell_exec("git rev-parse --abbrev-ref HEAD"); ?>">
        <?php echo shell_exec("git rev-parse --abbrev-ref HEAD"); ?>
      </a>
    </div>
    <strong>CompCamps Dash</strong>
  </footer>
</div>
<!-- ./wrapper -->

<script>
  var PAGE_A = "<?php echo GetFromURL('a','dashboard'); ?>";
  var PAGE_B = "<?php echo GetFromURL('b',''); ?>";
  var PAGE_C = "<?php echo GetFromURL('c',''); ?>";
</script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo DASH; ?>libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo DASH; ?>libs/fastclick/fastclick.js"></script>
<!-- PACE -->
<script src="<?php echo DASH; ?>libs/pace/pace.min.js"></script>
<!-- FLOT -->
<script src="<?php echo DASH; ?>libs/flot/jquery.flot.js"></script>
<script src="<?php echo DASH; ?>libs/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo DASH; ?>libs/flot/jquery.flot.resize.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo DASH; ?>js/adminlte.min.js"></script>
<script src="<?php echo DASH; ?>js/dash.js"></script>

<script>
  Dash.Result = <?php echo json_encode((new ReflectionClass("Result"))->getConstants()); ?>;
  Dash.Level =  <?php echo json_encode((new ReflectionClass("Level"))->getConstants()); ?>;
  Dash.DASH = "<?php echo DASH; ?>";
  Dash.ROOT = "<?php echo ROOT; ?>";
  Dash.Campers =  {
    Filter: <?php echo json_encode((new ReflectionClass("CampersFilter"))->getConstants()); ?>
  }
  Dash.Week = <?php
      $values = array();
      foreach ($_SESSION['camp'] as $key=>$value) {
        $values[$key] = $value;
      }
      echo json_encode($values);
    ?>;
</script>

<script src="<?php echo DASH; ?>js/main.js"></script>

<script src="<?php echo DASH; ?>includes/js/week-selector.js"></script>

<?php include(DROOT."dash/includes/scripts.php"); ?>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
