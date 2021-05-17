<?php
$jumlahMember = 0;
$jumlahNonMember = 0;

foreach ($memberHistory as $pHChart) {
    if ($pHChart['tipe'] == 'member') {
        $jumlahMember++;
    } else if ($pHChart['tipe'] === 'non-member') {
        $jumlahNonMember++;
    }
}
?>

<div class="container">
<a href="<?=base_url()?>history" class="btn btn-secondary float-right">Back</a>
    <div class="row mt-3">
        <div class="col-md-6">
            <form action = "" method="post">
                <div class="form-group align-center">
                    <label for="startDate">Start Date</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" value="">
                    <!-- <input type="time" class="form-control" id="jamMulai" name="jamMulai" value="12:00 AM"> -->
                </div>
        </div>
        <div class="col-md-6">
                <div class="form-group">
                    <label for="endDate">End Date</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" value="" >
                    <!-- <input type="time" class="form-control" id="jamAkhir" name="jamAkhir" hidden> -->
                </div>
        </div>
                <input type="submit" name="mutasi" class="btn btn-primary btn-block" value="Tampilkan"></input>
            </form>
    </div>
    <?php if ($this->session->flashdata('tanggal')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?=$this->session->flashdata('tanggal');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
    <hr>
    <div class="row mt-3">
                    <script>
                    window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        animationEnabled: true,
                        theme: "light1", // "light1", "light2", "dark1", "dark2"
                        title:{
                            text: "Data Jumlah Pengunjung Berdasarkan Tanggal"
                        },
                        axisY: {
                            title: "Jumlah Pengunjung"
                        },
                        data: [{
                            type: "column",
                            showInLegend: true,
                            legendMarkerColor: "black",
                            legendText: "Tipe Pengunjung",
                            dataPoints: [
                                { y: <?=$jumlahMember?>,  label: "Member" },
                                { y: <?=$jumlahNonMember?>,  label: "non-member" },

                            ]
                        }]
                    });
                    chart.render();

                    }
                    </script>
                    <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>

    <hr>


    <div class="row mt-3">
        <div class="col-md-12">
            <h2>Visitor History of Executive Gym</h2>
            <?php if ($this->session->flashdata('flash')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Visitor Data Successfully <strong><?=$this->session->flashdata('flash');?></strong>
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
                            Visitor has been chekcout, <strong><?=$this->session->flashdata('checkout');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <?php if (empty($memberHistory)): ?>
                    <div class="alert alert-danger" role="alert">
                        Visitor Data Not Found.
                    </div>
            <?php endif;?>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Entry Hours</th>
                    <th scope="col">Type</th>
                    <th scope="col">Name</th>
                    <th scope="col">Card ID</th>
                    <th scope="col">Membership Date Limit</th>
                    <th scope="col">Checkout Hours</th>
                    <!-- <th scope="col">Checkout</th> -->
                    <!-- <th scope="col">Aksi</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php foreach ($memberHistory as $mbr): ?>
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
                    <td><?=$mbr['checkout']?></td>
                    <!-- <td>
                        <a href="<?=base_url()?>home/checkout/<?=$mbr['check_id']?>" class="btn btn-danger">Checkout</a>

                    </td> -->
                    </tr>

                    <?php endforeach;?>
                </tbody>
            </table>


        </div>

    </div>

</div>