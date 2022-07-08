<?php 
  session_start();
  include_once "php/config.php";
  include './php/index.php';
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  $uni = $_SESSION['unique_id'];
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$uni'");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
                    <img src="../logo_data/<?php echo $logo; ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                        <p><?php echo $row['status_']; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a Student or a Class to send SMS</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i>search</button>
            </div>
            <div class="users-list">

            </div>
        </section>
    </div>

    <script src="javascript/users.js"></script>

</body>

</html>