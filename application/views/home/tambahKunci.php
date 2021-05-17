<div class="container">

    <div class="row mt-3">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    ADD LOCKER KEY
                </div>
                <div class="card-body">
                    <form method="post" action="">
                            <div class="form-group">
                                <!-- <label for="id">No. Kartu</label> -->
                                <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?=$member['id']?>" readonly>
                            <h5 class="card-title">Card ID: <strong><?=$member['id']?></strong></h5>
                            </div>

                            <div class="form-group">
                                <!-- <label for="nama">Nama</label> -->
                                <input type="hidden" class="form-control" id="nama" name="nama" placeholder="" value="<?=$member['nama']?>" readonly>
                                <h5 class="card-title">Name: <strong><?=$member['nama']?></strong></h5>
                                <small class="form-text text-danger"><?=form_error('nama');?> </small>

                            </div>

                            <div class="form-group">
                                <label for="kunci"> Locker Key </label>
                                <input type="text" class="form-control" id="kunci" name="kunci" placeholder="" autocomplete="off">

                                <?php if ($error): ?>
                                <small class="form-text text-danger">Key Locker Number or Member Data Already in Home Page Previously </small>
                                <?php endif;?>
                                <small class="form-text text-danger"><?=form_error('kunci');?></small>
                            </div>

                            <button type="submit" name="tambahKunci" class="btn btn-primary float-right ml-2">Add Locker Key </button>
                            <a href="<?=base_url()?>home/hapus/<?=$memberCheckin['check_id']?>" class="btn btn-secondary float-right ">Back</a>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
