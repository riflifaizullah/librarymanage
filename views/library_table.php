<table class="table table-bordered table-striped bg-white shadow">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Book Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publication Year</th>
            <th>Quantity</th>
            <th>Cover</th> <!-- ✅ New column -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['book_title']) ?></td>
                <td><?= htmlspecialchars($row['author_name']) ?></td>
                <td><?= htmlspecialchars($row['genre']) ?></td>
                <td><?= htmlspecialchars($row['publication_year']) ?></td>
                <td><?= htmlspecialchars($row['quantity']) ?></td>
                <td>
                    <?php if (!empty($row['book_cover'])): ?>
                        <img src="<?= htmlspecialchars($row['book_cover']) ?>" alt="Cover" style="max-height: 60px;">
                    <?php else: ?>
                        <span class="text-muted">No Cover</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this book?')" class="btn btn-sm btn-danger">Delete</a>
                    <a href="?view=<?= $row['id'] ?>" class="btn btn-sm btn-info">View</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
