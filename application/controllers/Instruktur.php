<?php
class Instruktur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->model('Instruktur_model');
        $this->load->library('form_validation');
        //load library PAGINATION
        $this->load->library('pagination');

    }

    // public function index()
    // {
    //     if ($this->session->has_userdata('instruktur')) {
    //         $data['judul'] = 'Halaman Instruktur';
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('instruktur/index');
    //         $this->load->view('templates/footer');
    //     } else {
    //         redirect('auth');
    //     }
    // }
    public function hitungKalori($id = null)
    {
        if ($this->session->has_userdata('instruktur')) {
            $data['judul'] = 'Hitung Kalori';
            $data['memberId'] = $this->Member_model->getMemberById($id);

            $data['member'] = $this->Instruktur_model->getInstructorMemberById($id);

            $this->form_validation->set_rules('umur', 'Umur', 'required|numeric');
            $this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('tinggi', 'Tinggi Badan', 'required|numeric');
            $this->form_validation->set_rules('berat', 'Berat Badan', 'required|numeric');
            $this->form_validation->set_rules('goal', 'Tujuan', 'required');
            $this->form_validation->set_rules('activity', 'Level Aktivitas', 'required');
            $data['show'] = false;
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('instruktur/hitungKalori', $data);
                $this->load->view('templates/footer');
            } else {
                $umur = $this->input->post('umur');
                $jenisKelamin = $this->input->post('jenisKelamin');
                $tinggi = $this->input->post('tinggi');
                $berat = $this->input->post('berat');
                $goal = $this->input->post('goal');
                $activity = $this->input->post('activity');

                $data['hasilKalori'] = $this->Instruktur_model->hitungKalori($umur, $jenisKelamin, $tinggi, $berat, $goal, $activity);
                $data['hasilProtein'] = $this->Instruktur_model->hitungProtein($berat, $goal);
                $data['hasilLemak'] = $this->Instruktur_model->hitungLemak($data['hasilKalori']);
                $data['hasilKarbohidrat'] = $this->Instruktur_model->hitungKarbohidrat($data['hasilKalori']);

                $data['show'] = true;
                $this->Instruktur_model->setMemberCalorieInfo($data['memberId'], $umur, $jenisKelamin, $tinggi, $berat, $goal, $activity, $data['hasilKalori'], $data['hasilProtein'], $data['hasilLemak'], $data['hasilKarbohidrat']);
                $this->session->set_flashdata('kalori', 'Ditambahkan');
                $this->load->view('templates/header', $data);
                $this->load->view('instruktur/hitungKalori', $data);
                $this->load->view('templates/footer');
            }
        } else {
            redirect('auth');
        }

    }
    public function nutrisiMakanan($id)
    {
        if ($this->session->has_userdata('instruktur')) {
            $data['judul'] = 'Halaman Nutrisi Makanan';
            $data['total'] = $this->Member_model->getTotal();
            $data['totalAktif'] = $this->Member_model->getTotalAktif();
            $data['totalNonAktif'] = $this->Member_model->getTotalNonAktif();
            if ($data['member'] = $this->Instruktur_model->getInstructorMemberById($id)) {
                $data['empty'] = false;

                //config
                $config['base_url'] = 'http://localhost/skripsi/instruktur/nutrisiMakanan/' . $id . '/';
                $data['keywords'] = $this->input->post('keywords');
                $data['food'] = $this->session->userdata('keywords');

                $this->db->like('nama_makanan', $data['keywords']);
                $this->db->or_like('kelompok_makanan', $data['keywords']);
                $this->db->from('food');
                $config['total_rows'] = $this->db->count_all_results();
                $data['total_rows'] = $config['total_rows'];
                $config['per_page'] = 8;
                $config['num_links'] = 4;

                //initialize
                $data['start'] = $this->uri->segment(4);
                if ($a = $this->input->post('caris')) {
                    $data['keywords'] = $this->input->post('keywords');
                    $this->session->set_userdata('keywords', $data['keywords']);
                    $this->session->set_userdata('num_rows', $data['total_rows']);

                    if ($this->uri->segment(4)) {
                        $data['start'] = null;
                    }
                    $data['food'] = $this->Instruktur_model->getFoodNutrition($config['per_page'], $data['start'], $data['keywords']);
                } else {
                    $data['keywords'] = $this->session->userdata('keywords');
                    $config['total_rows'] = $this->session->userdata('num_rows');
                    $data['food'] = $this->Instruktur_model->getFoodNutrition($config['per_page'], $data['start'], $data['keywords']);
                }
                $this->pagination->initialize($config);

            } else {
                $data['empty'] = true;
                $data['id_member'] = $id;

            }

            $this->load->view('templates/header', $data);
            $this->load->view('instruktur/nutrisiMakanan', $data);
            $this->load->view('templates/footer');

            if ($this->input->post('simpan')) {
                $this->form_validation->set_rules('porsi', 'porsi', 'required|numeric');
                if ($this->form_validation->run() == false) {
                    // $this->load->view('templates/header', $data);
                    // $this->load->view('instruktur/nutrisiMakanan', $data);
                    // $this->load->view('templates/footer');
                    $this->session->set_flashdata('porsi', 'Porsi wajib diisi dan harus berupa angka');
                    redirect('instruktur/nutrisiMakanan/' . $data['member']['id']);
                } else {

                    $porsi = $this->input->post('pmPorsiNew');
                    $foodName = $this->input->post('pmNama_makanan_new');
                    $foodKalori = $this->input->post('pmKaloriNew');
                    $foodProtein = $this->input->post('pmProteinNew');
                    $foodLemak = $this->input->post('pmLemakNew');
                    $foodKarbohidrat = $this->input->post('pmKarbohidratNew');
                    $this->Instruktur_model->addMealPlan($data['member'], $porsi, $foodName, $foodKalori, $foodProtein, $foodLemak, $foodKarbohidrat);
                    $this->session->set_flashdata('mealPlan', 'Ditambahkan');
                    redirect('instruktur/nutrisiMakanan/' . $data['member']['id']);

                }
            }

        } else {
            redirect('auth');
        }
    }
    public function tambahMakanan()
    {
        if ($this->session->has_userdata('instruktur')) {
            $data['judul'] = 'Tambah Makanan';

            $this->form_validation->set_rules('nama_makanan', 'Nama Makanan', 'required');
            $this->form_validation->set_rules('berat_makanan', 'Berat Makanan', 'required|numeric');
            $this->form_validation->set_rules('kalori', 'Kalori', 'required|numeric');
            $this->form_validation->set_rules('protein', 'Protein', 'required|numeric');
            $this->form_validation->set_rules('lemak', 'Lemak', 'required|numeric');
            $this->form_validation->set_rules('karbohidrat', 'Karbohidrat', 'required|numeric');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('instruktur/tambahMakanan', $data);
                $this->load->view('templates/footer');
            } else {
                $this->Instruktur_model->tambahDataMakanan();
                $this->session->set_flashdata('makanan', 'Ditambahkan');
                redirect('instruktur/nutrisiMakanan');
            }
        } else {
            redirect('auth');
        }
    }
    public function index()
    {
        $data['judul'] = 'Halaman Instruktur';
// $data['member'] = $this->Member_model->getAllMember();

//config
        $config['base_url'] = 'http://localhost/skripsi/instruktur/index/';
        $data['total'] = $this->Member_model->getTotal();
        $data['keyword'] = $this->input->post('keyword');
        $data['member'] = $this->session->userdata('keyword');
        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('id', $data['keyword']);
        $this->db->or_like('alamat', $data['keyword']);
        $this->db->from('member');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 8;

//initialize

        $data['start'] = $this->uri->segment(3);
        if ($this->input->post('cari')) {
            $data['keyword'] = $this->input->post('keyword');
            if ($this->uri->segment(3)) {
                $data['start'] = null;
            }
            $this->session->set_userdata('keyword', $data['keyword']);
            $this->session->set_userdata('num_row', $data['total_rows']);
            $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);
        } else {

            $data['keyword'] = $this->session->userdata('keyword');
            $data['total_rows'] = $this->session->userdata('num_row');
            $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);

        }

        //menunjukkan awal mulai baris data per halaman
        // $data['member'] = $this->Member_model->getMembers($config['per_page'], $data['start'], $data['keyword']);
        // $this->session->userdata('keyword', $data['keyword']);
        $this->pagination->initialize($config);

        $this->load->view('templates/header', $data);
        $this->load->view('instruktur/index', $data);
        $this->load->view('templates/footer');

    }
    public function detail($id)
    {
        $data['judul'] = 'Halaman Detail';
        if ($data['member'] = $this->Instruktur_model->getInstructorMemberById($id)) {
            $data['mealPlan'] = $this->Instruktur_model->getMealPlan($id);
            $data['nutrisiSementara'] = $this->Instruktur_model->getNutrisiSementara($data['mealPlan']);
            $data['sisaNutrisi'] = $this->Instruktur_model->getSisaNutrisi($data['nutrisiSementara'], $data['member']);
            $data['empty'] = false;

        } else {
            $data['id_member'] = $id;
            $data['empty'] = true;
        }
        // $data['member'] = $this->Instruktur_model->getInstructorMemberById($id);
        // $data['mealPlan'] = $this->Instruktur_model->getMealPlan($id);
        // $data['nutrisiSementara'] = $this->Instruktur_model->getNutrisiSementara($data['mealPlan']);
        // $data['sisaNutrisi'] = $this->Instruktur_model->getSisaNutrisi($data['nutrisiSementara'], $data['member']);

        if ($this->input->post('update')) {
            $porsi = $this->input->post('pmPorsiNew');
            $foodName = $this->input->post('pmNama_makanan_new');
            $foodKalori = $this->input->post('pmKaloriNew');
            $foodProtein = $this->input->post('pmProteinNew');
            $foodLemak = $this->input->post('pmLemakNew');
            $foodKarbohidrat = $this->input->post('pmKarbohidratNew');
            $this->Instruktur_model->editMealPlan($data['member'], $porsi, $foodName, $foodKalori, $foodProtein, $foodLemak, $foodKarbohidrat);
            $this->session->set_flashdata('editMealPlan', 'Diubah');

            redirect('instruktur/detail/' . $id);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('instruktur/detail', $data);
        $this->load->view('templates/footer');

    }
    public function hapusMealPlan($id, $mealplan_id)
    {
        $this->Instruktur_model->hapusMealPlan($mealplan_id);
        $this->session->set_flashdata('hapusMealPlan', 'Dihapus');
        redirect('instruktur/detail/' . $id);

    }
    public function print_mealPlan($id)
    {
        if ($data['mealPlan'] = $this->Instruktur_model->getMealPlan($id)) {
            $this->load->view('instruktur/print_mealPlan', $data);
        } else {
            $this->load->view('instruktur/detail/' . $id);
        }

    }
}
