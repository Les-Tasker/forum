<?php

function viewProfile()
{
    $user = new UserHandler;
    $user->getUserInfoByUsernameHandler($_GET['author']);

?>
<div class="profile-container">
    <div class="profile-banner"><img src="uploads/<?php echo $user->Usercover ?>" alt="">
        <!-- <img id="cover-plus-icon" alt="Add new image" src="img/addimg.png" onclick="cover()" /> -->
    </div>
    <div class="profile-container-wrapper">
        <form action="messages.php" method="post" id="send-message" class="hidden">
            <img class="profile-img-message" src="./uploads/<?php echo $user->Userimage ?>" alt="Profile Image" />
            <h1 class="profile-info"><?php echo $user->Username ?> <img class="user-course-badge"
                    src="./img/<?php echo $user->Usercourse . ".png" ?>" alt="Profile Image" />
            </h1>
            <input type="hidden" name="fromUser" value="<?php echo $_SESSION['userId'] ?>">
            <input type="hidden" name="toUser" value="<?php echo $user->Userid ?>">
            <textarea name="message-body" id="message-textarea" cols="40" rows="5"
                placeholder="Say hi to <?php echo $user->Username ?>..."></textarea>
            <div>
                <input type="button" class="message-cancel" name="message-cancel" value="Cancel"
                    onclick="messageCancel()"></button>
                <button class="message-submit" type="submit" name="message-submit">Send</button>
            </div>
        </form>
        <div class="profile-container-left" id="left">
            <div class="profile-image-container">
                <img class="profile-img" src="./uploads/<?php echo $user->Userimage ?>"
                    alt=" <?php echo $user->Username ?> Profile Image" />
                <h1 class="profile-info"><?php echo $user->Username ?> <img class="user-course-badge"
                        src="./img/<?php echo $user->Usercourse . ".png" ?>" alt="Profile Image" />
                </h1>
                <button id="send-user-message" onclick="messageSend()">Send Message <img src="./img/msg.png"
                        alt=""></button>
                <div class="profile-content">
                    <div class="profile-title">
                        <h3 class="profile-info">
                            <?php echo ucwords($user->Userfirstname) . " " . ucwords($user->Userlastname) ?></h3>
                        <h3 class="profile-info"><?php echo ucwords($user->Usercampus) ?></h3>
                        <h3 class="profile-info" id="profile-course"><?php echo ucwords($user->Usercourse) ?></h3>
                    </div>
                    <div class="profile-social">
                        <a href="#" target="_blank"><img class="soc-icon" src="img/facebook.png"
                                alt="Facebook Logo"></a>
                        <a href="#" target="_blank"><img class="soc-icon" src="img/twitter.png" alt="Twitter Logo"></a>
                        <a href="#" target="_blank"><img class="soc-icon" src="img/linkedin.png"
                                alt="Linked In Logo"></a>
                        <a href="#" target="_blank"><img class="soc-icon" src="img/instagram.png"
                                alt="Instagram Logo"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-container-right" id="right">
            <div class="profile-bio">
                <h2>About me
                    <hr>
                </h2>
                <p id="user-bio"><?php echo nl2br($user->Userbio) ?></p>
            </div>
        </div>
    </div>
</div>

<?php }