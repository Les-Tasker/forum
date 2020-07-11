<?php
function viewProfile()
{
  require "./includes/dbh.inc.php";
  $author = $_GET['author'];
  $sql = "SELECT * FROM users WHERE uidUsers = '$author'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $userid = $row['idUsers'];
  $username = $row['uidUsers'];
  $userimg = $row['imgUsers'];
  $userbio = $row['bioUsers'];
  $userfirst = $row['firstUsers'];
  $userlast = $row['lastUsers'];
  $usercampus = $row['campusUsers'];
  $usercourse = $row['courseUsers'];
  $userface = $row['faceUsers'];
  $userlinked = $row['linkedUsers'];
  $usertwit = $row['twitUsers'];
  $userinsta = $row['instaUsers'];

  if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) { ?>

    <div class="profile-container">


      <form action="includes/send-message.inc.php" method="post" id="send-message" class="hidden">
        <input type="hidden" name="fromUser" value="<?php echo $_SESSION['userId'] ?>">
        <input type="hidden" name="toUser" value="<?php echo $userid ?>">
        <textarea name="message-body" id="message-textarea" cols="40" rows="5"></textarea>
        <div>
          <input type="button" class="message-cancel" name="message-cancel" value="Cancel" onclick="messagecancel()"></button>
          <button class="message-submit" type="submit" name="message-submit">Send</button>
        </div>
      </form>



      <div class="profile-container-left" id="left">
        <div class="profile-image-container">
          <img class="profile-img" src="./uploads/<?php echo $userimg ?>" alt="Profile Image" />
          <h1 class="profile-info"><?php echo $username ?> <img class="user-course-badge" src="./img/<?php echo $usercourse . ".png" ?>" alt="Profile Image" />
          </h1>
          <button id="send-user-message" onclick="messagesend()">Send Message <img src="./img/msg.png" alt=""></button>
          <div class="profile-content">
            <div class="profile-title">
              <h3 class="profile-info"><?php echo ucwords($userfirst) . " " . ucwords($userlast) ?></h3>
              <h3 class="profile-info"><?php echo ucwords($usercampus) ?></h3>
              <h3 class="profile-info" id="profile-course"><?php echo ucwords($usercourse) ?></h3>
            </div>
            <div class="profile-social">
              <a href="<?php echo $userface ?>" target="_blank"><img class="soc-icon" src="img/facebook.png" alt="Facebook Logo"></a>
              <a href="<?php echo $usertwit ?>" target="_blank"><img class="soc-icon" src="img/twitter.png" alt="Twitter Logo"></a>
              <a href="<?php echo $userlinked ?>" target="_blank"><img class="soc-icon" src="img/linkedin.png" alt="Linked In Logo"></a>
              <a href="<?php echo $userinsta ?>" target="_blank"><img class="soc-icon" src="img/instagram.png" alt="Instagram Logo"></a>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-container-right" id="right">
        <div class="profile-bio">
          <h2>About me
            <hr>
          </h2>
          <p id="user-bio"><?php echo nl2br($userbio) ?></p>
        </div>
      </div>
    </div>



  <?php
  } else { ?>
    <div class="main-content-logout">
      <h1>You need to be logged in to view the forum</h1><br>
      <h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click here to register</a>
    </div>
<?php
  }
}
