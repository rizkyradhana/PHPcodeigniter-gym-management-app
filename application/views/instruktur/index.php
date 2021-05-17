<div class="container">
    <!-- <a href="<?=base_url()?>instruktur" class="btn btn-secondary float-right mr-5">Kembali</a></h3> -->


    <div class="row mt-3">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Type in the Member's name or ID card" name="keyword" autocomplete="off">
                    <div class="input-group-append">
                        <input class="btn btn-outline-primary"  type="submit" name="cari" value="Search"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-12">
            <h2>Executive Gym Member List</h2>
            <?php if ($this->session->flashdata('flash')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Member data is successfully <strong><?=$this->session->flashdata('flash');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <?php if (empty($member)): ?>
                    <div class="alert alert-danger" role="alert">
                        Member data not found.
                    </div>
            <?php endif;?>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Card id</th>
                    <th scope="col">Name</th>

                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php $i = $start?> -->
                    <?php foreach ($member as $mbr): ?>
                    <tr>
                    <th scope="row"><?=++$start?></th>
                    <td><?=$mbr['id']?></td>
                    <td><?=$mbr['nama']?></td>

                    <td>
                        <a href="<?=base_url()?>instruktur/hitungKalori/<?=$mbr['id']?>" class="btn btn-success">Calculate Calorie</a>
                        <a href="<?=base_url()?>instruktur/nutrisiMakanan/<?=$mbr['id']?>" class="btn btn-warning">Meal Plan</a>
                        <a href="<?=base_url()?>instruktur/detail/<?=$mbr['id']?>" class="btn btn-info">Detail</a>
                    </td>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>
            <?=$this->pagination->create_links();?>

        </div>

    </div>

</div>