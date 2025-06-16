<?php namespace App\Controllers;

use App\Models\UserKaderModel;

class AuthController extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function doLogin()
    {
        $session = session();
        $model = new UserKaderModel();

        // Mendapatkan data dari form login
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Mencari data user berdasarkan username
        $user = $model->where('username', $username)->first();

        if ($user) {
            // Jika password plain yang dimasukkan sama dengan yang ada di database
            if (password_verify($password, $user['password'])) {
                // Jika password cocok, hash dan update password di database jika belum ter-hash
                if (!password_get_info($user['password'])['algo']) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $model->update($user['id'], ['password' => $hashedPassword]);
                }

                // Set session dengan data user
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'isLoggedIn' => true
                ]);

                // Redirect ke dashboard setelah login berhasil
                return redirect()->to('/admin/dashboard');
            } else {
                // Jika password salah
                $session->setFlashdata('error', 'Username atau password salah');
                return redirect()->to('/login');
            }
        } else {
            // Jika username tidak ditemukan
            $session->setFlashdata('error', 'Username atau password salah');
            return redirect()->to('/login');
        }
    }

    // Halaman logout
    public function logout()
    {
        // Hancurkan session
        session()->destroy();

        // Redirect ke halaman login setelah logout
        return redirect()->to('/login');
    }
}
