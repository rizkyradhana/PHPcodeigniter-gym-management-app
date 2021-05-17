<div class="container ">
    <?php if ($member): ?>
    <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
        Members already have personal data and calorie needs. <strong>(REFILL THE FORM TO UPDATE THE DATA)</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right">Back</a>

    <?php endif;?>
    <div class="row mt-3 justify-content-center">
    <?php if ($member): ?>
            <div class="card mr-5" style="width: 20rem; background-color: honeydew;">
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
                <h3 class="card-title" style="text-align: center;">Daily Nutritional Needs Target</h3>
                <hr>
                <h4 class="card-title ">Calories: <strong><?=$member['kalori']?> kcal</strong></h4>
                <h4 class="card-title">Protein: <strong><?=$member['protein_min']?></strong> gr - <strong><?=$member['protein_max']?></strong> gr</h4>
                <h4 class="card-title">Fat: <strong><?=$member['fat_min']?></strong> gr - <strong><?=$member['fat_max']?></strong> gr</h4>
                <h4 class="card-title">Carbohidrate: <strong><?=$member['carbs_min']?></strong> gr - <strong><?=$member['carbs_max']?></strong> gr</h4>

            </div>
            </div>

    <?php endif;?>
        <div class="col-md-8 mt-5 mb-5 justify-content-center">
        <?php if ($this->session->flashdata('kalori')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Calories Data has been successfully <strong><?=$this->session->flashdata('kalori');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <?php if (!$member): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Please fill member data
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif;?>

            <div class="card">
                <div class="card-header">
                    <h3>Calculate Calorie
                    <?php if (!$member): ?>
                    <a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right">Back</a></h3>
                    <?php endif;?>
                </div>
                <div class="card-body">
                    <form method="post" action="" id="testForm">

                        <div class="form-group">
                                <!-- <label for="id">No. Kartu</label> -->
                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?=$memberId['id']?>" readonly>
                            <h5 class="card-title">Card Id: <strong><?=$memberId['id']?></strong></h5>
                            </div>

                            <div class="form-group">
                                <!-- <label for="nama">Nama</label> -->
                                <input type="hidden" class="form-control" id="nama" name="nama" placeholder="" value="<?=$memberId['nama']?>" readonly>
                                <h5 class="card-title">Name: <strong><?=$memberId['nama']?></strong></h5>
                                <small class="form-text text-danger"><?=form_error('nama');?> </small>

                            </div>
                        <hr>

                        <div class="form-group">
                            <label for="umur"><strong>AGE</strong></label>
                            <input type="text" class="form-control" id="umur" name="umur">
                            <small class="form-text text-danger"><?=form_error('umur');?></small>
                        </div><hr>
                        <div class="form-group">
                        <label for="jk"><strong>GENDER</strong></label>
                        <!-- <input type="text" class="form-control" id="umur"> -->
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisKelamin" id="laki" value="laki laki">
                                        <label class="form-check-label" for="laki">Men</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisKelamin" id="perempuan" value="perempuan">
                                        <label class="form-check-label" for="perempuan">Women</label>
                                    </div>
                                </div>
                            </div>
                            <small class="form-text text-danger"><?=form_error('jenisKelamin');?></small>
                        </div><hr>
                        <div class="form-group">
                            <label for="tinggi"><strong>HEIGHT (cm) </strong></label>
                            <input type="text" class="form-control" id="tinggi" name="tinggi">
                            <small class="form-text text-danger"><?=form_error('tinggi');?></small>
                        </div>
                        <div class="form-group">
                            <label for="tinggi"><strong>WEIGHT (kg) </strong></label>
                            <input type="text" class="form-control" id="berat" name="berat">
                            <small class="form-text text-danger"><?=form_error('berat');?></small>
                        </div><hr>
                        <div class="form-group">
                        <label for="goal"><strong>GOAL</strong></label>
                        <!-- <input type="text" class="form-control" id="umur"> -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="goal" id="cutting" value="cutting">
                                        <label class="form-check-label" for="cutting">Fatloss</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="goal" id="maintenance" value="maintenance">
                                        <label class="form-check-label" for="maintenance">Maintenance</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="goal" id="bulking" value="bulking">
                                        <label class="form-check-label" for="bulking">Increase Weight</label>
                                    </div>
                                </div>
                            </div>
                            <small class="form-text text-danger"><?=form_error('goal');?></small>
                        </div><hr>
                        <div class="form-group">
                        <label for="activity"><strong>ACTIVITY LEVEL</strong></label>
                        <!-- <input type="text" class="form-control" id="umur"> -->
                            <div class="row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activity" id="ringan" value="ringan">
                                        <label class="form-check-label" for="ringan"><strong>Light</strong>
                                    <small id="ringan" class="form-text text-muted">(Working at the table, rarely exercising, not doing activities at home)</small></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activity" id="sedang" value="sedang">
                                        <label class="form-check-label" for="sedang"><strong>Regular</strong>
                                        <small id="sedang" class="form-text text-muted">(outdoor activities 1-3 days / week or doing a lot of homework)</small></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activity" id="aktif" value="aktif">
                                        <label class="form-check-label" for="aktif"><strong>Active</strong>
                                        <small id="aktif" class="form-text text-muted"> (move a lot throughout the day or exercise 3-5 days / week)</small></label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="activity" id="sangatAktif" value="sangat aktif">
                                        <label class="form-check-label" for="sangatAktif"><strong>Very Active</strong>
                                        <small id="sangatAktif" class="form-text text-muted"> (do lots of strenuous work or exercise every day)</small></label>
                                    </div>
                                </div>
                            </div>
                        <small class="form-text text-danger"><?=form_error('activity');?></small>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary float-right  ml-3">Calculate calories</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- <div class="modal fade " style="max-width: 50%;"id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<!-- <div class="row mt-3 justify-content-center">
    <div class="col justify-content-center"> -->
    <div class="modal-dialog mw-50 w-50 modal-dialog-centered" role="document">
    <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Daily Calorie and Protein</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                        <h5 class="card-subtitle mb-2 text-muted">Card id: <?=$memberId['id']?></h5>
                        <h5 class="card-subtitle mb-2 text-muted">Member Name: <?=$memberId['nama']?></h5>
                        <hr>
                        <h3 class="card-title" style="text-align: center;">Daily Nutritional Needs Target</h3>
                        <hr>
                        <h5 class="card-title">Calories: <strong><?=$hasilKalori?></strong> kcal</h5>
                        <h5 class="card-title">Protein: <strong><?=$hasilProtein[0]?></strong> gr - <strong><?=$hasilProtein[1]?></strong> gr</h5>
                        <h5 class="card-title">Fat: <strong><?=$hasilLemak[0]?></strong> gr - <strong><?=$hasilLemak[1]?></strong> gr</h5>
                        <h5 class="card-title">Carbohidrate: <strong><?=$hasilKarbohidrat[0]?></strong> gr - <strong><?=$hasilKarbohidrat[1]?></strong> gr</h5>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-primary"></button> -->
            <!-- <a href="<?=base_url()?>instruktur/dataMember"></a> -->
        </div>
        </div>
    </div>
    <!-- </div>
</div> -->
</div>


<?php if ($show): ?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#exampleModal').modal('show');
    });
</script>
<?php $show = false;?>
<?php endif;?>
