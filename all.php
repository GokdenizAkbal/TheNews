<?php
include("databaseConnection.php");
include ("functions.php");
$sql = "SELECT * FROM news ORDER BY publish_date DESC";
$result = $link->query($sql);
?>

<h2 class="news-heading">All News</h2>
<section class="news-section-all">

    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tags = explode(',', $row['tags']);
            ?>
            <article class="news-card-all">
                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
                <div class="news-content">
                    <p class="news-meta"><?php echo htmlspecialchars($row['author']) . ' • ' . date('j M Y', strtotime($row['publish_date'])); ?></p>
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <div class="news-tags">
                        <?php
                        foreach ($tags as $tag) {
                            $tag_trimmed = trim($tag);
                            $tag_class = toCamelCase($tag_trimmed);
                            $tag_text = ucwords($tag_trimmed);
                            echo "<span class=\"$tag_class\">$tag_text</span>";
                        }
                        ?>
                    </div>
                </div>
            </article>
            <?php
        }
    } else {
        echo "<p>No news available.</p>";
    }
    ?>
</section>