<!-- <h2 class="news-heading">All News</h2>
<section class="news-section-all">


    <article class="news-card-all">
        <img src="Images/Mountain.png" alt="Mountain Photo" />
        <div class="news-content">
            <p class="news-meta">Alec Whitten • 1 Jan 2023</p>
            <h3>Bill Walsh leadership lessons</h3>
            <p>Like to know the secrets of transforming a 2-14 team into a 3x Super Bowl winning Dynasty?</p>
            <div class="news-tags">
                <span class="leadership">Leadership</span>
                <span class="management">Management</span>
                <span class="presentation">Presentation</span>
            </div>
        </div>
    </article>

    <article class="news-card-all">
        <img src="Images/Models.png" alt="PM Mental Models" />
        <div class="news-content">
            <p class="news-meta">Demi WIlkinson • 1 Jan 2023</p>
            <h3>PM mental models</h3>
            <p>Mental models are simple expressions of complex processes or relationships.</p>
            <div class="news-tags">
                <span class="product">Product</span>
                <span class="research">Research</span>
                <span class="frameworks">Frameworks</span>
            </div>
        </div>
    </article>

    <article class="news-card-all">
        <img src="Images/WireFrame.png" alt="WireFraming" />
        <div class="news-content">
            <p class="news-meta">Candice  Wu • 1 Jan 2023</p>
            <h3>What is Wireframing?</h3>
            <p>Introduction to Wireframing and its Principles. Learn from the best in the industry.</p>
            <div class="news-tags">
                <span class="design">Design</span>
                <span class="research">Research</span>
                <span class="presentation">Presentation</span>
            </div>
        </div>
    </article>

    <article class="news-card-all">
        <img src="Images/Colloboration.png" alt="Designer" />
        <div class="news-content">
            <p class="news-meta">Natali Craig • 1 Jan 2023</p>
            <h3>How collaboration makes us better designers</h3>
            <p>Collaboration can make our teams stronger, and our individual designs better.</p>
            <div class="news-tags">
                <span class="design">Design</span>
                <span class="research">Research</span>
                <span class="presentation">Presentation</span>

            </div>
        </div>
    </article>

    <article class="news-card-all">
        <img src="Images/Framework.png" alt="Software Developer" />
        <div class="news-content">
            <p class="news-meta">Drew Cano • 1 Jan 2023</p>
            <h3>Our top 10 Javascript frameworks to use</h3>
            <p>JavaScript frameworks make development easy with extensive features and functionalities..</p>
            <div class="news-tags">
                <span class="softwareDevelopment">Software Development</span>
                <span class="tools">Tools</span>
                <span class="saas">SaaS</span>
            </div>
        </div>
    </article>

    <article class="news-card-all">
        <img src="Images/Podcast.png" alt="Podcast" />
        <div class="news-content">
            <p class="news-meta">Orlando Diggs • 1 Jan 2023</p>
            <h3>Podcast: Creating a better CX Community</h3>
            <p>Starting a community doesn’t need to be complicated, but how do you get started?</p>
            <div class="news-tags">
                <span class="podcasts">Podcasts</span>
                <span class="customerSuccess">Customer Success</span>
                <span class="presentation">Presentation</span>
            </div>
        </div>
    </article>

</section> -->

<?php
include("databaseConnection.php");

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
