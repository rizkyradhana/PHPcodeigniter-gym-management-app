
<div class="container">



<?php if (!$this->session->has_userdata('owner')): ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <a href="<?=base_url()?>home/tambah" class="btn btn-primary">Add Visitor</a>
        </div>
    </div>
<?php endif;?>

    <div class="row mt-3">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Find member data" name="keyword" autocomplete="off" >
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-12">
            <h2>List of visitors currently in the Gym</h2>
            <?php if ($this->session->flashdata('flash')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Visitor data is successfully <strong><?=$this->session->flashdata('flash');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('checkout')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            The visitor has checked out, <strong><?=$this->session->flashdata('checkout');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <?php if (empty($member)): ?>
                    <div class="alert alert-danger" role="alert">
                        Visitor data not found
                    </div>
            <?php endif;?>
            <h5>Total Visitor: <?=$total?></h5>
            <table class="table table-hover table-responsive-md">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Entry Hours</th>
                    <th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Card ID</th>
                    <th scope="col">Expire</th>
                    <th scope="col">Locker key</th>
                    <!-- <th scope="col">Checkout</th> -->
                    <?php if (!$this->session->has_userdata('owner')): ?>
                    <th scope="col">Action</th>
                    <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php foreach ($member as $mbr): ?>
                    <tr>
                    <th scope="row"><?=$i++?></th>
                    <td><?=$mbr['checkin']?></td>
                    <td><?=$mbr['tipe']?></td>
                    <td><?=$mbr['nama']?></td>
                    <?php if ($mbr['id'] == 0): ?>
                    <td>-</td>
                    <td>-</td>
                    <?php else: ?>
                    <td><?=$mbr['id']?></td>
                    <td><?php $date = strtotime($mbr['kadaluarsa_member']);
echo date('d M Y', $date);?></td>
                    <?php endif;?>
                    <td><?=$mbr['kunci']?></td>
                    <!-- <td><?=$mbr['checkout']?></td> -->
                    <?php if (!$this->session->has_userdata('owner')): ?>
                    <td>
                        <a href="<?=base_url()?>home/checkout/<?=$mbr['check_id']?>" class="btn btn-danger">Checkout</a>
                    </td>
                    <?php endif;?>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>

        </div>

    </div>

</div>