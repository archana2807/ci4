<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap 5 Simple Admin Dashboard</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- insert stylesheets here -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" >
</head>

<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
setTimeout(function() {
    $("#messages").hide();
}, 3000); 
</script>
<style type="text/css">
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  padding: 90px 0 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
  z-index: 99;
}

@media (max-width: 767.98px) {
  .sidebar {
    top: 11.5rem;
    padding: 0;
  }
}

.navbar {
  box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
}

@media (min-width: 767.98px) {
  .navbar {
    top: 0;
    position: sticky;
    z-index: 999;
  }
}

.sidebar .nav-link {
  color: #333;
}

.sidebar .nav-link.active {
  color: #0d6efd;
}
</style>
<body>
    
 <nav class="navbar navbar-light bg-light p-3">
     <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between ">
      
      <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
 
  
      <a class="dropdown-item " href="<?php echo base_url(); ?>welcome/profile">Home</a>
	  <a class="dropdown-item" href="<?php echo base_url(); ?>welcome/profile">About-us</a>
	  <?php if(!session()->has('logged_user')){ ?>
	  <a class="dropdown-item" href="<?php echo base_url('login'); ?>">Login</a>
	  <a class="dropdown-item" href="<?php echo base_url('register'); ?>">Register</a>
	  <?php
	  } else {
	   ?>
	   
	   <a class="dropdown-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
	   <a class="dropdown-item" href="<?php echo base_url(); ?>">Edit</a>
	   <a class="dropdown-item" href="<?php echo base_url('change-avatar'); ?>">Change Avatar</a>
	   <a class="dropdown-item" href="<?php echo base_url('change-password'); ?>">Change Password</a>
	    <a class="dropdown-item" href="<?php echo base_url('login-activity'); ?>">Login Activity</a>
	   <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">Logout</a>
	   
	   <a class="dropdown-item" href="<?php echo base_url('logout'); ?>">
	           </a>
	   <?php
	  }
	  ?>
	  
	  
	  </div>
 
</nav>
<div class="container-fluid">

  <div class="row">
  
      <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
	   <!--Area for dynamic content -->
        <?= $this->renderSection("content"); ?>
		
     <footer class="pt-5 d-flex justify-content-between">
     <span>Copyright © 2019-2020 <a href="https://themesberg.com">Themesberg</a></span>
     <ul class="nav m-0">
      <li class="nav-item">
        <a class="nav-link text-secondary" aria-current="page" href="#">Privacy Policy</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary" href="#">Terms and conditions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-secondary" href="#">Contact</a>
      </li>
    </ul>
 </footer>
      </main>
	  
  </div>
</div>


</body>
</html>