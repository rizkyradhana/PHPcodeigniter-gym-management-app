<?php
class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->library('form_validation');
        //load library PAGINATION
        $this->load->library('pagination');

    }
    public function index()
    {
        if ($this->session->has_userdata('resepsionis') || $this->session->has_userdata('owner')) {
            $data['judul'] = 'Halaman Member';
            $data['active_home'] = '';
            $data['active_reg'] = '';
            $data['active_mem'] = 'active';
            $data['active_pro'] = '';
            $data['active_his'] = '';

            $data['total'] = $this->Member_model->getTotal();
            $data['totalAktif'] = $this->Member_model->getTotalAktif();
            $data['totalNonAktif'] = $this->Member_model->getTotalNonAktif();

            //config
            $config['base_url'] = 'http://localhost/skripsi/member/index';

            $data['keyword'] = $this->input->post('keyword');
            $data['member'] = $this->session->userdata('keyword');

            $this->db->like('nama', $data['keyword']);
            $this->db->or_like('id', $data['keyword']);
            // $this->db->or_like('kadaluarsa_kartu', $data['keyword']);
            // $this->db->or_like('kadaluarsa_member', $data['keyword']);
            $this->db->from('member');
            $config['total_rows'] = $this->db->count_all_results();
            $data['total_rows'] = $config['total_rows'];

            // $config['total_rows'] = $this->Member_model->countAllData();
            // $config['total_search'] = $this->db->count_all_results();
            //hitung total baris dari query yang terakhir dieksekusi/yg terakhir ada pada session
            // $data['total_search'] = $config['total_search'];
            $config['per_page'] = 8;

            //initialize
            $this->pagination->initialize($config);
            $data['start'] = $this->uri->segment(3);

            if ($a = $this->input->post('cari')) {
                $data['keyword'] = $this->input->post('keyword');
                if ($this->uri->segment(3)) {
                    $data['start'] = null;
                }

                $this->session->set_userdata('keyword', $data['keyword']);
                $this->session->set_userdata('num_rows', $data['total_rows']);

                //pakai session yang baru dibuat karena tombol cari ditekan
                // $this->session->set_userdata('num_row', $data['total_rows']);

                $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);

                // $data['member'] = $this->Member_model->cariDataMember();
                //data keyword telah masuk ke function cariDataMember()
            } elseif ($data['cekAktif'] = $this->input->post('cekAktif')) {
                // echo "data start dari : " . $data['start'];
                $data['member'] = $this->Member_model->getMemberAktif();
            } elseif ($data['cekNonAktif'] = $this->input->post('cekNonAktif')) {
                // echo "data start dari : " . $data['start'];
                $data['member'] = $this->Member_model->getMemberNonAktif();

            } else {
                $data['keyword'] = $this->session->userdata('keyword');
                $data['total_rows'] = $this->session->userdata('num_rows');
                //pakai session yang sudah di autofocus diawal (default nampil semua data)
                // $data['total_rows'] = $this->session->userdata('num_row');
                $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);
            }
            // $data['start'] = $this->uri->segment(3);
            //menunjukkan awal mulai baris data per halaman
            // $data['member'] = $this->Member_model->getAllMember();
            // if ($this->input->post('keyword')) {
            //     $data['member'] = $this->Member_model->cariDataMember();
            // }

            // $data['start'] = $this->uri->segment(3);
            // if ($data['cekAktif'] = $this->input->post('cekAktif')) {
            //     $this->session->unset_userdata('keyword');
            //     echo "data start dari : " . $data['start'];
            //     // $this->session->set_userdata('aktif', $data['start']);

            //     $data['member'] = $this->Member_model->getMemberAktif($config['per_page'], $data['start']);
            //     // $this->session->set_userdata('keyword', $data['keyword']);
            // $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);

            $this->load->view('templates/header', $data);
            $this->load->view('member/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }
    public function perpanjang($id)
    {
        $data['judul'] = 'Perpanjang Member';
        $data['active_home'] = '';
        $data['active_reg'] = '';
        $data['active_mem'] = 'active';
        $data['active_pro'] = '';
        $data['active_his'] = '';

        $data['member'] = $this->Member_model->getMemberById($id);
        $data['currentDate'] = $this->Member_model->getCurrentDate();
        $data['currentDate4Extend'] = $this->Member_model->getCurrentDateForExtend();
        $data['newMembershipExpireDate'] = $this->Member_model->getNewMembershipExpireDate();
        $data['extra1Month'] = $this->Member_model->getExtra1Month();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kadaluarsa_member', 'Tanggal Kadaluarsa Member', 'required');
        $this->form_validation->set_rules('pemasukan', 'Bayar', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('member/perpanjang', $data);
            $this->load->view('templates/footer');

        } else {
            $this->Member_model->perpanjangDataMember();
            $this->session->set_flashdata('flash', 'Diperpanjang');
            redirect('member');
        }

    }
}
