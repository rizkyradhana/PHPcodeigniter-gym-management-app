<?php
class Produk_model extends CI_Model
{
    public function getAllProduk()
    {
        $query = $this->db->get('produk');
        return $query->result_array();
    }
    public function getAllProdukChart()
    {
        $this->db->select('nama, harga');
        $query = $this->db->get('produk');
        return $query->result_array();

    }
    public function getAllCart()
    {
        $query = $this->db->get('cart');
        return $query->result_array();
    }
    public function tempBeli()
    {
        $query = $this->db->get('beli');
        return $query->result_array();

    }
    public function hapus()
    {
        $this->db->empty_table('cart');

    }
    public function hapusCart($idCart)
    {
        // $produk_id = $this->uri->segment(3);
        // $nama = $this->uri->segment(4);
        // $jumlah = $this->uri->segment(5);
        // $this->db->where('id', $id);
        $tables = array('cart', 'beli');
        $this->db->where('id', $idCart);
        $this->db->delete($tables);

    }
    public function addToCart()
    {
        $produk_id = $this->input->post('produk_id', true);
        $harga = $this->input->post('harga', true);
        $jumlah = $this->input->post('jumlah', true);
        $total = $harga * $jumlah;

        $data = array(
            'produk_id' => $this->input->post('produk_id', true),
            'nama' => $this->input->post('nama', true),
            'jumlah' => $this->input->post('jumlah', true),
            'harga' => $this->input->post('harga', true),
            'total' => $total,
        );
        $this->db->insert('cart', $data);
        $this->db->insert('beli', $data);

    }
    public function hapusStok($produkId, $stokProduk, $jumlah)
    {
        $stokTerbaru = $stokProduk - $jumlah;
        // var_dump($stokTerbaru);
        // var_dump($produkId);

        $data = array(
            'stok' => $stokTerbaru,
        );
        $this->db->where('produk_id', $produkId);
        $this->db->update('produk', $data);

    }
    public function cancelStok($produk_id, $jumlah, $stokProduk)
    {
        $stokTerbaru = $stokProduk + $jumlah;
        $data = array(
            'stok' => $stokTerbaru,
        );
        $this->db->where('produk_id', $produk_id);
        $this->db->update('produk', $data);

    }
    public function getProdukById($produk_id)
    {
        return $this->db->get_where('produk', ['produk_id' => $produk_id])->row_array();

    }
    public function addStock($produk_id, $stokProduk, $jumlah)
    {
        $stokTerbaru = $stokProduk + $jumlah;
        $data = array(
            'stok' => $stokTerbaru,
        );
        $this->db->where('produk_id', $produk_id);
        $this->db->update('produk', $data);

    }
}
