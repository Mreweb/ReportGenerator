<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($marker['MarkerId']); ?>
                                       id="inputMarkerId" name="inputMarkerId"/>
                                <legend>ویرایش نشانگر</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputMarkerTitle">عنوان نشانگر</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php setInputValue($marker['MarkerTitle']); ?>
                                                   maxlength="200" minlength="3"
                                                   id="inputMarkerTitle" name="inputMarkerTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="editMarker" type="button" class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>