<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>مشخصات دوره</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderTitle">عنوان دوره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputOrderTitle" name="inputOrderTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputFoundationId">سازمان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputFoundationId" id="inputFoundationId">
                                                <?php foreach ($foundation as $item) { ?>
                                                    <option value="<?php echo $item['FoundationId']; ?>">
                                                        <?php echo $item['FoundationTitle']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakContent">شکستن متن</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputBreakContent" id="inputBreakContent">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakTable">شکستن جدول</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputBreakTable" id="inputBreakTable">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button type="button" id="addOrder" class="btn btn-success pull-left waves-effect">ذخیره</button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>