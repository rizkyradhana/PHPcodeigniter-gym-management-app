<div class="container">

    <div class="row mt-3">

        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    ADD NON MEMBER DATA
                </div>
                <div class="card-body">
                    <form method="post" action="">
                            <div class="form-group">
                                <!-- <label for="id">No. Kartu</label> -->
                                <input type="hidden" class="form-control" id="tipe" name="tipe" placeholder="" value="non-member" readonly >
                            <h5 class="card-title">Type: <strong>Non-Member</strong></h5>
                            </div>

                            <div class="form-group">
                                <label for="kunci"> NAME: </label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="" autocomplete="off">


                                <!-- <small class="form-text text-danger">nomor kunci loker atau data member sudah masuk ke dalam halaman Home </small> -->

                                <small class="form-text text-danger"><?=form_error('nama');?></small>
                            </div>

                            <div class="form-group">
                                <label for="kunci"> LOCKER KEY: </label>
                                <input type="text" class="form-control" id="kunci" name="kunci" placeholder="" autocomplete="off">
                                <?php if ($error): ?>
                                <small class="form-text text-danger">Key Locker Number or Member Data Already in Home Page Previously </small>
                                <small class="form-text text-danger"><?=form_error('kunci');?></small>
                                <?php endif;?>
                            </div>

                            <button type="submit" name="tambahNonMember" class="btn btn-primary float-right ml-2">Add Non Member Visitor </button>
                            <a href="<?=base_url()?>home/tambah" class="btn btn-secondary float-right ">Back</a>

                    </form>
                </div>
            </div>

        </div>

    </div>

</div>
