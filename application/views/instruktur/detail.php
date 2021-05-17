<div class="container">
<h3><a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right">Back</a></h3>
    <div class="row mt-3">
        <!-- <div class="col-md-12"> -->
            <?php if ($member): ?>
            <div class="card ml-5" style="width: 20rem; background-color: honeydew;">
            <div class="card-body">
                <h3 class="card-title">Member Info</h3>
                <hr>
                <h6 class="card-subtitle mb-2 ">Card id: <?=$member['id']?></h6>
                <h6 class="card-subtitle mb-2 ">Name: <?=$member['nama']?></h6>
                <h6 class="card-subtitle mb-2 ">Age: <?=$member['umur']?></h6>
                <h6 class="card-subtitle mb-2 ">Gender: <?=$member['jenis_kelamin']?></h6>
                <h6 class="card-subtitle mb-2 ">Height: <?=$member['tinggi']?></h6>
                <h6 class="card-subtitle mb-2 ">Weight: <?=$member['berat']?></h6>
                <h6 class="card-subtitle mb-2 ">Goal: <?=$member['goal']?></h6>
                <h6 class="card-subtitle mb-2 ">Activity: <?=$member['activity']?></h6>
            </div>
            </div>
            <div class="card" style="width:30rem; background-color: lavender; ">
            <div class="card-body">
                <h3 class="card-title" style="text-align: center;">Daily Nutrition Goals </h3>
                <hr>
                <h4 class="card-title ">Calories: <strong><?=$member['kalori']?> kcal</strong></h4>
                <h4 class="card-title">Protein: <strong><?=$member['protein_min']?></strong> gr - <strong><?=$member['protein_max']?></strong> gr</h4>
                <h4 class="card-title">Fat: <strong><?=$member['fat_min']?></strong> gr - <strong><?=$member['fat_max']?></strong> gr</h4>
                <h4 class="card-title">Carbohidrat: <strong><?=$member['carbs_min']?></strong> gr - <strong><?=$member['carbs_max']?></strong> gr</h4>

            </div>
            </div>

        <!-- </div> -->
    </div>
    <hr>
    <?php if ($sisaNutrisi['sKalori'] >= 0): ?>
    <div class="alert alert-info" role="alert">
        Daily Calories are fulfilled
    </div>
    <?php endif;?>
    <?php if ($sisaNutrisi['sProtein_min'] >= 0 && $nutrisiSementara['proteinS'] < $member['protein_max']): ?>
    <div class="alert alert-info" role="alert">
        Daily Protein are fulfilled
    </div>
    <?php endif;?>
    <?php if ($sisaNutrisi['sLemak_min'] >= 0 && $nutrisiSementara['lemakS'] < $member['fat_max']): ?>
    <div class="alert alert-info" role="alert">
        Daily Fat are fulfilled
    </div>
    <?php endif;?>
    <?php if ($sisaNutrisi['sKarbohidrat_min'] >= 0 && $nutrisiSementara['karbohidratS'] < $member['carbs_max']): ?>
    <div class="alert alert-info" role="alert">
        Daily Carbohidrate calories are fulfilled
    </div>
    <?php endif;?>

    <?php if ($nutrisiSementara['proteinS'] > $member['protein_max']): ?>
    <div class="alert alert-danger" role="alert">
        Daily Protein Exceeds Needs
    </div>
    <?php endif;?>
    <?php if ($nutrisiSementara['lemakS'] > $member['fat_max']): ?>
    <div class="alert alert-danger" role="alert">
        Daily Fat Exceeds Needs
    </div>
    <?php endif;?>
    <?php if ($nutrisiSementara['karbohidratS'] > $member['carbs_max']): ?>
    <div class="alert alert-danger" role="alert">
        Daily Carbohidrate Exceeds Needs
    </div>
    <?php endif;?>


    <div class="row mt-2">
        <div class="col-md-12">

            <div class="row mt-2">
                <div class="col-md-4">
                    <h5 class="text-center ">Total nutrition that has been fulfilled</h5>
                </div>
                <div class="col-md-8">
                    <h6 class="text-center ">
                    <?php if ($mealPlan): ?>
                        <?php if ($sisaNutrisi['sKalori'] < 0): ?>
                        Calories: <?=$nutrisiSementara['kaloriS']?> kcal |
                        <?php else: ?>
                        Calories Fulfilled |
                        <?php endif;?>

                        <?php if ($sisaNutrisi['sProtein_min'] < 0): ?>
                        Protein: <?=$nutrisiSementara['proteinS']?> gr |
                        <?php else: ?>
                        Protein: Fulfilled |
                        <?php endif;?>

                        <?php if ($sisaNutrisi['sLemak_min'] < 0): ?>
                        Lemak: <?=$nutrisiSementara['lemakS']?> gr |
                        <?php else: ?>
                        Lemak: Fulfilled |
                        <?php endif;?>

                        <?php if ($sisaNutrisi['sKarbohidrat_min'] < 0): ?>
                        Carbohidrate: <?=$nutrisiSementara['karbohidratS']?> gr</h6>
                        <?php else: ?>
                        Carbohidrate: Fulfilled |
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <h5 class="text-center ">Remaining insufficient nutrition</h5>
                </div>
                <div class="col-md-8">
                    <h6 class="text-center ">
                    <?php $lebihKalori = false;
