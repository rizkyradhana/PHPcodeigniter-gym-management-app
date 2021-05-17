<?php
$totalWhey = 0;
$totalGainer = 0;
$totalAmino = 0;
$totalPower = 0;
$jumlahWhey = 0;
$jumlahGainer = 0;
$jumlahAmino = 0;
$jumlahPower = 0;

foreach ($penjualanHistory as $pHChart) {
    if ($pHChart['produk_id'] == 1) {
        $totalWhey = $totalWhey + $pHChart['total'];
        $jumlahWhey++;
    } else if ($pHChart['produk_id'] == 2) {
        $totalGainer = $totalGainer + $pHChart['total'];
        $jumlahGainer++;
    } else if ($pHChart['produk_id'] == 3) {
        $totalAmino = $totalAmino + $pHChart['total'];
        $jumlahAmino++;
    } else if ($pHChart['produk_id'] == 4) {
        $totalPower = $totalPower + $pHChart['total'];
        $jumlahPower++;

    }

}

// foreach ($produk as $prod) {
//     $arrProd[] = ['label' => $prod['nama'], 'y' => $prod['harga']];
// }

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
                        title:{
                            text: "Omzet Penjualan Suplemen Berdasarkan Tanggal"
                        },
                        axisY: {
                            title: "OMZET (Rp)",
                            titleFontColor: "#4F81BC",
                            lineColor: "#4F81BC",
                            labelFontColor: "#4F81BC",
                            tickColor: "#4F81BC"
                        },
                        axisY2: {
                            title: "Jumlah Penjualan",
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
                            name: "Omzet Penjualan (Rp)",
                            legendText: " ",
                            showInLegend: true,
                            dataPoints:[
                                { label: "Whey Protein", y: <?=$totalWhey?> },
                                { label: "Weight Gainer", y: <?=$totalGainer?> },
                                { label: "Amino Tabs", y: <?=$totalAmino?> },
                                { label: "Power", y: <?=$totalPower?> },

                            ]
                        },
                        {
                            type: "column",
                            name: "Jumlah Penjualan",
                            legendText: "Nama Suplemen",
                            axisYType: "secondary",
                            showInLegend: true,
                            dataPoints:[
                                { label: "Whey Protein", y: <?=$jumlahWhey?> },
                                { label: "Weight Gainer", y: <?=$jumlahGainer?> },
                                { label: "Amino Tabs", y: <?=$jumlahAmino?> },
                                { label: "Power", y: <?=$jumlahPower?> },

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
        <h3>Suplement Sales History Executive Gym</h3>
        </div>

        <div class="col-md-5">
                <?php $totalPemasukan = 0;?>
                <?php for ($i = 0; $i < count($penjualanHistory); $i++) {
    $totalPemasukan = $totalPemasukan + $penjualanHistory[$i]['total'];
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
                    <th scope="col">Supplement Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1?>
                    <?php foreach ($penjualanHistory as $mbr): ?>
                    <tr>
                    <th scope="row"><?=$i++?></th>
                    <td><?=$mbr['waktu']?></td>
                    <td><?=$mbr['nama']?></td>
                    <td><?=$mbr['jumlah']?></td>
                    <td>Rp<?=number_format($mbr['harga'])?></td>
                    <td>Rp<?=number_format($mbr['total'])?></td>


                    <?php endforeach;?>
                </tbody>
            </table>
            <div class="row mt-3">

            </div>
            <?php if (empty($penjualanHistory)): ?>
                    <div class="alert alert-danger" role="alert">
                        Sales Data Not Found.
                    </div>
            <?php endif;?>

        </div>

    </div>

</div>
