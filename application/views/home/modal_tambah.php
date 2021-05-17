<button type="submit" class="btn btn-success" name = "masuk" data-toggle="modal" data-target="#kunciModal">

        Get in
        </button>
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