<div class="container">

    <div class="row mt-3">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Add suplement stock
                </div>
                <div class="card-body">
                    <form method="post" action="">

                            <div class="form-group">
                                <!-- <label for="nama">Nama</label> -->
                                <input type="hidden" class="form-control" id="nama" name="nama" placeholder="" value="<?=$produk['nama']?>" readonly>
                                <h5 class="card-title">Suplement Name: <strong><?=$produk['nama']?></strong></h5>
                                <small class="form-text text-danger"><?=form_error('nama');?> </small>
                            </div>
                            <div class="form-group">
                                <!-- <label for="id">No. Kartu</label> -->
                                <input type="hidden" class="form-control" id="stok" name="stok" placeholder="" value="<?=$produk['stok']?>" readonly>
                            <h5 class="card-title">Current Stock: <strong><?=$produk['stok']?></strong></h5>
                            </div>

                            <div class="form-group">
                                <label for="addStok"> Total suplement being added </label>
                                <input type="text" class="form-control" id="addStok" name="addStok" placeholder="" autocomplete="off">

                                <!-- <?php if ($error): ?> -->
                                <!-- <small class="form-text text-danger">nomor kunci loker atau data member sudah masuk ke dalam halaman Home </small> -->
                                <!-- <?php endif;?> -->
                                <small class="form-text text-danger"><?=form_error('addStok');?></small>
                            </div>

                            <button type="submit" name="tambahStok" class="btn btn-primary float-right ml-2">Add Stockk </button>
                            <a href="<?=base_url()?>produk" class="btn btn-secondary float-right ">Back</a>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
