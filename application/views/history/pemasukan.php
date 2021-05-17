<?php
$totalPerpanjang = 0;
$totalNewMember = 0;
$totalNonMember = 0;
$jumlahPerpanjang = 0;
$jumlahNewMember = 0;
$jumlahNonMember = 0;

foreach ($pemasukanHistory as $pHChart) {
    if ($pHChart['tipe'] == 'Member Baru') {
        $totalNewMember = $totalNewMember + $pHChart['pemasukan'];
        $jumlahNewMember++;
    } else if ($pHChart['tipe'] == 'Perpanjang Member') {
        $totalPerpanjang = $totalPerpanjang + $pHChart['pemasukan'];
        $jumlahPerpanjang++;
    } else if ($pHChart['tipe'] === 'non-member') {
        $totalNonMember = $totalNonMember + $pHChart['pemasukan'];
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
                <input type="submit" name="mutasi" class="btn btn-primary btn-block" value="Show"></input>
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
                        title:{
                            text: "Omzet Pemasukan Dari Pengunjung Berdasarkan Tanggal"
                        },
                        axisY: {
                            title: "OMZET (Rp)",
                            titleFontColor: "#4F81BC",
                            lineColor: "#4F81BC",
                            labelFontColor: "#4F81BC",
                            tickColor: "#4F81BC"
                        },
                        axisY2: {
                            title: "Jumlah",
                            titleFontColor: "#C0504E",
                            lineColor: "#C0504E",
                            labelFontColor: "#C0504E",
                            tickColor: "#C0504E"
                        },
                        toolTip: {
                            shared: true
                        },
                        legend: {
                            cursor:"pointer",
                            itemclick: toggleDataSeries
                        },
                        data: [{
                            type: "column",
                            name: "Omzet Pemasukan (Rp)",
                            legendText: " ",
                            showInLegend: true,
                            dataPoints:[
                                { label: "Member Baru", y: <?=$totalNewMember?> },
                                { label: "Perpanjang", y: <?=$totalPerpanjang?> },
                                { label: "non-member", y: <?=$totalNonMember?> },


                            ]
                        },
                        {
                            type: "column",
                            name: "Jumlah",
                            legendText: "Tipe Pengunjung",
                            axisYType: "secondary",
                            showInLegend: true,
                            dataPoints:[
                                { label: "Member Baru", y: <?=$jumlahNewMember?> },
                                { label: "Perpanjang", y: <?=$jumlahPerpanjang?> },
                                { label: "non-member", y: <?=$jumlahNonMember?> },


                            ]
                        }]
                    });
                    chart.render();

                    function toggleDataSeries(e) {
                        if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                            e.dataSeries.visible = false;
                        }
                        else {
                            e.dataSeries.visible = true;
                        }
                        chart.render();
                    }

                    }
                    </script>
                    <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>

    <hr>
    <div class="row mt-3">
        <div class="col-md-7">
        <h3>Membership Income History in Executive Gym</h3>
        </div>

        <div class="col-md-5">
                <?php $totalPemasukan = 0;?>
                <?php for ($i = 0; $i < count($pemasukanHistory); $i++) {
    $totalPemasukan = $totalPemasukan + $pemasukanHistory[$i]['pemasukan'];
}?>
            <h3 class="text-center text-white bg-dark"><strong>Total Revenue = Rp<?=number_format($totalPemasukan)?></strong></h3>
                </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">



            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date/Time</th>
                    <th scope="col">Name</th>
                    <th scope="col">ID Card</th>
                    <th scope="col">Type</th>
                    <th scope="col">Income</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php foreach ($pemasukanHistory as $mbr): ?>
                    <tr>
                    <th scope="row"><?=$i++?></th>
                    <td><?=$mbr['waktu']?></td>
                    <td><?=$mbr['nama']?></td>
                    <td><?=$mbr['id']?></td>
                    <td><?=$mbr['tipe']?></td>
                    <td>Rp<?=number_format($mbr['pemasukan'])?></td>
                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="row mt-3">

            </div>

            <?php if (empty($pemasukanHistory)): ?>
                    <div class="alert alert-danger" role="alert">
                        Membership Income Data Not Found.
                    </div>
            <?php endif;?>

        </div>

    </div>

</div>
