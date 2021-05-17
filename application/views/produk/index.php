<div class="container">

    <div class="row mt-3">
            <?php foreach ($produk as $pro): ?>
                <div class="col-md-3 mt-3">
                    <div class="card">
                            <div class="card-header" style="text-align:center;">Remaining Stock = <?=$pro['stok']?></div>
                            <?php if ($this->session->has_userdata('resepsionis')): ?>
                            <a href="<?=base_url()?>produk/tambahStok/<?=$pro['produk_id']?>" class="btn btn-info mt-3 btn-sm">Add Stock</a>
                            <?php endif;?>
                        <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <div class="" style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; text-align:center">
                                    <img src="<?=base_url()?>assets/img/<?=$pro['gambar']?>" class="img-fluid w-80 p-3" alt="">
                                    <h4 class="text-info mx-auto"><?=$pro['nama']?></h4>
                                    <h4 class="text-danger">Price:Rp<?=number_format($pro['harga'])?></h4>
                                    <?php if ($this->session->has_userdata('resepsionis')): ?>
                                    <input type="number" name="jumlah" class="form-control" value="1">
                                    <?php endif;?>
                                    <input type="hidden" name="nama" value="<?=$pro['nama']?>">
                                    <input type="hidden" name="harga" value="<?=$pro['harga']?>">
                                    <input type="hidden" name="produk_id" value="<?=$pro['produk_id']?>">
                                    <input type="hidden" name="stok" value="<?=$pro['stok']?>">
                                    <?php if ($this->session->has_userdata('resepsionis')): ?>
                                    <input type="submit" name="cart" style="margin-top:5px" class="btn btn-success" value="Add to cart">
                                    <?php endif;?>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
    </div>
            <?php if ($this->session->has_userdata('resepsionis')): ?>
            <div class="row mt-3">
                <div class="col-md-12">
            <h3 class="text-center">Cart</h3>
                </div>
            </div>
            <?php if ($this->session->flashdata('cart')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Suplement has successfully <strong><?=$this->session->flashdata('cart');?></strong> to Cart
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
                            Transaction <strong><?=$this->session->flashdata('checkout');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>

            <?php if ($this->session->flashdata('hapusCart')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Data in the cart <strong><?=$this->session->flashdata('hapusCart');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('addStok')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Suplemen stock has successfully  <strong><?=$this->session->flashdata('addStok');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($this->session->flashdata('noStok')): ?>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?=$this->session->flashdata('noStok');?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif;?>


            <div class="table-responsive">
                <div class="col-md-12">
                <table class="table table-responsive">
                        <tr>
                            <!-- <th width="5%">Jam Beli</th> -->
                            <th width="5%">Name</th>
                            <th width="5%">Quantity</th>
                            <th width="10%">Price</th>
                            <th width="10%">Total</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php foreach ($dataCart as $dcart): ?>
                        <tr>
                            <!-- <th width="5%"><?=$dcart['waktu']?></th> -->
                            <th width="5%"><?=$dcart['nama']?></th>
                            <th width="5%"><?=$dcart['jumlah']?></th>
                            <th width="10%">Rp<?=number_format($dcart['harga'])?></th>
                            <th width="10%">Rp<?=number_format($dcart['total'])?></th>
                            <th width="10%"><a href="<?=base_url()?>produk/hapusCart/<?=$dcart['id']?>/<?=$dcart['produk_id']?>/<?=$dcart['jumlah']?>" class="btn btn-danger btn-sm">Delete Item</a></th>
                        </tr>
                        <?php endforeach;?>

                </table>
                <!-- <div class="col-md-5"> -->
                <?php $totalPemasukan = 0;?>
                <?php for ($i = 0; $i < count($dataCart); $i++) {
    $totalPemasukan = $totalPemasukan + $dataCart[$i]['total'];
}?>
            <h3 class="text-center text-black bg-light float-right"><strong>Total Price = Rp<?=number_format($totalPemasukan)?></strong></h3>
                <!-- </div> -->
                <?php if (!empty($dataCart)): ?>
                <tr>
                    <form method="post" action="" target="_blank">
                        <input type="submit" name="checkout" class="btn btn-primary float-right btn-block" value="Checkout" >
                    </form>
                </tr>
                <?php endif;?>
                <?php if (empty($dataCart)): ?>
                <tr>
                    <div class="alert alert-secondary" role="alert">
                        <h5>Cart Still Empty.</h5>
                    </div>
                </tr>
                <?php endif;?>
                </div>
            </div>
                <?php endif;?>

</div>




