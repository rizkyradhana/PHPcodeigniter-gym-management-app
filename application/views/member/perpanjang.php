<div class="container">

    <div class="row mt-3">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Extend Member Duration
                </div>
                <div class="card-body">
                    <form method="post" action="">
                            <div class="form-group">
                                <!-- <label for="id">No. Kartu</label> -->
                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?=$member['id']?>" readonly>
                            <h5 class="card-title">Card id: <strong><?=$member['id']?></strong></h5>
                            </div>

                            <div class="form-group">
                                <!-- <label for="nama">Nama</label> -->
                                <input type="hidden" class="form-control" id="nama" name="nama" placeholder="" value="<?=$member['nama']?>" readonly>
                                <h5 class="card-title">Name: <strong><?=$member['nama']?></strong></h5>
                                <small class="form-text text-danger"><?=form_error('nama');?> </small>

                            </div>
                            <div class="form-group">
                                <!-- <label for="nama">Batas waktu membership (<strong>Saat ini</strong>)</label> -->
                                <input type="hidden" class="form-control" id="kadaluarsa_member" name="kadaluarsa_member" placeholder="" value="<?=$member['kadaluarsa_member']?>" readonly>
                                <!-- <small class="form-text text-danger"><?=form_error('nama');?> </small> -->
                                <h5 class="card-title">Membership deadline (<strong>Currently</strong>): <strong><?=$member['kadaluarsa_member']?></strong></h5>
                                <small class="form-text text-danger"><?=form_error('kadaluarsa_member');?> </small>
                            </div>

                            <div class="form-group">
                                <!-- <label for="tanggal">Tanggal Hari ini </label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="" value="<?=$currentDate?>"> -->
                                <h5 class="card-title">Todays date: <strong><?=$currentDate4Extend?></strong></h5>
                            </div>
                            <input type="hidden" class="form-control" id="kadaluarsa_member" name="kadaluarsa_member" placeholder="" value="<?=$extra1Month?>" readonly>

                            <div class="form-group">
                                <!-- <label for="tanggal">Tanggal Hari ini </label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="" value="<?=$currentDate?>"> -->
                                <h5 class="card-title"> Extend 1 month: <strong><?=$newMembershipExpireDate?></strong></h5>
                                <button type="submit" name="ubah" class="btn btn-success float-left mr-2">Yes, Extend 1 month </button>
                                <!-- <a href="<?=base_url()?>member" class="btn btn-secondary center ">Kembali</a> -->

                            </div><br><br>

                            <div class="form-group">
                                <label for="kadaluarsa_member"> Extend membership time <strong>(Edit if more than 1 month)</strong></label>
                                <input type="date" class="form-control" id="kadaluarsa_member" name="kadaluarsa_member" placeholder="" value="<?=$extra1Month?>">

                                <small class="form-text text-danger"><?=form_error('kadaluarsa_member');?></small>

                            </div>
                            <div class="form-group">
                                <label for="pemasukan">Fee: Rp</label>
                                <input type="text" class="form-control" id="pemasukan" name="pemasukan" placeholder="" value="0">

                                <small class="form-text text-danger"><?=form_error('pemasukan');?></small>

                            </div>

                            <button type="submit" name="ubah" class="btn btn-primary float-right ml-2">Extend Membership Period </button>
                            <a href="<?=base_url()?>member" class="btn btn-secondary float-right ">Back</a>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
