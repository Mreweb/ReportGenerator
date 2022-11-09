<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <input type="hidden" id="inputAreaId"  <?php  setInputValue($area['AreaId']);?>  />
                            <fieldset class="col-xs-12">
                                <legend>افزودن حوزه</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaTitle">عنوان حوزه ارزیابی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php  setInputValue($area['AreaTitle']);?>
                                                   maxlength="80" minlength="3"
                                                   id="inputAreaTitle" name="inputAreaTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaDataType">نوع داده</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputAreaDataType">
                                                <?php setSelectData($Enum['AreaDataType'] , $area['AreaDataType']); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakContent">شکستن متن</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputBreakContent" id="inputBreakContent">
                                                <option <?php setOptionSelected($area['BreakContent'] , 0); ?>  value="0">خیر</option>
                                                <option <?php setOptionSelected($area['BreakContent'] , 1); ?>  value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakTable">شکستن جدول</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputBreakTable" id="inputBreakTable">
                                                <option <?php setOptionSelected($area['BreakTable'] , 0); ?>   value="0">خیر</option>
                                                <option <?php setOptionSelected($area['BreakTable'] , 1); ?>   value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <label class="required" for="inputAreaContent">توضیحات</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea type="text" class="form-control" style="width: 100%;height: 150px;resize: none" id="inputAreaContent" name="inputAreaContent"><?php echo nl2br($area['AreaContent']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="edit" type="button"
                                            class="btn btn-success waves-effect pull-left">
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