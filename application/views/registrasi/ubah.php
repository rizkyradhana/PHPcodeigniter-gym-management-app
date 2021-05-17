<div class="container">

    <div class="row mt-3">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    Edit Member Data Form
                </div>
                <div class="card-body">
                    <form method="post" action="">
                            <!-- <div class="form-group">
                                <label for="id">No. Kartu</label>
                                <input type="text" class="form-control" id="id" name="id" placeholder="" value="<?=$member['id']?>" readonly>
                            </div> -->
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?=$member['id']?>" readonly>
                            <h5 class="card-title">Card id: <strong><?=$member['id']?></strong></h5>
                            </div>
                            <!-- <div class="form-group">
                                <label for="tanggal">Tanggal Pendaftaran </label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="" value="<?=$member['tanggal']?>">
                            </div> -->

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="tanggal" name="tanggal" placeholder="" value="<?=$member['tanggal']?>" readonly>
                            <h5 class="card-title">Registration Date: <strong><?=$member['tanggal']?></strong></h5>
                            </div>

                            <!-- <div class="form-group">
                                <label for="kadaluarsa_kartu">Masa Berlaku Kartu</label>
                                <input type="date" class="form-control" id="kadaluarsa_kartu" name="kadaluarsa_kartu" placeholder="" value="<?=$cardExpireDate?>" >
                            </div> -->

                            <div class="form-group">
                                <input type="hidden" class="form-control" id="kadaluarsa_kartu" name="kadaluarsa_kartu" placeholder="" value="<?=$member['kadaluarsa_kartu']?>" readonly>
                            <h5 class="card-title">Card Validity Period: <strong><?=$member['kadaluarsa_kartu']?></strong></h5>
                            </div>

                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="" value="<?=$member['nama']?>" autocomplete="off">
                                <small class="form-text text-danger"><?=form_error('nama');?></small>

                            </div>
                            <div class="form-group">
                                <label for="alamat">Address</label>
                                <input type="text" class="form-control" id="alamat"  name="alamat" placeholder="" value="<?=$member['alamat']?>" autocomplete="off">
                                <small class="form-text text-danger"><?=form_error('alamat');?></small>

                            </div>

                            <button type="submit" name="ubah" class="btn btn-primary float-right ml-2">Edit Member Data </button>
                            <a href="<?=base_url()?>registrasi" class="btn btn-secondary float-right ">Back</a>
                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
