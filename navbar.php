<!--navbar-->
<nav class=" navbar sticky-top  px-3 bg-dark  ">
        <div class="container-fluid ">
          <a class="navbar-brand navbarText" href="home.php">
                <img src="image/theMongers.jpg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Walter School
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
         <!-- <div class="collapse navbar-collapse " id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto ">
              <li class="nav-item">
                <a class="nav-link active navbarText " aria-current="page" href="home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link navbarText" href="about.php">About</a>
              </li>
              <li class="nav-item dropdown navbarText">
                <a class="nav-link dropdown-toggle navbarText " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Catagory
                </a>
                <ul class="dropdown-menu bg-dark bg-opacity-75 " aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item navbarText " href="#" >Decorative</a></li>
                  <li><a class="dropdown-item navbarText " href="#">Electronic</a></li>
                  <li><hr class="dropdown-divider navbarText "></li>
                  <li><a class="dropdown-item navbarText " href="#">Lights</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Contact</a>
                <a class="nav-link navbarText" href = "contact.php">Contact</a>
              </li>
            </ul> -->
            <div class="d-flex">
              <label class= "text-white px-3 m-auto" for="logout"><?php echo $_SESSION['user']?></label>
              
              <a href = "logout.php"><button class="btn btn-outline-danger" type="button" id = "logout">Log Out</button></a>
            </div> 
          </div>
        </div>
    </nav>