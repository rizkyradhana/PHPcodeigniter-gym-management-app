<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('Checkin_model');
        $this->load->model('History_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == false) {
            $data['judul'] = "Halaman login";
            $data['error'] = false;
            $this->load->view('templates/login_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/footer');
        } else if ($this->input->post('login')) {
            $user = $this->input->post('username');
            $pass = $this->input->post('password');
            $row = $this->db->get_where('user', ['username' => $user, 'password' => $pass])->row_array();
            $username = $row['username'];
            $password = $row['password'];
            $level = $row['level'];
            if ($user == $username && $pass == $password) {
                if ($level == 'resepsionis') {
                    $this->session->set_userdata('resepsionis', true);
                    redirect('home');
                } elseif ($level == 'owner') {
                    $this->session->set_userdata('owner', true);
                    redirect('history');
                } else {
                    $this->session->set_userdata('instruktur', true);
                    redirect('instruktur');
                }
            } else {
                $data['error'] = true;
                $this->load->view('templates/login_header', $data);
                $this->load->view('auth/login', $data);
                $this->load->view('templates/footer');

            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