$lebihProtein = false;
$lebihLemak = false;
$lebihKarbohidrat = false;
// $selisihKarbohidrat = $member['carbs_max'] - $member['carbs_min'];
// $selisihProtein = $member['protein_max'] - $member['protein_min'];
// $selisihLemak = $member['fat_max'] - $member['fat_min'];

?>
                    <?php if ($sisaNutrisi['sKalori'] < 0): ?>
                    Calories: <?=$sisaNutrisi['sKalori']?> kcal |
                    <?php else:$lebihKalori = $sisaNutrisi['sKalori']?>Calories: 0 |<?php endif;?>

                    <?php if ($sisaNutrisi['sProtein_min'] < 0): ?>
                    Protein: <?=$sisaNutrisi['sProtein_min']?> gr |
                    <?php elseif ($sisaNutrisi['sProtein_min'] > 0 && $nutrisiSementara['proteinS'] > $member['protein_max']): ?>
                    <?php $lebihProtein = $sisaNutrisi['sProtein_max']?>
                    Protein: 0 |
                    <?php else: ?>
	                    Protein: 0 |
		                    <?php endif;?>

                    <?php if ($sisaNutrisi['sLemak_min'] < 0): ?>
                    Fat: <?=$sisaNutrisi['sLemak_min']?> gr |
                    <?php elseif ($sisaNutrisi['sLemak_min'] > 0 && $nutrisiSementara['lemakS'] > $member['fat_max']): ?>
                    <?php $lebihLemak = $sisaNutrisi['sLemak_max']?>
                    Fat: 0 |
                    <?php else: ?>
	                    Fat: 0 |
		                    <?php endif;?>

                    <?php if ($sisaNutrisi['sKarbohidrat_min'] < 0): ?>
                    Carbohidrate: <?=$sisaNutrisi['sKarbohidrat_min']?> gr |
                    <?php elseif ($sisaNutrisi['sKarbohidrat_min'] > 0 && $nutrisiSementara['karbohidratS'] > $member['carbs_max']): ?>
                    <?php $lebihKarbohidrat = $sisaNutrisi['sKarbohidrat_max']?>
                    Carbohidrate: 0 |
                    <?php else: ?>
	                    Carbohidrate: 0 |
		                    <?php endif;?>

                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-4">
                    <h5 class="text-center ">Nutrition that exceeds the need</h5>
                </div>
                <div class="col-md-8">
                    <h6 class="text-center ">
                    <?php if ($lebihKalori): ?>
                    Calories: <?=$lebihKalori?> kcal |
		            <?php endif;?>

                    <?php if ($lebihProtein): ?>
                    Protein: <?=$lebihProtein?> gr |
		            <?php endif;?>

                    <?php if ($lebihLemak): ?>
                    Fat: <?=$lebihLemak?> gr |
		            <?php endif;?>

                    <?php if ($lebihKarbohidrat): ?>
                    Carbohidrate: <?=$lebihKarbohidrat?> gr |
				    <?php endif;?>

                </div>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-md-6">
                <h3 class="text-center float-left">Meal Plan</h3>
                </div>
                <div class="col-md-6">
                <?php $mealplan_id = null;?>
                <?php foreach ($mealPlan as $mp): ?>
                <?php $mealplan_id = $mp['id']?>
                <?php endforeach;?>
                    <?php if ($mealplan_id): ?>
                        <a href="<?=base_url()?>instruktur/print_mealPlan/<?=$mealplan_id?>" class="btn btn-info float-right ml-2" target="_blank">Print Meal Plan</a>
                    <?php endif;?>
                        <a href="<?=base_url()?>instruktur/nutrisiMakanan/<?=$member['id']?>" class="btn btn-warning float-right">Tambah Meal Plan</a>
                </div>
            </div>
        <?php if ($this->session->flashdata('hapusMealPlan')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Meal plan data successfully <strong><?=$this->session->flashdata('hapusMealPlan');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <?php if ($this->session->flashdata('editMealPlan')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Meal plan data successfully <strong><?=$this->session->flashdata('editMealPlan');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <table class="table table-hover mt-3">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Food Name</th>
                    <th scope="col">Portion</th>
                    <th scope="col">Calories</th>
                    <th scope="col">Protein</th>
                    <th scope="col">Fat</th>
                    <th scope="col">Carbohidrate</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0?>
                    <?php if ($mealPlan): ?>
                        <?php foreach ($mealPlan as $mp): ?>
                        <tr>
                        <th scope="row"><?=++$i?></th>
                        <td id="nama_makanan"><?=$mp['nama_makanan']?></td>
                        <td id="porsi1"> <?=$mp['porsi']?> gr</td>
                        <td id="kalori"><?=$mp['kalori_mealPlan']?> kcal</td>
                        <td id="protein"><?=$mp['protein_mealPlan']?> gr</td>
                        <td id="lemak"><?=$mp['lemak_mealPlan']?> gr</td>
                        <td id="karbohidrat"><?=$mp['karbohidrat_mealPlan']?> gr</td>
                        <td>
                            <!-- <button type="button" class="btn btn-warning ubahPorsi" data-id="<?=$mkn['food_id']?>" data-makanan="<?=$mkn['nama_makanan']?>" data-kalori="<?=$mkn['kalori']?>" data-protein="<?=$mkn['protein']?>" data-lemak="<?=$mkn['lemak']?>" data-karbohidrat="<?=$mkn['karbohidrat']?>">Ubah Porsi</button> -->
                            <button type="button" class="btn btn-info ubahPorsi" data-id="<?=$mp['mealplan_id']?>" data-porsi-current="<?=$mp['porsi']?>"data-makanan-current="<?=$mp['nama_makanan']?>" data-kalori-current="<?=$mp['kalori_mealPlan']?>" data-protein-current="<?=$mp['protein_mealPlan']?>" data-lemak-current="<?=$mp['lemak_mealPlan']?>" data-karbohidrat-current="<?=$mp['karbohidrat_mealPlan']?>">Ubah Porsi</button>
                            <a href="<?=base_url()?>instruktur/hapusMealPlan/<?=$mp['id']?>/<?=$mp['mealplan_id']?>" class="btn btn-danger " >Hapus Meal Plan</a>
                        </td>
                        </tr>

                        <?php endforeach;?>
                    <?php else: ?>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                            Meal plan data still empty
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif;?>



</div>
<?php if ($empty): ?>
    <div class="alert alert-danger" role="alert">
        Member have not calculated their daily calorie needs
    </div>
    <div>
        <a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right" style="margin-left:10px;">Back</a>
        <a href="<?=base_url()?>instruktur/hitungKalori/<?=$id_member?>" class="btn btn-success float-right">Calculate Calorie</a>
    </div>
<?php endif;?>




<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.ubahPorsi', function(){
            // var ids = $(this).attr('data-id');
            var mealPlan_id = $(this).attr('data-id');
            var nama_makanan_current = $(this).attr('data-makanan-current');
            // var porsi1 = $(this).attr('data-porsi');
            var porsi_current = $(this).attr('data-porsi-current');
            var kalori_current = $(this).attr('data-kalori-current');
            var protein_current = $(this).attr('data-protein-current');
            var lemak_current = $(this).attr('data-lemak-current');
            var karbohidrat_current = $(this).attr('data-karbohidrat-current');


            $('#porsiModal').modal('show');


            $('#pmMealPlanId').val(mealPlan_id);
            $('#pmNama_makanan_current').val(nama_makanan_current);
            // $('#pmPorsi').val(porsi1);
            $('#porsi_sebelum').val(porsi_current);
            $('#pmKalori_current').val(kalori_current);
            $('#pmProtein_current').val(protein_current);
            $('#pmLemak_current').val(lemak_current);
            $('#pmKarbohidrat_current').val(karbohidrat_current);
            return false;
        });
    })

    $(document).ready(function(){
            // Get value on keyup funtion
            $("#porsi,#pmKalori").keyup(function(){

            var total=0;
            var mealPlan_id = $("#pmMealPlanId").val();
            var nama_makanan = $("#pmNama_makanan_current").val();
            // var porsi1 = Number($("#pmPorsi").val());
            var porsi_current = Number($("#porsi_sebelum").val());
        //ambil dari food data
            var porsi= Number($("#porsi").val());
            var kalori_current = Number($("#pmKalori_current").val());
            var protein_current = Number($("#pmProtein_current").val());
            var lemak_current = Number($("#pmLemak_current").val());
            var karbohidrat_current = Number($("#pmKarbohidrat_current").val());
        //ambil dari food data
                // alert(porsi_current);

            var kalori_root= (kalori_current*100/ porsi_current).toFixed(1);
            var protein_root= (protein_current*100/ porsi_current).toFixed(1);
            var lemak_root= (lemak_current*100/ porsi_current).toFixed(1);
            var karbohidrat_root= (karbohidrat_current*100/ porsi_current).toFixed(1);


            var totalKalori= (porsi/100* kalori_root).toFixed(1);
            var totalProtein= (porsi/100* protein_root).toFixed(1);
            var totalLemak= (porsi/100* lemak_root).toFixed(1);
            var totalKarbohidrat= (porsi/100* karbohidrat_root).toFixed(1);


            $('#pmPorsiNew').val(porsi);
            $('#mealPlanId').val(mealPlan_id);
            $('#pmNama_makanan_new').val(nama_makanan);
            $('#pmKaloriNew').val(totalKalori);
            $('#pmProteinNew').val(totalProtein);
            $('#pmLemakNew').val(totalLemak);
            $('#pmKarbohidratNew').val(totalKarbohidrat);

        });
    });
    </script>

