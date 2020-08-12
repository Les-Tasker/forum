<?php function Display_Profile()
{
    $User = new UserHandler;
    $User->Get_user_info_by_id_Handler($_SESSION['userId']);
?>
<div class="profile-container">
    <div class="profile-banner">
        <div class="buttonlabel" onclick="cover()">
            <span>Update Cover Image</span>
            <img id="cover-plus-icon" alt="Add new image" src="img/addimg.png" />
        </div>
        <img src="uploads/<?php echo $User->Usercover ?>" alt="">
    </div>
    <div class="profile-container-wrapper">
        <div class="profile-container-left">
            <div class="profile-image-container">
                <img class="profile-img" src="uploads/<?php echo $User->Userimage ?>" alt="Profile Image" />
                <img id="plus-icon" alt="Add new image" src="img/addimg.png" onclick="profileImage()" />
                <h1 class="profile-info"><?php echo $User->Username ?> <img class="user-course-badge"
                        src="./img/<?php echo $User->Usercourse . ".png" ?>" alt="Profile Image" />
                </h1>

                <?php
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "notallowed") {
                            echo '<p class="signuperror"> Filetype not supported. Supported files: jpg, jpeg, png. </p>';
                        } else if ($_GET['error'] == "fileerror") {
                            echo '<p class="signuperror"> There was an error uploading your file </p>';
                        } else if ($_GET['error'] == "filetoobig") {
                            echo '<p class="signuperror"> File is too large. (Max filesize 1MB) </p>';
                        } else if ($_GET['error'] == "DBCONNECT") {
                            echo '<p class="signuperror"> DB Connection failed </p>';
                        }
                    } ?>

                <div class="profile-content">
                    <div class="profile-title">
                        <h3 class="profile-info">
                            <?php echo ucwords($User->Userfirstname) . " " . ucwords($User->Userlastname) ?></h3>
                        <h3 class="profile-info"><?php echo ucwords($_SESSION['userCampus']) ?></h3>
                        <h3 class="profile-info" id="profile-course"><?php echo ucwords($User->Usercourse) ?></h3>
                    </div>
                    <!-- <div class="profile-social">
                        <a href="<?php echo $_SESSION['userFace'] ?>" target="_blank"><img class="soc-icon"
                                src="img/facebook.png" alt="Facebook Logo"></a>
                        <a href="<?php echo $_SESSION['userTwit'] ?>" target="_blank"><img class="soc-icon"
                                src="img/twitter.png" alt="Twitter Logo"></a>
                        <a href="<?php echo $_SESSION['userLinked'] ?>" target="_blank"><img class="soc-icon"
                                src="img/linkedin.png" alt="Linked In Logo"></a>
                        <a href="<?php echo $_SESSION['userInsta'] ?>" target="_blank"><img class="soc-icon"
                                src="img/instagram.png" alt="Instagram Logo"></a>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="profile-container-right">
            <div class="profile-bio">
                <h2>About me<img id="edit-profile" src="img/edit.png" alt="Edit Bio" onclick="bioedit()" />
                    <hr>
                </h2>
                <p id="user-bio"><?php echo nl2br($User->Userbio) ?></p>
                <form action="profile.php" method="post" id="bio-form" class="hidden">
                    <textarea name="bio" id="bio-form-textarea" cols="30" rows="10"></textarea>
                    <div>
                        <button class="bio-cancel" name="bio-cancel" onclick="biocancel()">Cancel</button>
                        <button class="bio-submit" type="submit" name="bio-submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="upload-form-id" class="upload-form" action="profile.php" method="POST" enctype="multipart/form-data">
        <img id="exit-profile" src="img/plus.png" onclick="profileImage2()" />
        <div class="upload-form-inner">
            <h2>Upload New Profile Image</h2>
            <img class="profile-img" src="./uploads/<?php echo $User->Userimage ?>" alt="icon" />
            <div class="profile-button-wrapper">
                <label id="img-up-browse" for="my-file-selector">
                    <input id="my-file-selector" type="file" name="file" accept="image/*" style="display:none"
                        onchange="$('#upload-file-info').html(this.files[0].name)">
                    Browse <img src="./img/browseimg.png" alt=""></label>
                <span class='label label-info' id="upload-file-info"></span>
                <button id="img-up-submit" type="submit" name="submit">Upload <img src="./img/upload.png"
                        alt=""></button>
            </div>
        </div>
    </form>

    <form id="upload-form-id2" class="upload-form2" action="profile.php" method="POST" enctype="multipart/form-data">
        <img id="exit-profile" src="img/plus.png" onclick="cover2()" />
        <div class="upload-form-inner">
            <h2>Upload New Cover Image</h2>
            <h6>recommended size: 900x300px</h6>
            <img class="cover-img" src="./uploads/<?php echo $User->Usercover ?>" alt="icon" />
            <div class="profile-button-wrapper">
                <label id="img-up-browse" for="my-file-selector2">
                    <input id="my-file-selector2" type="file" name="file" accept="image/*" style="display:none"
                        onchange="$('#upload-file-info2').html(this.files[0].name)">
                    Browse <img src="./img/browseimg.png" alt=""></label>
                <span class='label label-info' id="upload-file-info2"></span>
                <button id="img-up-submit" type="submit" name="cover-submit">Upload <img src="./img/upload.png"
                        alt=""></button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_GET['uploadsuccess'])) {
        //  " File uploaded successfully";
        if (isset($_GET['conn'])) {
            if ($_GET['conn'] == "updsuc") {
                echo '<p class="signuperror"> record updated successfully  </p>';
            } else if ($_GET['conn'] == "updfail") {
                echo '<p class="signuperror"> record error </p>';
            }
        }
    }
    if (isset($_GET['error'])) {
        if ($_GET['error'] == "emptycommentfields") {
            echo '<p class="signuperror"> Text cannot be empty. </p>';
        }
    }
}