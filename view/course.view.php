<?php
function displayCourse($course)
{
?>
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
    <div class="outline">
        <div class="testpnt">
            <h2><?php echo ucfirst($_GET['campus']) ?></h2>
        </div>

        <?php
            if (empty($course)) {
                header("Location: 404.php");
            } else {
                $courseCount = new CourseHandler;
                foreach ($course as $row) { ?>
        <div class="forum-category">
            <img class="topic-logo" src="img/<?php echo $row['course'] . ".png" ?>">
            <div class="topic-title-desc">
                <a class="topic-title border-left"
                    href="category.php?campus=<?php echo $_GET['campus'] ?>&course=<?php echo  $row['course'] ?>"><?php echo ucfirst($row['course']) ?></a>
            </div>
            <div class="topic-post-count">Topics:
                <?php $courseCount->courseTopicCountHandler($_GET['campus'], $row['course']) ?>
            </div>
        </div>
        <?php
                }
            } ?>
    </div><?php
            }