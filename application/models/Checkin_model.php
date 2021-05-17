<?php
class Checkin_model extends CI_model
{
    public function getAllCheckin()
    {
        $query = $this->db->get('check-in');
        return $query->result_array();
    }
    public function getMemberById($id)
    {
        return $this->db->get_where('check-in', ['id' => $id])->row_array();
    }
    public function tambahDataCheckin($query)
    {
        $data = array(
            'id' => $query['id'],
            'nama' => $query['nama'],
            'tipe' => 'member',
            'kadaluarsa_member' => $query['kadaluarsa_member'],

        );

        $this->db->insert('check-in', $data);
    }
    public function tambahKunci()
    {
        $data = array(
            // 'tanggal' => $this->input->post('tanggal', true),
            // 'nama' => $this->input->post('nama', true),
            // 'alamat' => $this->input->post('alamat', true),
            'kunci' => $this->input->post('kunci', true),
            // 'kadaluarsa_kartu' => $this->input->post('kadaluarsa_kartu', true),
        );
        $this->db->where('id', $this->input->post('id'));

        $this->db->update('check-in', $data);

    }
    public function cekKunciLoker()
    {
        $data = array(
            'kunci' => $this->input->post('kunci', true),
        );
        // $this->db->like('nama', $keyword);
        // $this->db->or_like('alamat', $keyword);
        // $this->db->or_like('id', $keyword);
        // $this->db->or_like('kadaluarsa_kartu', $keyword);
        // $this->db->or_like('tanggal', $keyword);
        $condition = $this->db->get_where('check-in', ['kunci' => $data['kunci']]);
        if ($condition->num_rows() == 0) {
            return true;
        } else {
            return false;
        }

    }
    public function cekDataCheckIn($id)
    {
        $data = array(
            'id' => $id,
        );
        $condition = $this->db->get_where('check-in', ['id' => $id]);
        if ($condition->num_rows() == 0) {
            return true;
        } else {
            return false;
        }

    }
    public function getMemberCheckinById($id)
    {
        return $this->db->get_where('check-in', ['id' => $id])->row_array();

    }
    public function getMemberCheckinByCheckId($check_id)
    {
        return $this->db->get_where('check-in', ['check_id' => $check_id])->row_array();

    }
    public function hapusDataMemberCheckin($id)
    {
        $this->db->where('check_id', $id);
        $this->db->delete('check-in');

    }
    public function cariDataMemberCheckIn()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('tipe', $keyword);
        $this->db->or_like('id', $keyword);
        $this->db->or_like('kadaluarsa_member', $keyword);
        $this->db->or_like('kunci', $keyword);
        $this->db->or_like('checkin', $keyword);

        return $this->db->get('check-in')->result_array();
    }
    public function getCurrentCheckoutTime()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tm = time();
        $currentDate = date('Y-m-d H:i:s', $tm);
        $date = new DateTime($currentDate);
        // $date->modify('+5 year');
        $waktunya = $date->format('Y-m-d H:i:s');
        // echo $waktunya;
        return $waktunya;
        // $tm = time();
        // $currentDate = date('Y-m-d h:i:s', $tm);
        // echo $currentDate;
        // return $currentDate;
    }
    public function tambahDataCheckout($query, $checkout)
    {
        // $date = strtotime($checkout);
        // echo date('d M Y', $date);
        // var_dump($query);
        // var_dump($checkout);
        $data = array(
            // 'checkout' => $checkout,
            'checkout' => $checkout,
        );
        // echo $checkout;

        $this->db->where('check_id', $query['check_id']);
        // echo $query['check_id'];
        // $this->db->delete('check-in');
        $this->db->update('check-in', $data);
    }
    public function tambahDataCheckinNonMember()
    {

        $data = array(
            'tipe' => $this->input->post('tipe', true),
            'nama' => $this->input->post('nama', true),
            'kunci' => $this->input->post('kunci', true),
            // 'id' => null,
            // 'kadaluarsa_member' => null,

        );
        $this->db->insert('check-in', $data);

        $tambahPemasukan = array(
            'nama' => $this->input->post('nama', true),
            'id' => 0,
            'tipe' => $this->input->post('tipe', true),
            'pemasukan' => 30000,
        );
        $this->db->insert('pemasukan', $tambahPemasukan);

    }
    public function getTotalCheckin()
    {
        $query = $this->db->get('check-in');
        return $query->num_rows();

    }

}
