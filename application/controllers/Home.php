<?php
class Home extends CI_Controller
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
        if ($this->session->has_userdata('resepsionis') || $this->session->has_userdata('owner')) {
            $data['judul'] = 'Halaman Home';
            $data['total'] = $this->Checkin_model->getTotalCheckin();
            $data['active_home'] = 'active';
            $data['active_reg'] = '';
            $data['active_mem'] = '';
            $data['active_pro'] = '';
            $data['active_his'] = '';
            $data['member'] = $this->Checkin_model->getAllCheckin();
            if ($this->input->post('keyword')) {
                $data['member'] = $this->Checkin_model->cariDataMemberCheckIn();
            }

            $this->load->view('templates/header', $data);
            $this->load->view('home/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }
    public function tambah()
    {
        if ($this->session->has_userdata('resepsionis')) {
            $data['judul'] = 'Halaman Tambah Pengunjung';
            $data['active_home'] = 'active';
            $data['active_reg'] = '';
            $data['active_mem'] = '';
            $data['active_pro'] = '';
            $data['active_his'] = '';

            $data['member'] = $this->Member_model->getAllMember();
            if ($this->input->post('keyword')) {
                $data['member'] = $this->Member_model->cariDataMember();
            }
            $this->load->view('templates/header', $data);
            $this->load->view('home/tambah', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }
    public function checkin($id)
    {
        if ($this->session->has_userdata('resepsionis')) {
            // $data['member_checkin'] = $this->Checkin_model->
            // $this->load->view('templates/header', $data);
            // $this->load->view('home/index', $data);
            // $this->load->view('templates/footer');
            // $this->Member_model->tambahDataMember();
            $this->db->where('id', $id);
            $query = $this->Member_model->getMemberById($id);
            $cekDataCheckIn = $this->Checkin_model->cekDataCheckIn($id);
            if ($cekDataCheckIn) {
                $cekMasaBerlakuMember = $this->Member_model->cekMasaBerlakuMember($query);
                if ($cekMasaBerlakuMember) {
                    $this->Checkin_model->tambahDataCheckin($query);
                    redirect('home/tambahKunci/' . $id);
                } else {
                    $this->session->set_flashdata('memberExpire', '(sudah melewati masa berlaku member)');
                    redirect('home/tambah');
                }
            } else {
                $this->session->set_flashdata('dataCheckin', '(sudah pernah diinputkan ke dalam halaman Home)');
                redirect('home/tambah');
            }
        } else {
            redirect('auth');
        }
    }
    public function tambahKunci($id)
    {
        if ($this->session->has_userdata('resepsionis')) {
            $data['judul'] = 'Tambah Kunci';
            $data['active_home'] = 'active';
            $data['active_reg'] = '';
            $data['active_mem'] = '';
            $data['active_pro'] = '';
            $data['active_his'] = '';

            $data['member'] = $this->Member_model->getMemberById($id);
            $data['currentDate'] = $this->Member_model->getCurrentDate();
            $data['currentDate4Extend'] = $this->Member_model->getCurrentDateForExtend();
            $data['newMembershipExpireDate'] = $this->Member_model->getNewMembershipExpireDate();
            $data['extra1Month'] = $this->Member_model->getExtra1Month();
            $data['memberCheckin'] = $this->Checkin_model->getMemberCheckinById($id);
            $data['error'] = false;
// $data['cardExpireDate'] = $this->Member_model->getCardExpireDate();

// $data['newCardId'] = $this->Member_model->getNewCardId();
            $this->form_validation->set_rules('nama', 'Nama', 'required');
// $this->form_validation->set_rules('kadaluarsa_kartu', 'Masa Berlaku Kartu', 'required');
            // $this->form_validation->set_rules('alamat', 'Alamat', 'required');
            // $this->form_validation->set_rules('kadaluarsa_member', 'Tanggal Kadaluarsa Member', 'required');
            $this->form_validation->set_rules('kunci', 'Kunci Loker', 'required|numeric');

            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('home/tambahKunci', $data);
                $this->load->view('templates/footer');

            } else {
                // $this->Member_model->perpanjangDataMember();
                $cekKunciLoker = $this->Checkin_model->cekKunciLoker();
                if ($cekKunciLoker) {
                    $this->Checkin_model->tambahKunci();
                    $this->session->set_flashdata('flash', 'Added');
                    redirect('home');

                } else {
                    $data['error'] = true;
                    // redirect('home/tambahKunci/' . $id);
                    $this->load->view('templates/header', $data);
                    $this->load->view('home/tambahKunci', $data);
                    $this->load->view('templates/footer');

                }

            }

            //CEK APAKAH ID KARTU UDAH ADA DI TABEL CHECK IN
            // CEK APAKAH KUNCI LOKER SUDAH ADA DI TABEL CHECK IN
        } else {
            redirect('auth');
        }
    }
    public function hapus($check_id_or_id)
    {

        $query = $this->Checkin_model->getMemberCheckinByCheckId($check_id_or_id);
        // var_dump($query);
        if ($query['kunci'] != 0) {
            // $check_id_or_id = check_id
            $this->Checkin_model->hapusDataMemberCheckin($check_id_or_id);
            $this->session->set_flashdata('checkout', 'Riwayat pengunjung telah masuk ke halaman History');
            redirect('home/index');
        } elseif ($query['kunci'] == 0) {
            // $check_id_or_id = id
            $query = $this->Checkin_model->getMemberCheckinById($check_id_or_id);
            // $check_id_or_id = check_id karena setelah dieksekusi, check_id tergenerate
            $this->Checkin_model->hapusDataMemberCheckin($check_id_or_id);
            redirect('home/tambah');

        }

    }
    public function checkout($check_id)
    {
        var_dump($check_id);
        $checkout = $this->Checkin_model->getCurrentCheckoutTime();
        $query = $this->Checkin_model->getMemberCheckinByCheckId($check_id);
        var_dump($query);
        $this->Checkin_model->tambahDataCheckout($query, $checkout);
        $query = $this->Checkin_model->getMemberCheckinByCheckId($check_id);
        $this->History_model->tambahDataHistory($query);
        $this->hapus($check_id);

    }

    public function tambahNonMember()
    {
        if ($this->session->has_userdata('resepsionis')) {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('kunci', 'Kunci Loker', 'required|numeric');
            $data['error'] = false;
            $data['active_home'] = 'active';
            $data['active_reg'] = '';
            $data['active_mem'] = '';
            $data['active_pro'] = '';
            $data['active_his'] = '';

            if ($this->form_validation->run() == false) {
                $data['judul'] = 'Tambah Non Member';
                $this->load->view('templates/header', $data);
                $this->load->view('home/tambahNonMember', $data);
                $this->load->view('templates/footer');

            } else {
                // $this->Member_model->perpanjangDataMember();
                $cekKunciLoker = $this->Checkin_model->cekKunciLoker();
                if ($cekKunciLoker) {
                    $this->Checkin_model->tambahDataCheckinNonMember();
                    $this->session->set_flashdata('flash', 'Ditambahkan');
                    redirect('home');

                } else {
                    $data['error'] = true;
                    $this->load->view('templates/header', $data);
                    $this->load->view('home/tambahNonMember', $data);
                    $this->load->view('templates/footer');

                }
            }
        } else {
            redirect('auth');
        }

    }
}
