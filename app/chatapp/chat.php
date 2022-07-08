<?php 
  session_start();
  include_once "php/config.php";
  include './php/index.php';
  require '../envi.php';
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php 
          $user_id = $_GET['user_id'];
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '$user_id'");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="../logo_data/<?php echo $logo; ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                    <p><?php echo $row['status_']; ?></p><br>
                    <a href="./users.php" class="logout">
                        <button class="button">
                            <-------- </button>
                    </a>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                    autocomplete="off">
                <button><i class="fab fa-telegram-plane"></i></button><br>
            </form>
        </section>
    </div>

    <script src="javascript/chat.js"></script>

</body>

</html>