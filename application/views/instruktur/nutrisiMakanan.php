
<div class="container">
    <a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right mr-5">Back to home page</a></h3>
    <a href="<?=base_url()?>instruktur/tambahMakanan/<?=$this->uri->segment(3);?>" class="btn btn-success float-right mr-3">Add Food Data</a></h3>
     <a href="<?=base_url()?>instruktur/detail/<?=$this->uri->segment(3);?>" class="btn btn-info float-right mr-3">Check Member Detail</a>
    <div class="row mt-3">
        <div class="col-md-8">
<?php if ($member): ?>
            <form method="post" action="">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Type food name" name="keywords" autofocus autocomplete="off">
                    <div class="input-group-append">
                        <input class="btn btn-outline-primary" type="submit" name="caris" value="cari"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="row mt-3">
        <div class="col-md-12">
            <h2>Food list (per 100 gr)</h2>
            <?php if ($this->session->flashdata('makanan')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Food Data has successfully <strong><?=$this->session->flashdata('makanan');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('mealPlan')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Meal Plan Data has successfully <strong><?=$this->session->flashdata('mealPlan');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('porsi')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?=$this->session->flashdata('porsi');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>




                <?php if (empty($food)): ?>
                        <div class="alert alert-danger" role="alert">
                            Food data not found.
                        </div>
                <?php endif;?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Food name</th>
                        <th scope="col">Calorie</th>
                        <!-- <th scope="col">Alamat</th> -->
                        <th scope="col">Protein</th>
                        <th scope="col">Fat</th>
                        <th scope="col">Carbohidrate</th>

                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($food as $mkn): ?>
                        <tr>
                        <th scope="row"><?=++$start?></th>
                        <td id="nama_makanan"><?=$mkn['nama_makanan']?></td>
                        <td id="kalori"><?=$mkn['kalori']?></td>
                        <td id="protein"><?=$mkn['protein']?></td>
                        <td id="lemak"><?=$mkn['lemak']?></td>
                        <td id="karbohidrat"><?=$mkn['karbohidrat']?></td>

                        <td>
                            <!-- <a href="<?=base_url()?>instruktur/detailNutrisi/<?=$mkn['food_id']?>" class="btn btn-warning ubahPorsi">Tambah Ke Meal Plan</a> -->
                            <button type="button" class="btn btn-warning ubahPorsi" data-id="<?=$mkn['food_id']?>" data-makanan="<?=$mkn['nama_makanan']?>" data-kalori="<?=$mkn['kalori']?>" data-protein="<?=$mkn['protein']?>" data-lemak="<?=$mkn['lemak']?>" data-karbohidrat="<?=$mkn['karbohidrat']?>">Tambah Ke Meal Plan</button>
                        </td>
                        </tr>

                        <?php endforeach;?>
                    </tbody>
                </table>
                <?=$this->pagination->create_links();?>
        </div>
        <?php endif;?>
    </div>

</div>
<?php if ($empty): ?>
    <div class="alert alert-danger" role="alert">
        Members have not calculated their daily calorie needs
    </div>
    <div>
        <a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right" style="margin-left:10px;">Back</a>
        <a href="<?=base_url()?>instruktur/hitungKalori/<?=$id_member?>" class="btn btn-success float-right">Calculate Calories</a>
    </div>
<?php endif;?>




<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.ubahPorsi', function(){
            // var ids = $(this).attr('data-id');
            var id = $(this).attr('data-id');
            var nama_makanan = $(this).attr('data-makanan');
            var kalori = $(this).attr('data-kalori');
            var protein = $(this).attr('data-protein');
            var lemak = $(this).attr('data-lemak');
            var karbohidrat = $(this).attr('data-karbohidrat');
            // console.log(id);
            // console.log(nama_makanan2);

            // var nama_makanan = $('#nama_makanan').text();
            // var kalori = $('#kalori').text();
            // var protein = $('#protein').text();
            // var lemak = $('#lemak').text();
            // var karbohidrat = $('#karbohidrat').text();
            // console.log(nama_makanan);

            $('#porsiModal').modal('show');



            $('#pmNama_makanan').val(nama_makanan);
            $('#pmKalori').val(kalori);
            $('#pmProtein').val(protein);
            $('#pmLemak').val(lemak);
            $('#pmKarbohidrat').val(karbohidrat);
            return false;
        });
    })

        $(document).ready(function(){
            // Get value on keyup funtion
            $("#porsi,#pmKalori").keyup(function(){

            var total=0;
            var nama_makanan = $("#pmNama_makanan").val();
            var porsi = Number($("#porsi").val());
            var kalori = Number($("#pmKalori").val());
            var protein = Number($("#pmProtein").val());
            var lemak = Number($("#pmLemak").val());
            var karbohidrat = Number($("#pmKarbohidrat").val());
            var totalKalori= (porsi/100* kalori).toFixed(1);
            var totalProtein= (porsi/100* protein).toFixed(1);
            var totalLemak= (porsi/100* lemak).toFixed(1);
            var totalKarbohidrat= (porsi/100* karbohidrat).toFixed(1);
            $('#pmPorsiNew').val(porsi);
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
            <h5 class="modal-title" id="exampleModalLabel">Food Nutrition Details per 100gr</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="">
            <div class="form-group row">
                <label for="pmNama_makanan" class="col-sm-4 col-form-label">Food name:</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmNama_makanan" >
                </div>
            </div>
            <div class="form-group row">
                <label for="pmKalori" class="col-sm-4 col-form-label">Calories (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmKalori">
                </div>
            </div>
            <div class="form-group row">
                <label for="pmProtein" class="col-sm-4 col-form-label">Protein (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmProtein" >
                </div>
            </div>
            <div class="form-group row">
                <label for="pmLemak" class="col-sm-4 col-form-label">Fat (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmLemak">
                </div>
            </div>
            <div class="form-group row">
                <label for="pmKarbohidrat" class="col-sm-4 col-form-label">Carbohidrate (gr):</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmKarbohidrat" >
                </div>
            </div>
            <div class="form-group row">
                <label for="porsi" class="col-sm-4 col-form-label">Portion (gr): </label>
                <div class="col-sm-5">
                <input type="text" class="form-control" id="porsi" name="porsi">
                <!-- <small class="form-text text-danger"><?=form_error('porsi');?> </small> -->
                </div>
            </div>
            <hr>
            <h5 class="modal-title" id="exampleModalLabel">Details of food nutrition according to portion</h5>
            <hr>

            <input type="hidden" class="form-control" id="pmPorsiNew" name="pmPorsiNew"  readonly>
            <input type="hidden" class="form-control" id="pmNama_makanan_new" name="pmNama_makanan_new"  readonly>
            <!-- <div class="form-group row">
                <label for="pmNama_makanan_new" class="col-sm-4 col-form-label">Nama Makanan:</label>
                <div class="col-sm-5">
                <input type="text" readonly class="form-control-plaintext" id="pmNama_makanan_new" name="pmNama_makanan_new">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="pmKaloriNew" class="col-sm-4 col-form-label">Calorie (gr):</label>
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
            <input type="submit" class="btn btn-primary" name="simpan" value="Save"></input>
        </div>
        </form>
        </div>
    </div>
</div>
