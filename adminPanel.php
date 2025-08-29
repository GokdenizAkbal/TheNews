<?php
include ("head.php");
include("navbar.php");

// Pull tags from database
$newsTags = [
    'leadership,management,presentation',
    'product,research,frameworks',
    'design,research,presentation',
    'design,research,presentation',
    'softwareDevelopment,tools,saas',
    'podcasts,customerSuccess,presentation',
    'design,research,presentation',
    'design,research',
    'design,research',
    'design,interface'
];

// Combine tags and make unique
$allTags = [];
foreach($newsTags as $tagString) {
    $tags = explode(',', $tagString);
    foreach($tags as $tag) {
        $allTags[] = trim($tag);
    }
}
$uniqueTags = array_unique($allTags);
?>

<div id="content-wrapper">

    <h1 class="title">The News</h1>

    <div class="admin-panel">
        <!-- Add News Card -->
        <div class="admin-card">
            <h3>Add News</h3>
            <form id="addNewsForm" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Title" required>
                <textarea name="description" placeholder="Description" required></textarea>
                <input type="file" name="image" id="addImage" required>
                <img id="addImagePreview" class="image-preview" />
                <input type="text" name="author" placeholder="Author" required>
                <input type="date" name="publish_date" required>
                <select name="card_type" required>
                    <option value="">Select Card Type</option>
                    <option value="small">Small</option>
                    <option value="large">Large</option>
                </select>
                <select name="tags" required>
                    <option value="">Select Tag</option>
                    <?php foreach($uniqueTags as $tag): ?>
                        <option value="<?= htmlspecialchars($tag) ?>"><?= htmlspecialchars($tag) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="category" placeholder="Category" required>
                <button class="btn-add" type="submit">Add News</button>
            </form>
        </div>

        <!-- Edit / Delete News Card -->
        <div class="admin-card">
            <h3>Edit / Delete News</h3>

            <input type="number" id="newsIdInput" placeholder="News ID">
            <button type="button" id="fetchBtn" class="btn-green">Get Info</button>

            <form id="editForm" enctype="multipart/form-data">
                <input type="hidden" name="news_id" id="news_id">

                <input type="text" name="title" id="title" placeholder="Title">
                <textarea name="description" id="description" placeholder="Description"></textarea>

                <input type="file" name="image" id="image">
                <img id="imagePreview" class="image-preview">

                <input type="text" name="author" id="author" placeholder="Author">
                <input type="date" name="publish_date" id="publish_date">

                <select name="card_type" id="card_type">
                    <option value="">-- Select Card Type --</option>
                    <option value="small">Small</option>
                    <option value="large">Large</option>
                </select>

                <input type="text" name="tags" id="tags" placeholder="Tags">
                <input type="text" name="category" id="category" placeholder="Category">

                <div class="edit-delete-buttons">
                    <button type="button" id="editBtn" class="btn-green">Edit News</button>
                    <button type="button" id="deleteBtn" class="btn-red">Delete News</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Add News submit
    document.getElementById('addNewsForm').addEventListener('submit', function(e){
        e.preventDefault();
        const formData = new FormData(this);

        fetch('insertNews.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.text())
            .then(data => {
                alert(data);
                this.reset();
                document.getElementById('addImagePreview').style.display = 'none';
            })
            .catch(err => {
                console.error(err);
                alert('Bir hata oluştu!');
            });
    });

    // Image previews
    document.getElementById('addImage').addEventListener('change', function(event){
        const preview = document.getElementById('addImagePreview');
        const file = event.target.files[0];
        if(file){
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });

    document.getElementById('image').addEventListener('change', function(event){
        const preview = document.getElementById('imagePreview');
        const file = event.target.files[0];
        if(file){
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });

    // Fetch news by ID
    document.getElementById('fetchBtn').addEventListener('click', function(){
        const newsId = document.getElementById('newsIdInput').value;
        if(!newsId){ alert('Please enter a News ID.'); return; }

        fetch('fetchSingleNews.php?id=' + newsId)
            .then(res => res.json())
            .then(data => {
                if(data.error){
                    alert(data.error);
                    document.getElementById('editForm').style.display = 'none';
                    return;
                }

                // Fill form
                document.getElementById('editForm').style.display = 'block';
                document.getElementById('news_id').value = data.id;
                document.getElementById('title').value = data.title;
                document.getElementById('description').value = data.description;
                document.getElementById('author').value = data.author;
                document.getElementById('publish_date').value = data.publish_date;
                document.getElementById('card_type').value = data.card_type;
                document.getElementById('tags').value = data.tags;
                document.getElementById('category').value = data.category;
                document.getElementById('imagePreview').src = data.image_path || '';
            })
            .catch(err => console.error(err));
    });

    // Edit News
    document.getElementById('editBtn').addEventListener('click', function(){
        const formData = new FormData(document.getElementById('editForm'));

        fetch('editNews.php', {
            method: 'POST',
            body: formData
        })
            .then(res => res.text())
            .then(data => {
                alert(data);
                document.getElementById('editForm').reset();
                document.getElementById('editForm').style.display = 'none';
                document.getElementById('imagePreview').src = '';

                document.getElementById('newsIdInput').value = '';
            })
            .catch(err => { console.error(err); alert('Bir hata oluştu!'); });
    });

    // Delete News
    document.getElementById('deleteBtn').addEventListener('click', function(){
        const newsId = document.getElementById('news_id').value;
        if(!newsId){ alert('News ID eksik!'); return; }
        if(!confirm('Are you sure you want to delete this news?')) return;

        fetch('deleteNews.php', {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded'},
            body: 'news_id=' + encodeURIComponent(newsId)
        })
            .then(res => res.text())
            .then(data => {
                alert(data);
                document.getElementById('editForm').reset();
                document.getElementById('editForm').style.display = 'none';
                document.getElementById('imagePreview').src = '';

                document.getElementById('newsIdInput').value = '';
            })
            .catch(err => { console.error(err); alert('Bir hata oluştu!'); });
    });
</script>

<?php
include("footer.php");
?>
