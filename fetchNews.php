<?php
header('Content-Type: application/json; charset=UTF-8');

include 'databaseConnection.php';
include 'functions.php';

$perPage = 6;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Total count of news
$total = 0;
$countRes = $link->query("SELECT COUNT(*) AS total FROM news");
if ($countRes) {
    $row = $countRes->fetch_assoc();
    $total = (int)$row['total'];
}
$totalPages = max(1, ceil($total / $perPage));
if ($page > $totalPages) $page = $totalPages;

$offset = ($page - 1) * $perPage;

// Pull the news
$sql = "SELECT * FROM news ORDER BY publish_date DESC LIMIT $perPage OFFSET $offset";
$res = $link->query($sql);

// Items HTML
ob_start();
if ($res && $res->num_rows > 0) {
    while ($r = $res->fetch_assoc()) {
        $tags = array_map('trim', explode(',', $r['tags']));
        ?>
        <article class="news-card-all">
            <img src="<?php echo htmlspecialchars($r['image_path']); ?>" alt="<?php echo htmlspecialchars($r['title']); ?>" />
            <div class="news-content">
                <p class="news-meta">
                    <?php echo htmlspecialchars($r['author']) . ' • ' . date('j M Y', strtotime($r['publish_date'])); ?>
                </p>
                <h3><?php echo htmlspecialchars($r['title']); ?></h3>
                <p><?php echo htmlspecialchars($r['description']); ?></p>
                <div class="news-tags">
                    <?php
                    foreach ($tags as $tag) {
                        $cls = toCamelCase($tag);
                        $txt = ucwords($tag);
                        echo "<span class=\"$cls\">$txt</span>";
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
$itemsHtml = ob_get_clean();

// Pagination HTML
$paginationHtml = '';
if ($totalPages > 1) {
    $paginationHtml .= '<div class="pagination">';
    $prevDisabled = ($page <= 1) ? 'disabled' : '';
    $paginationHtml .= '<button class="page-link" data-page="'.($page-1).'" '.$prevDisabled.'>&laquo;</button>';
    for ($p=1;$p<=$totalPages;$p++){
        $active = ($p==$page)?'active':'';
        $paginationHtml .= '<button class="page-link '.$active.'" data-page="'.$p.'">'.$p.'</button>';
    }
    $nextDisabled = ($page >= $totalPages) ? 'disabled' : '';
    $paginationHtml .= '<button class="page-link" data-page="'.($page+1).'" '.$nextDisabled.'>&raquo;</button>';
    $paginationHtml .= '</div>';
}

echo json_encode([
    'itemsHtml' => $itemsHtml,
    'paginationHtml' => $paginationHtml
]);

$link->close();
