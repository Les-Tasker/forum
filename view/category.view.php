<?php
function displayCategory($category)
{
?>
<div class="main-content">
    <div class="search-container">
        <form class="form-inline" action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search-string" placeholder="Search Topics" />
                <div class="input-group-append">
                    <button name="search-submit" type="submit" class="btn btn-secondary">
                        <img src="./img/search.png">
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="outline">
        <div class="testpnt">
            <a href="course.php?campus=<?php echo $_GET['campus'] ?>">
                <h2><?php echo ucfirst($_GET['campus']) ?> - </h2>
            </a>
            <h2> <?php echo ucfirst($_GET['course']) ?></h2>

        </div>
        <?php
            if (empty($category)) {
            } else {
                $CategoryCount = new CategoryHandler;
                foreach ($category as $row) { ?>
        <div class="forum-category">
            <img class="topic-logo" src="img/<?php echo $_GET['course'] . ".png" ?>">
            <div class="topic-title-desc">

                <a class="topic-title border-left"
                    href="topiclist.php?campus=<?php echo $_GET['campus'] ?>&course=<?php echo $_GET['course'] ?>&category=<?php echo $row['category'] ?>"><?php echo ucfirst($row['category']) ?></a>

            </div>
            <div class="topic-post-count">Topics:
                <?php $CategoryCount->Category_topic_count_Handler($_GET['campus'], $_GET['course'], $row['category']) ?>
            </div>
        </div>
        <?php
                }
            }

            ?>
    </div><?php
            }