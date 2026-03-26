<?php
require_once "./config/Database.php";

class Student {
    private static function getDB() {
        $database = new Database();
        $db = $database->getConnection();
        self::initTable($db);
        return $db;
    }

    private static function initTable($db) {
        $query = "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            major VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $db->exec($query);

        // Optional: Seed with initial data if empty
        $check = $db->query("SELECT COUNT(*) FROM students")->fetchColumn();
        if ($check == 0) {
            $db->exec("INSERT INTO students (name, major) VALUES 
                ('Nguyễn Văn A', 'CNTT'),
                ('Trần Thị B', 'Kinh tế'),
                ('Lê Văn C', 'Điện tử');");
        }
    }

    public static function getPage($offset, $limit, $search = '') {
        $db = self::getDB();
        if ($search) {
            $search = "%$search%";
            $query = "SELECT * FROM students WHERE name LIKE :search OR major LIKE :search ORDER BY id DESC LIMIT :offset, :limit";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':search', $search);
        } else {
            $query = "SELECT * FROM students ORDER BY id DESC LIMIT :offset, :limit";
            $stmt = $db->prepare($query);
        }
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function count($search = '') {
        $db = self::getDB();
        if ($search) {
            $search = "%$search%";
            $query = "SELECT COUNT(*) FROM students WHERE name LIKE :search OR major LIKE :search";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':search', $search);
        } else {
            $query = "SELECT COUNT(*) FROM students";
            $stmt = $db->prepare($query);
        }
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public static function getById($id) {
        $db = self::getDB();
        $query = "SELECT * FROM students WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function add($name, $major) {
        $db = self::getDB();
        $query = "INSERT INTO students (name, major) VALUES (:name, :major)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':major', $major);
        return $stmt->execute();
    }

    public static function update($id, $name, $major) {
        $db = self::getDB();
        $query = "UPDATE students SET name = :name, major = :major WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':major', $major);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = self::getDB();
        $query = "DELETE FROM students WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function search($query) {
        $db = self::getDB();
        $search = "%$query%";
        $sql = "SELECT * FROM students WHERE name LIKE :search OR major LIKE :search ORDER BY id DESC";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
