<?php
class History_model extends CI_model
{
    public function tambahDataHistory($query)
    {
        $data = array(
            'checkin' => $query['checkin'],
            'tipe' => $query['tipe'],
            'nama' => $query['nama'],
            'id' => $query['id'],
            'kadaluarsa_member' => $query['kadaluarsa_member'],
            'checkout' => $query['checkout'],

        );

        $this->db->insert('history', $data);

    }
    public function getAllHistory()
    {
        $query = $this->db->get('history');
        return $query->result_array();
    }
    public function historyPengunjung($startDate, $endDate)
    {
        $date = strtotime($startDate);
        $startDate = date('Y-m-d H:i:s', $date);

        $date2 = strtotime($endDate);
        $endDate = date('Y-m-d H:i:s', $date2);

        $endDate = new DateTime($endDate);
        $endDate->modify('+1 day');
        $endDate = $endDate->format('Y-m-d H:i:s');

        $this->db->where('checkin >=', $startDate);
        // $this->db->where('checkin =', $startDate);
        $this->db->where('checkin <=', $endDate);
        $query = $this->db->get('history');
        return $query->result_array();
    }
    public function getAllPenjualanHistory()
    {
        $query = $this->db->get('beli');
        return $query->result_array();
    }
    public function historyPenjualan($startDate, $endDate)
    {
        $date = strtotime($startDate);
        $startDate = date('Y-m-d H:i:s', $date);

        $date2 = strtotime($endDate);
        $endDate = date('Y-m-d H:i:s', $date2);

        $endDate = new DateTime($endDate);
        $endDate->modify('+1 day');
        $endDate = $endDate->format('Y-m-d H:i:s');

        $this->db->where('waktu >=', $startDate);
        // $this->db->where('checkin =', $startDate);
        $this->db->where('waktu <=', $endDate);
        $query = $this->db->get('beli');
        return $query->result_array();
    }

    // public function historyPenjualanChart($startDate, $endDate)
    // {
    //     $date = strtotime($startDate);
    //     $startDate = date('Y-m-d H:i:s', $date);

    //     $date2 = strtotime($endDate);
    //     $endDate = date('Y-m-d H:i:s', $date2);

    //     $endDate = new DateTime($endDate);
    //     $endDate->modify('+1 day');
    //     $endDate = $endDate->format('Y-m-d H:i:s');

    //     $this->db->where('waktu >=', $startDate);
    //     // $this->db->where('checkin =', $startDate);
    //     $this->db->where('waktu <=', $endDate);
    //     $query = $this->db->get('beli');
    //     return $query->result_array();
    // }

    public function getAllPemasukanHistory()
    {
        $query = $this->db->get('pemasukan');
        return $query->result_array();
    }
    public function historyPemasukan($startDate, $endDate)
    {
        $date = strtotime($startDate);
        $startDate = date('Y-m-d H:i:s', $date);

        $date2 = strtotime($endDate);
        $endDate = date('Y-m-d H:i:s', $date2);

        $endDate = new DateTime($endDate);
        $endDate->modify('+1 day');
        $endDate = $endDate->format('Y-m-d H:i:s');

        $this->db->where('waktu >=', $startDate);
        // $this->db->where('checkin =', $startDate);
        $this->db->where('waktu <=', $endDate);
        $query = $this->db->get('pemasukan');
        return $query->result_array();
    }

}
