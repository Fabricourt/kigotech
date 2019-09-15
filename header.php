<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="sets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script type="text/javascript"></script>
    <style type="text/css">
        .myh {
            margin-bottom: 100px;
        }
    </style>
 
    <div class="myh">
          <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                    <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></a>
                </div><!--end of  navbar header -->
                <div class="collapse navbar-collapse" id="myNavbar">
                    
                <ul class="nav navbar-nav">     
                    <li> <a href="index.php">Home</a></li>

                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-tutorials-notification">Tutorials </span> <span class="caret"></span></a>
                     <ul class="dropdown-menu">
          <li><a href="tutorial/phptutorial.php">PHP</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
                    </li>
                    <li><a href="#"><span class="glyphicon glyphicon-shopping-notification">Projects</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-resources-notification">Resources</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-resources-notification">AI</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-projects-notification">Quantum Computing</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-forum-notification">Forum</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-about-notification">About</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-shopping-notification">Notification</span></a></li>
                    <?php echo $profileLink; ?>
                </ul>

                <?php echo $loginLink; ?>

                <form class="navbar-form " onsubmit="return false;">
                    <div class="form-group" style="margin-left: 6%;" style="margin: auto;">
                        <input type="text" name="search" class="form-control" placeholder="Search"  style="width: 300px;" id="searchField"  onblur="hideResultDiv()" onkeyup="searchDB()"> 
                        <button type="submit" class="btn btn-success" name="search"><i class="glyphicon glyphicon-search"></i></button>
                    </div><!--end of  form-group -->
                </form>
                
                </div>
            </div><!--end of  container_fluid -->
        </nav><!--end of  navbar inverse -->  
    </div>   

        <div class="container">
         <div class="row"><!--
            <p>id: <?php echo $id; ?></p>
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p> 
            <p>phone<?php echo $phone; ?></p>
            <p><?php echo $gender; ?></p>
            <p><?php echo $description; ?></p>
            <p><?php echo $county_or_state; ?></p>
            <p><?php echo $country; ?></p>
            <p><?php echo $userlevel; ?></p>
            <p><?php echo $lastlogin; ?></p>
            <p><?php echo $signup; ?></p>
            <p><?php echo $activated; ?></p>
            <p><?php echo $notescheck; ?></p>-->
         </div>
        </div>

        
