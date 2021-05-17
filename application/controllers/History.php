<?php
class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('Checkin_model');
        $this->load->model('History_model');
        $this->load->model('Produk_model');

        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    public function index()
    {
        $data['judul'] = 'Halaman History';
        $data['active_home'] = '';
        $data['active_reg'] = '';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = 'active';

        $data['memberHistory'] = $this->History_model->getAllHistory();
        if ($this->input->post('startDate') && $this->input->post('endDate')) {
            $startDate = $this->input->post('startDate');
            $endDate = $this->input->post('endDate');
            $data['memberHistory'] = $this->History_model->getTanggalMutasiHistory($startDate, $endDate);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('history/index');
        $this->load->view('templates/footer');
    }
    public function pengunjung()
    {
        $data['judul'] = 'History Pengunjung';
        $data['active_home'] = '';
        $data['active_reg'] = '';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = 'active';

        $data['memberHistory'] = $this->History_model->getAllHistory();
        if ($this->input->post('mutasi')) {
            if ($this->input->post('startDate') && $this->input->post('endDate')) {
                $data['startDate'] = $this->input->post('startDate');
                $data['endDate'] = $this->input->post('endDate');
                $data['memberHistory'] = $this->History_model->historyPengunjung($data['startDate'], $data['endDate']);
            } else {
                $this->session->set_flashdata('tanggal', 'tanggal awal dan tanggal akhir harap diisi');
                redirect('history/pengunjung');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('history/pengunjung', $data);
        $this->load->view('templates/footer');

    }
    public function penjualan()
    {
        $data['judul'] = 'History Penjualan';
        $data['active_home'] = '';
        $data['active_reg'] = '';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = 'active';

        $data['produk'] = $this->Produk_model->getAllProdukChart();
        $data['penjualanHistory'] = $this->History_model->getAllPenjualanHistory();
        if ($this->input->post('mutasi')) {
            if ($this->input->post('startDate') && $this->input->post('endDate')) {
                $data['startDate'] = $this->input->post('startDate');
                $data['endDate'] = $this->input->post('endDate');
                $data['penjualanHistory'] = $this->History_model->historyPenjualan($data['startDate'], $data['endDate']);
            } else {
                $this->session->set_flashdata('tanggal', 'tanggal awal dan tanggal akhir harap diisi');
                redirect('history/penjualan');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('history/penjualan', $data);
        $this->load->view('templates/footer');
    }
    public function pemasukan()
    {
        $data['judul'] = 'History Pemasukan Member';
        $data['active_home'] = '';
        $data['active_reg'] = '';
        $data['active_mem'] = '';
        $data['active_pro'] = '';
        $data['active_his'] = 'active';

        $data['pemasukanHistory'] = $this->History_model->getAllPemasukanHistory();
        // $data['totalPemasukan'] = $this->History_model->getPemasukan();
        if ($this->input->post('mutasi')) {
            if ($this->input->post('startDate') && $this->input->post('endDate')) {
                $data['startDate'] = $this->input->post('startDate');
                $data['endDate'] = $this->input->post('endDate');
                $data['pemasukanHistory'] = $this->History_model->historyPemasukan($data['startDate'], $data['endDate']);
            } else {
                $this->session->set_flashdata('tanggal', 'tanggal awal dan tanggal akhir harap diisi');
                redirect('history/pemasukan');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('history/pemasukan', $data);
        $this->load->view('templates/footer');

    }
}

// //BATAS KEMARIN
// //config
// $config['base_url'] = 'http://localhost/skripsi/history/index';

// $data['keyword'] = $this->input->post('keyword');
// $this->session->set_userdata('keyword', $data['keyword']);
// $this->db->or_like('id', $data['keyword']);
// $this->db->like('nama', $data['keyword']);
// $this->db->or_like('kadaluarsa_kartu', $data['keyword']);
// $this->db->or_like('kadaluarsa_member', $data['keyword']);
// $this->db->from('member');
// // $config['total_rows'] = $this->Member_model->countAllData();
// $config['total_rows'] = $this->db->count_all_results();
// //hitung total baris dari query yang terakhir dieksekusi/yg terakhir ada pada session
// $data['total_rows'] = $config['total_rows'];
// $config['per_page'] = 8;

// //initialize
// $this->pagination->initialize($config);

// if ($this->input->post('submit')) {
//     $data['keyword'] = $this->input->post('keyword');

//     $this->session->set_userdata('keyword', $data['keyword']);
//     //pakai session yang baru dibuat karena tombol cari ditekan
//     $data['member'] = $this->Member_model->cariDataMember();
//     //data keyword telah masuk ke function cariDataMember()
// } else {
//     $data['keyword'] = $this->session->userdata('keyword');
//     //pakai session yang sudah di autofocus diawal (default nampil semua data)

// }
// $data['start'] = $this->uri->segment(3);
// //menunjukkan awal mulai baris data per halaman
// $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);

// /// BATAS KEMARIN
