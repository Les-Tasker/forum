<?php
function Display_campus($campus)
{
?>


    <div class="main-content">
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
        <!-- Test -->
        <div class="outline">
            <h2>General </h2>
            <div class="forum-category">
                <img class="topic-logo" src="img/sae.png">
                <div class="topic-title-desc">
                    <a class="topic-title border-left" href="topic.php?aux=announce">Announcements</a>
                </div>
            </div>
            <div class="forum-category">
                <img class="topic-logo" src="img/sae.png">
                <div class="topic-title-desc">
                    <a class="topic-title border-left" href="topic.php?aux=rules">Forum Rules</a>
                </div>
            </div>
            <div class="forum-category">
                <img class="topic-logo" src="img/sae.png">
                <div class="topic-title-desc">
                    <a class="topic-title border-left" href="topic.php?aux=bugs&id=1">Bugs & Issues</a>
                </div>
            </div>
        </div>
        <div class="outline">
            <h2>Campus</h2>
            <!-- test -->

            <?php
            if (empty($campus)) {
            } else {

                foreach ($campus as $row) {
                    $CampusTopicCount = new TopicHandler;
                    $campus =  $row['campus'];
            ?>
                    <div class="forum-category">
                        <img class="topic-logo" src="img/sae.png">
                        <div class="topic-title-desc">
                            <a class="topic-title border-left" href="course.php?campus=<?php echo $row['campus'] ?>"><?php echo ucfirst($row['campus'])  ?></a>

                        </div>
                        <div class="topic-post-count">Topics: <?php echo $CampusTopicCount->Campus_topic_count_Handler($row['campus']) ?>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div><?php
            }
