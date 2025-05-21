    <?php
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Content-Type: application/json");

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    require 'config.php';
    require 'library_db.php';

    $library = new Library($conn);
    $method = $_SERVER['REQUEST_METHOD'];

    $input = json_decode(file_get_contents('php://input'), true);

    switch ($method) {
        case 'GET':
            if (isset($_GET['id'])) {
                $book = $library->getLibrary($_GET['id']);
                echo json_encode($book);
            } else {
                $result = $library->getAllLibrary();
                $books = [];
                while ($row = $result->fetch_assoc()) {
                    $books[] = $row;
                }
                echo json_encode($books);
            }
            break;

        case 'POST':
            if ($library->addLibrary($input)) {
                http_response_code(201);
                echo json_encode(["message" => "Book added successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Failed to add book"]);
            }
            break;

        case 'PUT':
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(["error" => "ID is required"]);
                exit;
            }
            if ($library->updateLibrary($_GET['id'], $input)) {
                echo json_encode(["message" => "Book updated successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Failed to update book"]);
            }
            break;

        case 'DELETE':
            if (!isset($_GET['id'])) {
                http_response_code(400);
                echo json_encode(["error" => "ID is required"]);
                exit;
            }
            if ($library->deleteLibrary($_GET['id'])) {
                echo json_encode(["message" => "Book deleted successfully"]);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Failed to delete book"]);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Method not allowed"]);
            break;
    }
    ?>