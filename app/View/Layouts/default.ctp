<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>塞壬格蕾's Home</title>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="/app/webroot/js/bootstrap.min.js"></script>

<?php echo $this->Html->css('wrapper.css');?>
<?php echo $this->Html->css('bootstrap.min.css');?>
<?php echo $this->Html->css('bootstrap-responsive.min.css');?>


</head>

<body>
	<div id="main-wrapper">
        <div class="navbar-wrapper">
          <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
          <div class="container">
    
            <div class="navbar navbar-inverse">
              <div class="navbar-inner">
                <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </a>
                <a class="brand" href="http://sirengray.com">SirenGray.com</a>
                <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                <div class="nav-collapse collapse">
                  <ul class="nav">
                    <li class="active"><a href="http://sirengray.com">Home</a></li>
                    <li><a href="#wiki">Wiki</a></li>
                    <li><a href="http://sirengray.com/index.php/games/index">Game Center</a></li>
                    <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                    </li>
                    <li><a href="#login">Login</a></li>
                  </ul>
                </div><!--/.nav-collapse -->
              </div><!-- /.navbar-inner -->
            </div><!-- /.navbar -->
    
          </div> <!-- /.container -->
        </div><!-- /.navbar-wrapper -->
            
        <div id="gap"></div>    
         
        <div id="content" class="container">

            <?php echo $this->fetch('content'); ?>
            
        </div>
        
        
        <div class="container marketing">  
        
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; sirengray.com &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>
            
        </div><!-- end main content -->
            
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>