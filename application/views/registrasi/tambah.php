<div class="container">

    <div class="row mt-3">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Add New Member Data Form
                </div>
                <div class="card-body">
                    <form method="post" action="">

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?=$newCardId['id'] + 1?>" readonly>
                            <h5 class="card-title">Card id: <strong><?=$newCardId['id'] + 1?></strong></h5>
                            </div>
                            <div class="form-group">
                                <!-- <input type="hidden" class="form-control" id="tanggal" name="tanggal" placeholder="" value="<?=$currentDate?>" readonly> -->
                            <h5 class="card-title">Registration Date: <strong><?=$currentDate?> (Today)</strong></h5>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="kadaluarsa_kartu" name="kadaluarsa_kartu" placeholder="" value="<?=$cardExpireDate?>" readonly>
                            <h5 class="card-title">Card Validity Period: <strong><?=$cardExpireDate?></strong></h5>
                            </div>
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="" autocomplete="off">
                                <small class="form-text text-danger"><?=form_error('nama');?></small>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Address</label>
                                <input type="text" class="form-control" id="alamat"  name="alamat" placeholder="" autocomplete="off">
                                <small class="form-text text-danger"><?=form_error('alamat');?></small>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="kadaluarsa_member" name="kadaluarsa_member" placeholder="" value="<?=$extra1Month?>" readonly>
                            <h5 class="card-title">Member Expiration Date: <strong><?=$extra1Month?></strong></h5>
                            </div>

                            <button type="submit" name="tambah" class="btn btn-primary float-right ml-2">Add New Member Data</button>
                            <a href="<?=base_url()?>registrasi" class="btn btn-secondary float-right ">Back</a>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
