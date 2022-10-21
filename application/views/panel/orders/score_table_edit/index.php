<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>ویرایش نمره</legend>
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($option['OptionId']); ?>
                                       maxlength="80" minlength="3"
                                       id="inputOptionId" name="inputOptionId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOptionTitle">عنوان کیفی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php setInputValue($option['OptionTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputOptionTitle" name="inputOptionTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOptionValue">مقدار کمی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php setInputValue($option['OptionValue']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputOptionValue" name="inputOptionValue"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 p-0">
                                    <button id="editModelOption" type="button" class="btn btn-success waves-effect pull-left">
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
    </div>
</section>