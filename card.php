<!-- <section class="news-section">
    <h2>Recent News</h2>
    <div class="news-grid">

        <article class="news-card large">
            <img src="Images/Review.png" alt="UX Review Presentations">
            <div class="news-content">
                <p class="news-meta">
                    Olivia Rhye • 1 January 2023
                </p>
                <h3>UX Review Presentation</h3>
                <p>How do you create compelling presentations that wow your colleagues and impress your managers?</p>
                <div class="news-tags">
                    <span class="design">Design</span>
                    <span class="research">Research</span>
                    <span class="presentation">Presentation</span>

                </div>
            </div>
        </article>


        <article class="news-card small">
            <img src="Images/Migration.png" alt="Migrating to Linear 101">
            <div class="news-content">
                <p class="news-meta">Phoenix Baker • 1 Jan 2023</p>
                <h3>Migrating to Linear 101</h3>
                <p>Linear helps streamline software projects, sprints, tasks, and bug tracking. Here’s how to get
                    started...</p>
                <div class="news-tags">
                    <span class="design">Design</span>
                    <span class="research">Research</span>
                </div>
            </div>
        </article>


        <article class="news-card small">
            <img src="Images/Apı.png" alt="Building your API Stack">
            <div class="news-content">
                <p class="news-meta">Lana Steiner • 1 Jan 2023</p>
                <h3>Building your API Stack</h3>
                <p>The rise of RESTful APIs has been met by a rise in tools for creating, testing, and managing
                    them...</p>
                <div class="news-tags">
                    <span class="design">Design</span>
                    <span class="research">Research</span>
                </div>
            </div>
        </article>


        <article class="news-card large">
            <img src="Images/Climate.png" alt="Climate Endgame">
            <div class="news-content">
                <p class="news-meta">Olivia Rhye • 1 Jan 2023</p>
                <h3>Grid system for better Design User Interface</h3>
                <p>A grid system is a design tool used to arrange content on a webpage. It is a series of vertical and
                    horizontal lines...</p>
                <div class="news-tags">
                    <span class="design">Design</span>
                    <span class="interface">Interface</span>
                </div>
            </div>
        </article>


    </div>
</section> -->


<?php
include("databaseConnection.php");

// Fetch the latest 4 news items from the database
$sql = "SELECT * FROM news ORDER BY publish_date DESC LIMIT 4";
$result = $link->query($sql);
?>

<section class="news-section">
    <h2>Recent News</h2>
    <div class="news-grid">
        <?php
        if ($result && $result->num_rows > 0) {
            $index = 0;
            while ($row = $result->fetch_assoc()) {
                // Set card type: first and last item = large, middle items = small
                $cardClass = ($index === 0 || $index === 3) ? 'large' : 'small';
                $tags = explode(',', $row['tags']);
                ?>
                <article class="news-card <?php echo $cardClass; ?>">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <div class="news-content">
                        <p class="news-meta">
                            <?php echo htmlspecialchars($row['author']) . ' • ' . date('j M Y', strtotime($row['publish_date'])); ?>
                        </p>
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <div class="news-tags">
                            <?php
                            // Loop through tags, convert to camelCase class names, display them
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
                $index++;
            }
        } else {
            echo "<p>No recent news available.</p>";
        }
        ?>
    </div>
</section>
