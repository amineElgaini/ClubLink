<?php
// app/Controllers/AdminController.php
require_once __DIR__ . '/../Models/Student.php';

class AdminController extends Controller
{
    private Student $student;

    public function __construct()
    {
        $this->student = new Student();
    }

    public function index()
    {
        $students = $this->student->all();
        $this->view('admin/manage-students', ['students' => $students]);
    }

    public function update($id)
    {
        try {
            $this->student->update(
                (int) $id,
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email']
            );
            $_SESSION['success'] = "User updated successfully.";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error updating user: ";
        }

        header('Location: /admin/users');
        exit;
    }

    // POST /admin/users/delete
    public function destroy($id)
    {
        try {
            $this->student->delete((int) $id);
            $_SESSION['success'] = "User deleted successfully.";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error deleting user: ";
        }

        header('Location: /admin/users');
        exit;
    }
}
