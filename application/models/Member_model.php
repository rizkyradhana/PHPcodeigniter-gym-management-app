<?php

class Member_model extends CI_model
{
    public function getAllMember()
    {
        $query = $this->db->get('member');
        return $query->result_array();
    }
    public function tambahDataMember($newCardId)
    {
        $data = array(
            // 'tanggal' => $this->input->post('tanggal', true),
            'nama' => $this->input->post('nama', true),
            'alamat' => $this->input->post('alamat', true),
            'kadaluarsa_member' => $this->input->post('kadaluarsa_member', true),
            'kadaluarsa_kartu' => $this->input->post('kadaluarsa_kartu', true),
        );

        $this->db->insert('member', $data);
        $tambahPemasukan = array(
            'nama' => $this->input->post('nama', true),
            'id' => $newCardId['id'] + 1,
            'tipe' => 'Member Baru',
            'pemasukan' => 200000,
        );
        $this->db->insert('pemasukan', $tambahPemasukan);
    }
    public function getCurrentDate()
    {
        $tm = time();
        $currentDate = date('Y-m-d', $tm);
        return $currentDate;
    }
    public function getCurrentDateForExtend()
    {
        $tm = time();
        $currentDate = date('j F, Y', $tm);
        return $currentDate;
    }
    public function getCardExpireDate()
    {
        $tm = time();
        $currentDate = date('j F, Y', $tm);
        $date = new DateTime($currentDate);
        $date->modify('+5 year');
        return $date->format('Y-m-d');
        // date('Y-m-d')

    }
    public function getNewCardId()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('member');
        return $query->row_array();

    }
    public function hapusDataMember($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('member');

    }
    public function getMemberById($id)
    {
        return $this->db->get_where('member', ['id' => $id])->row_array();
    }
    public function ubahDataMember()
    {
        $data = array(
            'tanggal' => $this->input->post('tanggal', true),
            'nama' => $this->input->post('nama', true),
            'alamat' => $this->input->post('alamat', true),
            // 'kadaluarsa_member' => $this->input->post('kadaluarsa_member', true),
            'kadaluarsa_kartu' => $this->input->post('kadaluarsa_kartu', true),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('member', $data);
    }
    public function cariDataMember()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('id', $keyword);

        return $this->db->get('member')->result_array();
    }
    public function perpanjangDataMember()
    {
        $data = array(
            // 'tanggal' => $this->input->post('tanggal', true),
            // 'nama' => $this->input->post('nama', true),
            // 'alamat' => $this->input->post('alamat', true),
            'kadaluarsa_member' => $this->input->post('kadaluarsa_member', true),
            // 'kadaluarsa_kartu' => $this->input->post('kadaluarsa_kartu', true),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('member', $data);

        if ($this->input->post('pemasukan') > 150000) {
            //150 diubah. awalnya 0
            $pemasukan = $this->input->post('pemasukan');
        } else {
            $pemasukan = 150000;
        }
        $tambahPemasukan = array(
            'nama' => $this->input->post('nama', true),
            'id' => $this->input->post('id', true),
            'tipe' => 'Perpanjang Member',
            'pemasukan' => $pemasukan,
        );
        $this->db->insert('pemasukan', $tambahPemasukan);

    }
    public function getNewMembershipExpireDate()
    {
        $tm = time();
        $currentDate = date('j F, Y', $tm);
        $date = new DateTime($currentDate);
        $date->modify('+1 month');
        return $date->format('j F, Y');
        // date('Y-m-d')

    }
    public function getExtra1Month()
    {
        $tm = time();
        $currentDate = date('j F, Y', $tm);
        $date = new DateTime($currentDate);
        $date->modify('+1 month');
        return $date->format('Y-m-d');
        // date('Y-m-d')

    }
    public function cekMasaBerlakuMember($query)
    {
        $dbtimestamp = strtotime($query['kadaluarsa_member']);
        if (time() < $dbtimestamp) {
            return true;
        }

    }
    public function getMembers($limit, $start = null, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('alamat', $keyword);
            $this->db->or_like('id', $keyword);

        }
        $query = $this->db->get('member', $limit, $start);
        return $query->result_array();
    }
    public function countAllData()
    {
        return $this->db->get('member')->num_rows();
    }
    public function x($keyword)
    {
        $date = strtotime($keyword);
        $mbr['kadaluarsa_kartu'] = date('d M Y', $date);

    }
    public function getTotal()
    {
        $query = $this->db->get('member');
        return $query->num_rows();

    }
    public function getTotalAktif()
    {
        $tm = time();
        $currentDate = date('Y-m-d', $tm);

        $this->db->where('kadaluarsa_member >=', $currentDate);
        $query = $this->db->get('member');
        return $query->num_rows();

//         $date = strtotime($startDate);
        // $startDate = date('Y-m-d H:i:s', $date);

// $date2 = strtotime($endDate);
        // $endDate = date('Y-m-d H:i:s', $date2);

// // if ($date == $date2) {
        // $endDate = new DateTime($endDate);
        // $endDate->modify('+1 day');
        // $endDate = $endDate->format('Y-m-d H:i:s');
        // // echo "$endDate ";
        // // }

// $this->db->where('checkin >=', $startDate);
        // // $this->db->where('checkin =', $startDate);
        // $this->db->where('checkin <=', $endDate);
        // $query = $this->db->get('history');
        // return $query->result_array();

    }
    public function getTotalNonAktif()
    {
        $tm = time();
        $currentDate = date('Y-m-d', $tm);

        $this->db->where('kadaluarsa_member <', $currentDate);

        $query = $this->db->get('member');
        return $query->num_rows();

    }
    public function getMemberAktif()
    {
        $tm = time();
        $currentDate = date('Y-m-d', $tm);

        $this->db->where('kadaluarsa_member >=', $currentDate);

        $query = $this->db->get('member');
        return $query->result_array();

    }
    public function getMemberNonAktif()
    {
        $tm = time();
        $currentDate = date('Y-m-d', $tm);

        $this->db->where('kadaluarsa_member <', $currentDate);

        $query = $this->db->get('member');
        return $query->result_array();

    }

}
