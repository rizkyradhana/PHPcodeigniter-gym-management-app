<?php
class Instruktur_model extends CI_model
{
    public function hitungKalori($umur, $jenisKelamin, $tinggi, $berat, $goal, $activity)
    {
        if ($jenisKelamin == 'laki') {
            $kalori = (10 * $berat) + (6.25 * $tinggi) - (5 * $umur) + 5;
        } else {
            $kalori = (10 * $berat) + (6.25 * $tinggi) - (5 * $umur) - 161;
        }

        if ($activity == 'ringan') {
            $kalori = $kalori * 1.2;
        } elseif ($activity == 'sedang') {
            $kalori = $kalori * 1.375;
        } elseif ($activity == 'aktif') {
            $kalori = $kalori * 1.55;
        } elseif ($activity == 'sangat aktif') {
            $kalori = $kalori * 1.725;
        }

        if ($goal == 'cutting') {
            $kalori = $kalori - 500;
        } elseif ($goal == 'bulking') {
            $kalori = $kalori + 500;
        }
        return (int) $kalori;
    }
    public function hitungProtein($berat, $goal)
    {
        $protein = [];
        if ($goal == 'bulking' || $goal == 'maintenance') {
            $protein[0] = $berat * 1.6;
            $protein[1] = $berat * 2.2;
            return $protein;
        } else if ($goal == 'cutting') {
            $protein[0] = $berat * 1.2;
            $protein[1] = $berat * 1.6;
            return $protein;
        }

    }
    public function hitungLemak($kalori)
    {
        $lemak = [];
        $lemak[0] = number_format(($kalori * 0.2) / 9, 1, '.', '');
        $lemak[1] = number_format(($kalori * 0.35) / 9, 1, '.', '');
        return $lemak;
    }
    public function hitungKarbohidrat($kalori)
    {
        $karbohidrat = [];
        $karbohidrat[0] = number_format(($kalori * 0.45) / 4, 1, '.', '');
        $karbohidrat[1] = number_format(($kalori * 0.65) / 4, 1, '.', '');
        return $karbohidrat;
    }
    public function getFoodNutrition($limit, $start = null, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_makanan', $keyword);
            $this->db->or_like('kelompok_makanan', $keyword);

        }
        $query = $this->db->get('food', $limit, $start);
        return $query->result_array();
    }
    public function tambahDataMakanan()
    {

        $berat_makanan = $this->input->post('berat_makanan', true);
        // var_dump($berat_makanan);
        $kalori = (100 / $berat_makanan) * $this->input->post('kalori', true);
        $protein = (100 / $berat_makanan) * $this->input->post('protein', true);
        $lemak = (100 / $berat_makanan) * $this->input->post('lemak', true);
        $karbohidrat = (100 / $berat_makanan) * $this->input->post('karbohidrat', true);
        // var_dump($kalori);
        // var_dump($protein);
        // var_dump($lemak);
        // var_dump($karbohidrat);

        $data = array(
            'nama_makanan' => $this->input->post('nama_makanan', true),
            'kalori' => $kalori,
            'protein' => $protein,
            'lemak' => $lemak,
            'karbohidrat' => $karbohidrat,
        );

        $this->db->insert('food', $data);

    }
    public function setMemberCalorieInfo($InstructorMember, $umur, $jenisKelamin, $tinggi, $berat, $goal, $activity, $calories, $proteins, $fats, $carbs)
    {
        $data = array(
            'id' => $InstructorMember['id'],
            'nama' => $InstructorMember['nama'],
            'umur' => $umur,
            'jenis_kelamin' => $jenisKelamin,
            'tinggi' => $tinggi,
            'berat' => $berat,
            'goal' => $goal,
            'activity' => $activity,
            'kalori' => $calories,
            'protein_min' => $proteins[0],
            'protein_max' => $proteins[1],
            'fat_min' => $fats[0],
            'fat_max' => $fats[1],
            'carbs_min' => $carbs[0],
            'carbs_max' => $carbs[1],
        );
        $this->db->insert('instruktur_member', $data);

    }
    public function getInstructorMemberById($id)
    {
        return $this->db->order_by('im_id', "desc")->limit(1)->get_where('instruktur_member', ['id' => $id])->row_array();

    }
    public function addMealPlan($InstructorMember, $porsi, $foodName, $foodKalori, $foodProtein, $foodLemak, $foodKarbohidrat)
    {
        $data = array(
            'id' => $InstructorMember['id'],
            'nama' => $InstructorMember['nama'],
            'nama_makanan' => $foodName,
            'porsi' => $porsi,
            'kalori_mealPlan' => $foodKalori,
            'protein_mealPlan' => $foodProtein,
            'lemak_mealPlan' => $foodLemak,
            'karbohidrat_mealPlan' => $foodKarbohidrat,
        );
        $this->db->insert('meal_plan', $data);

    }
    public function editMealPlan($InstructorMember, $porsi, $foodName, $foodKalori, $foodProtein, $foodLemak, $foodKarbohidrat)
    {
        $data = array(
            'id' => $InstructorMember['id'],
            'nama' => $InstructorMember['nama'],
            'nama_makanan' => $foodName,
            'porsi' => $porsi,
            'kalori_mealPlan' => $foodKalori,
            'protein_mealPlan' => $foodProtein,
            'lemak_mealPlan' => $foodLemak,
            'karbohidrat_mealPlan' => $foodKarbohidrat,
        );
        $this->db->where('mealplan_id', $this->input->post('mealPlanId'));
        $this->db->update('meal_plan', $data);

    }
    public function getMealPlan($id)
    {
        return $this->db->get_where('meal_plan', ['id' => $id])->result_array();

    }
    public function hapusMealPlan($mealplan_id)
    {
        $this->db->where('mealplan_id', $mealplan_id);
        $this->db->delete('meal_plan');

    }
    public function getNutrisiSementara($mealplan)
    {
        $kaloriS = null;
        $proteinS = null;
        $lemakS = null;
        $karbohidratS = null;
        foreach ($mealplan as $mps) {
            $kaloriS = $kaloriS + $mps['kalori_mealPlan'];
            $proteinS = $proteinS + $mps['protein_mealPlan'];
            $lemakS = $lemakS + $mps['lemak_mealPlan'];
            $karbohidratS = $karbohidratS + $mps['karbohidrat_mealPlan'];
        }
        $data = array(
            'kaloriS' => $kaloriS,
            'proteinS' => $proteinS,
            'lemakS' => $lemakS,
            'karbohidratS' => $karbohidratS,
        );
        return $data;

    }
    public function getSisaNutrisi($nutrisiSementara, $InstructorMember)
    {
        // $sKalori = $InstructorMember['kalori'] - $nutrisiSementara['kaloriS'];
        // $sProtein_min = $InstructorMember['protein_min'] - $nutrisiSementara['proteinS'];
        // $sProtein_max = $InstructorMember['protein_max'] - $nutrisiSementara['proteinS'];
        // $sLemak_min = $InstructorMember['fat_min'] - $nutrisiSementara['lemakS'];
        // $sLemak_max = $InstructorMember['fat_max'] - $nutrisiSementara['lemakS'];
        // $sKarbohidrat_min = $InstructorMember['carbs_min'] - $nutrisiSementara['karbohidratS'];
        // $sKarbohidrat_max = $InstructorMember['carbs_max'] - $nutrisiSementara['karbohidratS'];

        $sKalori = $nutrisiSementara['kaloriS'] - $InstructorMember['kalori'];
        $sProtein_min = $nutrisiSementara['proteinS'] - $InstructorMember['protein_min'];
        $sProtein_max = $nutrisiSementara['proteinS'] - $InstructorMember['protein_max'];
        $sLemak_min = $nutrisiSementara['lemakS'] - $InstructorMember['fat_min'];
        $sLemak_max = $nutrisiSementara['lemakS'] - $InstructorMember['fat_max'];
        $sKarbohidrat_min = $nutrisiSementara['karbohidratS'] - $InstructorMember['carbs_min'];
        $sKarbohidrat_max = $nutrisiSementara['karbohidratS'] - $InstructorMember['carbs_max'];

        $data = array(
            'sKalori' => $sKalori,
            'sProtein_min' => $sProtein_min,
            'sProtein_max' => $sProtein_max,
            'sLemak_min' => $sLemak_min,
            'sLemak_max' => $sLemak_max,
            'sKarbohidrat_min' => $sKarbohidrat_min,
            'sKarbohidrat_max' => $sKarbohidrat_max,
        );
        return $data;
    }
}
