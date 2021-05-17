<?php
class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
        $this->load->library('form_validation');
        $this->load->model('Produk_model');
        //load library PAGINATION
        $this->load->library('pagination');

    }
    public function index()
    {
        if ($this->session->has_userdata('resepsionis') || $this->session->has_userdata('owner')) {
            $data['judul'] = "Halaman Produk";
            $data['active_home'] = '';
            $data['active_reg'] = '';
            $data['active_mem'] = '';
            $data['active_pro'] = 'active';
            $data['active_his'] = '';

            $data['produk'] = $this->Produk_model->getAllProduk();
            $data['dataCart'] = $this->Produk_model->getAllCart();
            // $data['tanggal'] = $this->Member_model->getCurrentDate();
            $data['cart'] = $this->input->post('cart');
            // $data['hapusCart'] = $this->input->get()
            if ($this->input->post('cart')) {
                if ($this->input->post('stok') - $this->input->post('jumlah') >= 0) {
                    $this->Produk_model->addToCart();
                    $jumlah = $this->input->post('jumlah', true);
                    echo $jumlah;
                    $this->hapusStok($this->input->post('produk_id', true), $this->input->post('stok', true), $jumlah);
                    $this->session->set_flashdata('cart', 'Ditambahkan');
                    redirect('produk');
                } else {
                    $this->session->set_flashdata('noStok', 'Stok Tidak Cukup');
                    redirect('produk');
                }
            }
            // $checkout = false;
            if ($this->input->post('checkout')) {
                $data['dataCart'] = $this->Produk_model->getAllCart();
                $data['cart'] = $data['dataCart'];

                // $data['number'] = 123;
                // $dataCart = $data['dataCart'];
                // $this->hapus();
                // $this->session->set_flashdata('checkout', 'Berhasil');

                // if ($this->input->post('checkout')) {
                //     $this->hapus();
                //     $this->session->set_flashdata('checkout', 'Berhasil');
                // }
                // $checkout = true;
                redirect('produk/invoice/');
            }
            // if ($checkout == true) {
            //     $this->hapus();
            //     $this->session->set_flashdata('checkout', 'Berhasil');

            // }
            $this->load->view('templates/header', $data);
            $this->load->view('produk/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }
    public function hapus()
    {
        $this->Produk_model->hapus();

    }
    public function hapusCart($idCart, $produk_id, $jumlah)
    {
        $this->cancelStok($produk_id, $jumlah);
        // echo "ayamdsa ";
        // var_dump($produk_id);
        // var_dump($jumlah);
        $this->Produk_model->hapusCart($idCart);
        $this->session->set_flashdata('hapusCart', 'Berhasil Dihapus');
        // $idCart = $this->uri->segment(3);
        // $produk_id = $this->uri->segment(4);
        // $jumlah = $this->uri->segment(5);
        // var_dump($produk_id);
        // var_dump($nama);
        // var_dump($jumlah);

        // $produk = $this->Produk_model->getProdukById($produk_id);
        // var_dump($produk);
        // $this->Produk_model->cancelStok($nama, $jumlah, $produk['produk_id']);

        redirect('produk');

    }
    public function hapusStok($produkId, $stokProduk, $jumlah)
    {
        // var_dump($namaProduk);
        // var_dump($stokProduk);
        $this->Produk_model->hapusStok($produkId, $stokProduk, $jumlah);
    }
    public function cancelStok($produk_id, $jumlah)
    {
        // echo "ayam ";
        $produk = $this->Produk_model->getProdukById($produk_id);
        // var_dump($produk);
        // echo $produk['stok'];
        $this->Produk_model->cancelStok($produk_id, $jumlah, $produk['stok']);

    }
    public function tambahStok($produk_id)
    {
        $data['judul'] = 'Tambah Stok Suplemen';
        $data['active_home'] = '';
        $data['active_reg'] = '';
        $data['active_mem'] = '';
        $data['active_pro'] = 'active';
        $data['active_his'] = '';

        $data['produk'] = $this->Produk_model->getProdukById($produk_id);
        $this->form_validation->set_rules('addStok', 'Jumlah Tambahan Suplemen', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('produk/tambahStok', $data);
            $this->load->view('templates/footer');

        } else {
            $this->Produk_model->addStock($produk_id, $data['produk']['stok'], $this->input->post('addStok'));
            $this->session->set_flashdata('addStok', 'Diperbarui');
            redirect('produk');
        }

    }
    public function invoice()
    {

        // $data['number'] = 123;
        $data['dataCart'] = $this->Produk_model->getAllCart();
        $data['cart'] = $data['dataCart'];
        $this->hapus();
        $this->session->set_flashdata('checkout', 'Berhasil');

        $this->load->view('produk/invoice', $data);
        // redirect('produk');

    }

}
