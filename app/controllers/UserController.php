<?php
require_once '../app/services/MailService.php';

class UserController extends Controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $role = 'customer';
            $userModel = $this->model('User');
            $userModel->register($username, $password, $email, $phone, $role);
            header('Location: ?controller=user&action=login');
        } else {
            $this->view('user/register');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $userModel = $this->model('User');
            $user = $userModel->login($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'phone' => $user['phone'],
                    'address' => $user['address'],
                    'role' => $user['role']
                ];
                if ($user['role'] === 'admin') {
                    header('Location: ?controller=admin&action=index');
                    exit;
                }
                // Redirect và exit để không chạy tiếp code
                header('Location: ?controller=home&action=index');
                exit;
            } else {
                // Đăng nhập sai: load lại form + lỗi
                $error = "Sai tài khoản hoặc mật khẩu!";
                $this->view('user/login', ['error' => $error, 'username' => $username]);
            }
        } else {
            // Lần đầu load form login
            $this->view('user/login');
        }
    }

    public function logout()
    {

        unset($_SESSION['user']);
        header('Location: index.php');
    }

    public function search()
    {

        if ($_SESSION['user']['role'] != 'admin') {
            die('Bạn không có quyền truy cập!');
        }
        $userModel = $this->model('User');
        $page = $_GET['page'] ?? 1;
        $perPage = $_GET['perPage'] ?? 20;
        $users = $userModel->searchUser([
            'keyword' => $_GET['keyword'] ?? '',
            'role' => $_GET['role'] ?? ''
        ], $perPage, ($page - 1) * $perPage);
        $total = $userModel->countUser([
            'keyword' => $_GET['keyword'] ?? '',
            'role' => $_GET['role'] ?? ''
        ]);
        $this->view('admin/user/index', [
            'users' => $users,
            'current_page' => $page,
            'total' => $total,
            'total_pages' => ceil($total / $perPage),
        ]);
    }

    public function profile()
    {

        if (!isset($_SESSION['user'])) {
            header('Location: ?controller=user&action=login');
        } else {
            $userId = $_SESSION['user']['id'];
            $userModel = $this->model('User');
            $user = $userModel->getUserById($userId);

            // Gửi dữ liệu tới view
            $this->view('user/profile', ['user' => $user]);
        }
    }

    public function edit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $userModel->update($_POST['id'], $_POST['username'], $_POST['email'], $_POST['role'], $_POST['phone'], $_POST['address']);
            header('Location: ?controller=user&action=search');
        } else {
            $userId = $_GET['id'];
            $userModel = $this->model('User');
            $user = $userModel->getUserById($userId);

            $this->view('admin/user/edit', ['user' => $user]);
        }
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $userModel->add($_POST['username'], '12345678', $_POST['email'], $_POST['role'], $_POST['phone'], $_POST['address']);
            header('Location: ?controller=user&action=search');
        } else {
            $this->view('admin/user/add');
        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $userModel->delete($_POST['id']);
            header('Location: ?controller=user&action=search');
        }
    }

    public function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newPassword = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $userId = $_POST['id'] ?? '';
            if ($newPassword != $confirmPassword) {
                $this->view('user/reset-password', ['user_id' => $userId, 'error' => 'Mật khẩu không khớp']);
            }
            $userModel = $this->model('User');
            $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $userModel->updatePassword($userId, $newPassword);
            $this->view('user/login');
        } else {
            $token = $_GET['token'] ?? '';
            $passwordResetModel = $this->model('PasswordReset');
            $user = $passwordResetModel->getResetToken($token);
            if ($user) {
                $this->view('user/reset-password', ['user_id' => $user['user_id']]);
            } else {
                $this->view('404');
            }
        }
    }

    public function forgotPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            // Check if the email exists
            $userModel = $this->model('User');
            $user = $userModel->getUserByEmail($email);

            if ($user) {
                // Generate token
                $token = bin2hex(random_bytes(50));
                $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour

                // Save the reset token in the database
                $resetModel = $this->model('PasswordReset');
                $resetModel->saveResetToken($user['id'], $token, $expiresAt);

                // Send reset email
                $this->sendResetEmail($email, $token);

                // Success message
                $this->view('user/forgot_password', ['success' => 'Vui lòng kiểm tra hòm thư email của bạn']);
            } else {
                $this->view('user/forgot_password', ['error' => 'Không tìm thấy địa chỉ email']);
            }
        } else {
            $this->view('user/forgot_password');
        }
    }

    private function sendResetEmail($email, $token)
    {
        $resetLink = "http://localhost/banhangMVC/public?controller=user&action=resetPassword&token=$token";

        $subject = 'Password Reset Request';
        $message = "<html><body><p>Chào bạn,</p><p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu của bạn. Để thực hiện việc này, vui lòng nhấp vào liên kết dưới đây:</p><p><a href='$resetLink' style='background-color: #3498db; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Đặt lại mật khẩu</a></p><p>Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này.</p><p>Trân trọng,<br><strong>HHStore</strong></p></body></html>";

        MailService::send($email, $subject, $message);
    }
}
