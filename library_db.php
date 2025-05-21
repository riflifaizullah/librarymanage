<?php
class Library {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all books
    public function getAllLibrary() {
        $sql = "SELECT * FROM library";
        return $this->conn->query($sql);
    }

    // Get one book by ID
    public function getLibrary($id) {
        $stmt = $this->conn->prepare("SELECT * FROM library WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Add a new book
    public function addLibrary($data) {
        $stmt = $this->conn->prepare("INSERT INTO library (book_title, author_name, book_cover, genre, publication_year, quantity) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssbsii",
            $data['book_title'],
            $data['author_name'],
            $data['book_cover'],      // note: might need special handling for blobs
            $data['genre'],
            $data['publication_year'],
            $data['quantity']
        );
        return $stmt->execute();
    }

    // Update a book
    public function updateLibrary($id, $data) {
        $stmt = $this->conn->prepare("UPDATE library SET book_title=?, author_name=?, book_cover=?, genre=?, publication_year=?, quantity=? WHERE id=?");
        $stmt->bind_param(
            "ssbsiii",
            $data['book_title'],
            $data['author_name'],
            $data['book_cover'],  // again, special handling might be needed
            $data['genre'],
            $data['publication_year'],
            $data['quantity'],
            $id
        );
        return $stmt->execute();
    }

    // Delete a book
    public function deleteLibrary($id) {
        $stmt = $this->conn->prepare("DELETE FROM library WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