<!-- Modal -->
<div class="modal fade" id="porsiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Meal plan nutrition detail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <input type="hidden" class="form-control" id="pmMealPlanId" name="pmMealPlanId"  readonly>
                <label for="pmNama_makanan_current" class="col-sm-4 col-form-label">Food Name:</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmNama_makanan_current">
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="pmPorsi" class="col-sm-4 col-form-label">Porsi:</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmPorsi" >
                </div>
            </div> -->
            <div class="form-group row">
                <label for="pmKalori_current" class="col-sm-4 col-form-label">Calories (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmKalori_current">
                </div>
            </div>
            <div class="form-group row">
                <label for="pmProtein_current" class="col-sm-4 col-form-label">Protein (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmProtein_current" >
                </div>
            </div>
            <div class="form-group row">
                <label for="pmLemak_current" class="col-sm-4 col-form-label">Fat (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmLemak_current">
                </div>
            </div>
            <div class="form-group row">
                <label for="pmKarbohidrat_current" class="col-sm-4 col-form-label">Carbohidrate (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmKarbohidrat_current" >
                </div>
            </div>
            <div class="form-group row">
                <label for="porsi_sebelum" class="col-sm-4 col-form-label">Early Portion (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="porsi_sebelum" >
                </div>
            </div>
            <div class="form-group row">
                <label for="porsi" class="col-sm-4 col-form-label">Newest Portion(gr): </label>
                <div class="col-sm-5">
                <input type="text" class="form-control" id="porsi" name="porsi">
                </div>
            </div>
            <hr>
            <h5 class="modal-title" id="exampleModalLabel">Food nutrition detail base on portion</h5>
            <hr>
        <form method="post" action="">
            <input type="hidden" class="form-control" id="pmPorsiNew" name="pmPorsiNew"  readonly>
            <input type="hidden" class="form-control" id="pmNama_makanan_new" name="pmNama_makanan_new"  readonly>
            <input type="hidden" class="form-control" id="mealPlanId" name="mealPlanId"  readonly>
            <!-- <div class="form-group row">
                <label for="pmNama_makanan_new" class="col-sm-4 col-form-label">Nama Makanan:</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmNama_makanan_new" name="pmNama_makanan_new">
                </div>
            </div> -->
            <!-- <div class="form-group row">
                <label for="pmPorsiNew1" class="col-sm-4 col-form-label">Porsi New (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmPorsiNew1" name="pmPorsiNew1">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="pmKaloriNew" class="col-sm-4 col-form-label">Calories (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmKaloriNew" name="pmKaloriNew">
                </div>
            </div>
            <div class="form-group row">
                <label for="pmProteinNew" class="col-sm-4 col-form-label">Protein (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmProteinNew" name="pmProteinNew" >
                </div>
            </div>
            <div class="form-group row">
                <label for="pmLemakNew" class="col-sm-4 col-form-label">Fat (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmLemakNew" name="pmLemakNew">
                </div>
            </div>
            <div class="form-group row">
                <label for="pmKarbohidratNew" class="col-sm-4 col-form-label">Carbohidrate (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmKarbohidratNew" name="pmKarbohidratNew">
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" name="update" value="Ubah"></input>
        </div>
        </form>
        </div>
    </div>
</div>