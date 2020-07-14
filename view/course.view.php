<?php
if (isset($_SESSION['userId']) && ($_SESSION['userVerified'] == "TRUE")) {
    if ($_GET['campus']) { ?>
        <div class="main-content">
            <div class="search-container">
                <form class="form-inline" action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                        <div class="input-group-append">
                            <button name="search-submit" type="submit" class="btn btn-secondary">
                                <img src="./img/search.png"></button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="breadcrumbs"><a href="index.php">FRONT PAGE</a> > <?php echo strtoupper($_GET['campus']) ?></div>
            <?php
            if (empty($course)) {
            } else {
                foreach ($course as $row) { ?>
                    <div class="forum-category">
                        <img class="topic-logo" src="img/<?php echo $row['course'] . ".png" ?>">
                        <div class="topic-title-desc">
                            <a class="topic-title" href="category.php?campus=<?php echo $_GET['campus'] ?>&course=<?php echo  $row['course'] ?>"><?php echo strtoupper($row['course']) ?></a>
                            <hr>
                        </div>
                        <div class="topic-post-count">Topics: <?php courseCount($_GET['campus'], $row['course']) ?>
                        </div>
                    </div>
            <?php
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
        }
