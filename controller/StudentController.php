<?php
require_once "./model/Student.php";

class StudentController {
    public function index() {
        $search = $_GET['search'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $total_students = Student::count($search);
        $students = Student::getPage($offset, $limit, $search);
        $total_pages = ceil($total_students / $limit);

        include "./view/student_list.php";
    }

    public function add() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $major = trim($_POST['major'] ?? '');

            if (empty($name) || empty($major)) {
                $errors[] = "Họ tên và Ngành học không được để trống.";
            } elseif (mb_strlen($name, 'UTF-8') < 3) {
                $errors[] = "Họ tên phải có ít nhất 3 ký tự.";
            }

            if (empty($errors)) {
                Student::add($name, $major);
                header("Location: index.php?action=list&success=add");
                exit();
            }
        }
        include "./view/student_form.php";
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php");
            exit();
        }

        $student = Student::getById($id);
        if (!$student) {
            header("Location: index.php");
            exit();
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $major = trim($_POST['major'] ?? '');

            if (empty($name) || empty($major)) {
                $errors[] = "Họ tên và Ngành học không được để trống.";
            } elseif (mb_strlen($name, 'UTF-8') < 3) {
                $errors[] = "Họ tên phải có ít nhất 3 ký tự.";
            }

            if (empty($errors)) {
                Student::update($id, $name, $major);
                header("Location: index.php?action=list&success=edit");
                exit();
            }
        }
        include "./view/student_form.php";
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Student::delete($id);
        }
        header("Location: index.php?action=list&success=delete");
        exit();
    }
}
?>
