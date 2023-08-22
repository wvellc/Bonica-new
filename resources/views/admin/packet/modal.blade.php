<!-- The Modal -->
<div id="packet_import" class="modal">
  <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Import Guar Price Excel</h5>
                <button type="button" class="close" aria-label="Close" onclick="CloseModal()">
                    <span aria-hidden="true">×</span>
                </button>
        </div>
        <div class="modal-body">
           <?= Form::open(['id'=>'import_guar_prices','files' => true]); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group">
                                <label for="moq_file" class="w-100 mt-4">Choose Excel File</label>
                                <input type="file" class="form-control" name="guar_price" id="guar_price">
                                <span id="guar_price_error" class="text-danger"><?=$errors->first('guar_price')?></span>
                                <br>
                        
                                <span id="detailed_sample_file" class="sample_file"><a href="<?= asset(GUAR_PRICE_FILE_PATH) ?>" >Click here</a> to download sample file</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button role="button" onclick="CloseModal()" class="mr-2 mb-2 btn btn-danger icon-btn" title="cancel">Cancel</a>
                        <button role="button" class="btn btn-primary mr-2 mb-2 save" id="import_guar_price" title="save">Save</button>
                    </div>
                <?= Form::close() ?>
        </div>
        <div class="modal-footer">
        </div>
    </div>

</div>