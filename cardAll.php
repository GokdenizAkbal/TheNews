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

<h2 class="news-heading">All News</h2>

<section class="news-section-all" id="all-news-list">
    <!-- News items will be injected here via AJAX -->
</section>

<div id="all-pagination"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadAllNews(1);

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('page-link') && !e.target.disabled) {
                const page = parseInt(e.target.getAttribute('data-page'), 10);
                if (!isNaN(page)) loadAllNews(page);
            }
        });
    });

    function loadAllNews(page) {
        fetch('fetchNews.php?page=' + page)
            .then(res => res.json())
            .then(data => {
                document.getElementById('all-news-list').innerHTML = data.itemsHtml;
                document.getElementById('all-pagination').innerHTML = data.paginationHtml;
            })
            .catch(err => {
                console.error(err);
                document.getElementById('all-news-list').innerHTML = '<p>Failed to load news.</p>';
            });
    }
</script>

