
<div class="container">


    <div class="row mt-3">
        <div class="col-md-6">
            <form method="post" action="">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" placeholder="Type name or member card id" name="keyword" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-outline-primary" type="submit" name="cari" value="Search"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-12">
            <h2>Executive Gym member list</h2>
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

                <h5>Total members: <?=$total;?></h5>


                <h6>Total Active Members: <?=$totalAktif;?> <form method="post" action=""><input class="btn btn-info btn-sm" type="submit" name="cekAktif" value="Check Data"></input></form></h6>
                <h6>Total Non Active Members: <?=$totalNonAktif;?> <form method="post" action=""><input class="btn btn-warning btn-sm" type="submit" name="cekNonAktif" value="Check Data"></input></form></h6>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Card id</th>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Alamat</th> -->
                    <th scope="col">Card Validity Period</th>
                    <th scope="col">Membership limits</th>
                    <?php if ($this->session->has_userdata('resepsionis')): ?>
                    <th scope="col">Action</th>
                    <?php endif;?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($member as $mbr): ?>
                    <tr>
                    <th scope="row"><?=++$start?></th>
                    <td><?=$mbr['id']?></td>
                    <td><?=$mbr['nama']?></td>
                    <!-- <td><?=$mbr['alamat']?></td> -->
                    <td><?php $date = strtotime($mbr['kadaluarsa_kartu']);
echo date('d M Y', $date);?></td>
                    <td><?php $date = strtotime($mbr['kadaluarsa_member']);
echo date('d M Y', $date);?></td>
                    <?php if ($this->session->has_userdata('resepsionis')): ?>
                    <td>
                        <a href="<?=base_url()?>member/perpanjang/<?=$mbr['id']?>" class="btn btn-success">Extend</a>
                    </td>
                    <?php endif;?>
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>
                        <?php if (empty($cekAktif) && empty($cekNonAktif)): ?>
                        <?=$this->pagination->create_links();?>
                        <?php endif;?>
        </div>

    </div>

</div>