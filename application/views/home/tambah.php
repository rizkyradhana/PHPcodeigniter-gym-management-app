
<div class="container">

    <a href="<?=base_url()?>home/" class="btn btn-secondary float-right ">Back</a>
    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?=base_url()?>home/tambahNonMember" class="btn btn-primary">Add Non Member Visitor</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Cari Data Member" name="keyword" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-12">
            <h2>Executive Gym Member List</h2>
            <?php if ($this->session->flashdata('dataCheckin')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Failed to Check Member In <strong><?=$this->session->flashdata('dataCheckin');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('memberExpire')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Failed to Check Member In <strong><?=$this->session->flashdata('memberExpire');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <?php if (empty($member)): ?>
                    <div class="alert alert-danger" role="alert">
                        Member Data Not Found.
                    </div>
            <?php endif;?>
            <table class="table table-hover ">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Card ID</th>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Alamat</th> -->
                    <th scope="col">Card Expired Date</th>
                    <th scope="col">Membership Date Limit</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php foreach ($member as $mbr): ?>
                    <tr>
                    <th scope="row"><?=$i++?></th>
                    <td><?=$mbr['id']?></td>
                    <td><?=$mbr['nama']?></td>
                    <!-- <td><?=$mbr['alamat']?></td> -->
                    <td><?php $date = strtotime($mbr['kadaluarsa_kartu']);
echo date('d M Y', $date);?></td>
                    <td><?php $date = strtotime($mbr['kadaluarsa_member']);
echo date('d M Y', $date);?></td>
                    <td>



        <!-- <button type="submit" class="btn btn-success" name = "masuk" data-toggle="modal" data-target="#kunciModal">

        Masuk
        </button> -->
        <!-- <a href="<?=base_url()?>home/checkin/<?=$mbr['id']?>" class="btn btn-success" data-toggle="modal" data-target="#kunciModal" name="masuk" id="masuk">Masuk</a> -->
        <a href="<?=base_url()?>home/checkin/<?=$mbr['id']?>" class="btn btn-success"  name="masuk" id="masuk">Get ink</a>


<!-- data-toggle="modal" data-target="#kunciModal" -->




                    </td>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>

        </div>

    </div>

</div>




<!--
<button type="submit" class="btn btn-success" name = "masuk" data-toggle="modal" data-target="#kunciModal">

        Masuk
        </button> -->
<!-- Modal -->
    <div class="modal fade" id="kunciModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">Input Locker Key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method = "post" action = "">
                    <div class="form-group">
                        <label for="kunci">Locker Key</label>
                        <input type="text" class="form-control" id="kunci" name="kunci" value="<?=$mbr['id']?>">
                        <small id="formValidation" class="form-text text-muted">nanti diisi validation</small>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary" name="tambahKunci" data-target="#masuk">Simpan</button>
                <!-- <a href="<?=base_url()?>home/checkin/<?=$mbr['id']?>" class="btn btn-success" name="tambahKunci">Masuk</a> -->
            </div>
                </form>
        </div>
    </div>
    </div>

