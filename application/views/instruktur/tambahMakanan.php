<div class="container ">

    <div class="row mt-3 justify-content-center">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h3>Add food data
                    <a href="<?=base_url()?>instruktur/nutrisiMakanan/<?=$this->uri->segment(3);?>" class="btn btn-secondary float-right">Kembali</a></h3>
                </div>
                <div class="card-body">
                    <form method="post" action="" id="testForm">
                        <div class="form-group">
                            <label for="nama_makanan"><strong>Food name</strong></label>
                            <input type="text" class="form-control" id="nama_makanan" name="nama_makanan">
                            <small class="form-text text-danger"><?=form_error('nama_makanan');?></small>
                        </div><hr>
                        <div class="form-group">
                            <label for="berat_makanan"><strong>Food Weight (gr)</strong></label>
                            <input type="text" class="form-control" id="berat_makanan" name="berat_makanan">
                            <small class="form-text text-danger"><?=form_error('berat_makanan');?></small>
                        </div><hr>
                        <div class="form-group">
                            <label for="kalori"><strong>Calorie (gr)</strong></label>
                            <input type="text" class="form-control" id="kalori" name="kalori">
                            <small class="form-text text-danger"><?=form_error('kalori');?></small>
                        </div>
                        <div class="form-group">
                            <label for="protein"><strong>Protein (gr)</strong></label>
                            <input type="text" class="form-control" id="protein" name="protein">
                            <small class="form-text text-danger"><?=form_error('protein');?></small>
                        </div><hr>
                        <div class="form-group">
                            <label for="lemak"><strong>Fat (gr)</strong></label>
                            <input type="text" class="form-control" id="lemak" name="lemak">
                            <small class="form-text text-danger"><?=form_error('lemak');?></small>
                        </div><hr>
                        <div class="form-group">
                            <label for="karbohidrat"><strong>Carbohidrate (gr)</strong></label>
                            <input type="text" class="form-control" id="karbohidrat" name="karbohidrat">
                            <small class="form-text text-danger"><?=form_error('karbohidrat');?></small>
                        </div><hr>
                        <div>
                            <button type="submit" class="btn btn-primary float-right  ml-3">Add food data</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>