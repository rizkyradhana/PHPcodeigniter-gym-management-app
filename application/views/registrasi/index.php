
<div class="container">




    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?=base_url()?>registrasi/tambah" class="btn btn-primary">Add New Member</a>
        </div>
    </div>


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
            <h2>Registration List of Executive Gym Member</h2>
            <?php if ($this->session->flashdata('flash')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Member data has successfully <strong><?=$this->session->flashdata('flash');?></strong>
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
            <h5>Total Registrants: <?=$total;?></h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Card id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Registration Date</th>
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
                    <td><?=$mbr['alamat']?></td>
                    <?php
$tanggal = explode(" ", $mbr['tanggal']);
?>
                    <td><?=$tanggal[0]?></td>
                    <!-- <td><?php $date = strtotime($mbr['tanggal']);
echo date('d M Y', $date);?></td> -->
                    <td>
                        <a href="<?=base_url()?>registrasi/hapus/<?=$mbr['id']?>" class="btn btn-danger">Delete</a>
                        <a href="<?=base_url()?>registrasi/ubah/<?=$mbr['id']?>" class="btn btn-primary">Edit</a>
                    </td>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>
            <?=$this->pagination->create_links();?>

        </div>

    </div>

</div>