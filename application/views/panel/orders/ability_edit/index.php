<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($ability['AbilityId']); ?>
                                       id="inputAbilityId" name="inputAbilityId"/>
                                <legend>افزودن شایستگی</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAbilityTitle">عنوان شایستگی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php setInputValue($ability['AbilityTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputAbilityTitle" name="inputAbilityTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputLow">کمترین نمره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php setInputValue($ability['Low']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputLow" name="inputLow"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputHigh">بیشترین نمره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php setInputValue($ability['High']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputHigh" name="inputHigh"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputMin">حداقل نمره قابل قبول</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php setInputValue($ability['Min']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputMin" name="inputMin"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputLowEditRange">حداقل بازه تغییر</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control text-center ltr"
                                                <?php setInputValue($ability['LowEditRange']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputLowEditRange" name="inputLowEditRange"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputHighEditRange">حداکثر بازه تغییر</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control text-center ltr"
                                                <?php setInputValue($ability['HighEditRange']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputHighEditRange" name="inputHighEditRange"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputRandType">نحوه رند نمره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputRandType" name="inputRandType">
                                                <?php foreach ($Enum['RondType'] as $key => $value) { ?>
                                                    <option
                                                            <?php setOptionSelected($key , $ability['RandType']); ?>
                                                            value="<?php echo $key; ?>">
                                                        <?php echo $value; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="editAbility" type="button" class="btn btn-success waves-effect pull-left">
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