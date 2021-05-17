<?php
class Registrasi extends CI_Controller
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

        $data['judul'] = 'Halaman Registrasi';
        // $data['member'] = $this->Member_model->getAllMember();
        $data['active_home'] = '';
        $data['active_reg'] = 'active';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = '';

        //config
        $config['base_url'] = 'http://localhost/skripsi/registrasi/index';
        $data['total'] = $this->Member_model->getTotal();
        $data['keyword'] = $this->input->post('keyword');
        $data['member'] = $this->session->userdata('keyword');
        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('id', $data['keyword']);
        $this->db->or_like('alamat', $data['keyword']);

        // $bulan = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
        // for ($i = 0; $i < count($bulan); $i++) {
        //     if ($bulan[$i] == $data['keyword']) {
        //         $this->db->or_like('tanggal', $i + 1);
        //         $this->db->or_like('kadaluarsa_kartu', $i + 1);
        //         echo "gurinjay ";
        //     }
        // }
        // if (ctype_digit($data['keyword'])) {
        //     echo substr($data['keyword'], 0, 2);
        //     $a = substr($data['keyword'], 0, 2);
        //     $this->db->or_like('tanggal', $a);
        //     $this->db->or_like('kadaluarsa_kartu', $a);

        // }

        $this->db->from('member');
        // $config['total_rows'] = $this->Member_model->countAllData();
        // $data['total_rows'] = $this->session->userdata(s'num_row');

        $config['total_rows'] = $this->db->count_all_results();

        //hitung total baris dari query yang terakhir dieksekusi/yg terakhir ada pada session
        $data['total_rows'] = $config['total_rows'];
        // $this->session->set_userdata('num_row', $data['total_rows']);

        $config['per_page'] = 8;

        //initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        if ($this->input->post('cari')) {
            $data['keyword'] = $this->input->post('keyword');
            if ($this->uri->segment(3)) {
                $data['start'] = null;
            }
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->session->set_userdata('num_row', $data['total_rows']);
            //pakai session yang baru dibuat karena tombol cari ditekan
            // $data['member'] = $this->Member_model->cariDataMember();
            $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);

            //data keyword telah masuk ke function cariDataMember()
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $data['total_rows'] = $this->session->userdata('num_row');

            //pakai session yang sudah di autofocus diawal (default nampil semua data)

        }
        ;
        //menunjukkan awal mulai baris data per halaman
        $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);
        // $this->session->userdata('keyword', $data['keyword']);
        $this->load->view('templates/header', $data);
        $this->load->view('registrasi/index', $data);
        $this->load->view('templates/footer');
    }
    public function tambah()
    {
        $data['judul'] = 'Tambah Member';
        $data['active_home'] = '';
        $data['active_reg'] = 'active';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = '';

        $data['currentDate'] = $this->Member_model->getCurrentDate();
        $data['cardExpireDate'] = $this->Member_model->getCardExpireDate();
        $data['extra1Month'] = $this->Member_model->getExtra1Month();
        $data['newCardId'] = $this->Member_model->getNewCardId();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kadaluarsa_kartu', 'Masa Berlaku Kartu', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kadaluarsa_member', 'Tanggal Kadaluarsa Member', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('registrasi/tambah', $data);
            $this->load->view('templates/footer');

        } else {
            $this->Member_model->tambahDataMember($data['newCardId']);

            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('registrasi');
        }

    }
    public function hapus($id)
    {
        $this->Member_model->hapusDataMember($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('registrasi');
    }

    public function ubah($id)
    {
        $data['judul'] = 'Ubah Member';
        $data['active_home'] = '';
        $data['active_reg'] = 'active';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = '';

        $data['member'] = $this->Member_model->getMemberById($id);
        $data['currentDate'] = $this->Member_model->getCurrentDate();
        $data['cardExpireDate'] = $this->Member_model->getCardExpireDate();
        $data['newCardId'] = $this->Member_model->getNewCardId();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kadaluarsa_kartu', 'Masa Berlaku Kartu', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        // $this->form_validation->set_rules('kadaluarsa_member', 'Tanggal Kadaluarsa Member', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('registrasi/ubah', $data);
            $this->load->view('templates/footer');

        } else {
            $this->Member_model->ubahDataMember();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('registrasi');
        }

    }

}
