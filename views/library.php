<?php include 'views/header.php'; ?>

<?php if (!$viewBook): ?>
  <div class="alert alert-danger">Book not found.</div>
<?php else: ?>
  <div class="card shadow p-4">
    <h4 class="mb-3">Book Details</h4>
    <ul class="list-group">
      <li class="list-group-item"><strong>ID:</strong> <?= $viewBook['id'] ?></li>
      <li class="list-group-item"><strong>Title:</strong> <?= htmlspecialchars($viewBook['book_title']) ?></li>
      <li class="list-group-item"><strong>Author:</strong> <?= htmlspecialchars($viewBook['author_name']) ?></li>
      <li class="list-group-item"><strong>Genre:</strong> <?= htmlspecialchars($viewBook['genre']) ?></li>
      <li class="list-group-item"><strong>Publication Year:</strong> <?= htmlspecialchars($viewBook['publication_year']) ?></li>
      <li class="list-group-item"><strong>Quantity:</strong> <?= htmlspecialchars($viewBook['quantity']) ?></li>

      <?php if (!empty($viewBook['book_cover'])): ?>
        <li class="list-group-item">
          <strong>Cover:</strong><br>
          <img src="<?= htmlspecialchars($viewBook['book_cover']) ?>" alt="Book Cover" style="max-height: 180px;">
        </li>
      <?php endif; ?>
    </ul>
    <a href="index.php" class="btn btn-primary mt-3">Back to List</a>
  </div>
<?php endif; ?>
