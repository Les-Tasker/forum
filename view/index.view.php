<?php
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
?> <div class="main-content">
        <div class="search-container">
            <form class="form-inline" action="search.php" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                    <div class="input-group-append">
                        <button name="search-submit" type="submit" class="btn btn-secondary">
                            <img src="./img/search.png"> </button>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (empty($campus)) {
        } else {
            foreach ($campus as $row) { ?>
                <div class="forum-category">
                    <img class="topic-logo" src="img/sae.png">
                    <div class="topic-title-desc">
                        <a class="topic-title" href="course.php?campus=<?php echo $row['campus'] ?>"><?php echo strtoupper($row['campus'])  ?></a>
                        <hr>
                    </div>
                    <div class="topic-post-count">Topics: <?php campusCount($row['campus']) ?>
                    </div>
                </div> <?php
                    }
                }
            } else { ?>
        <div class="main-content-logout">
            <h1>You need to be logged in to view the forum</h1><br>
            <h1>If you have registered, please check your email to verify your account</h1><br><a href="signup.php">Click here to register</a>
        </div>

    </div><?php
                signup();
            }
