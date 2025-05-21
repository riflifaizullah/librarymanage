<form method="POST" enctype="multipart/form-data" class="mb-4 p-3 bg-white rounded shadow">
    <h5><?= $editData ? 'Edit' : 'Add' ?> Book</h5>
    <input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="book_title" class="form-control" placeholder="Book Title" required
                value="<?= htmlspecialchars($editData['book_title'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <input type="text" name="author_name" class="form-control" placeholder="Author Name" required
                value="<?= htmlspecialchars($editData['author_name'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <input type="text" name="genre" class="form-control" placeholder="Genre"
                value="<?= htmlspecialchars($editData['genre'] ?? '') ?>">
        </div>
    </div>

    <div class="row g-2 mt-2">
        <div class="col-md-3">
            <input type="number" name="publication_year" class="form-control" placeholder="Publication Year"
                value="<?= htmlspecialchars($editData['publication_year'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <input type="number" name="quantity" class="form-control" placeholder="Quantity"
                value="<?= htmlspecialchars($editData['quantity'] ?? '') ?>">
        </div>
    </div>

    <!-- ✅ Image Upload Field -->
    <div class="row g-2 mt-2">
        <div class="col-md-6">
            <label for="book_cover" class="form-label">Book Cover (Image Upload)</label>
            <input type="file" name="book_cover" class="form-control" accept="image/*">
        </div>

        <?php if (!empty($editData['book_cover'])): ?>
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <p class="mb-1">Current Cover:</p>
                    <img src="<?= htmlspecialchars($editData['book_cover']) ?>" alt="Book Cover" style="max-height: 120px;">
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <button type="submit" name="save" class="btn btn-success"><?= $editData ? 'Update' : 'Save' ?></button>
        <?php if ($editData): ?>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        <?php endif; ?>
    </div>
</form>
