<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>مشخصات دوره</legend>
                                <input type="hidden" class="form-control"
                                       <?php setInputValue($order['OrderId']); ?>
                                       maxlength="80" minlength="3"
                                       id="inputOrderId" name="inputOrderId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderTitle">عنوان دوره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php setInputValue($order['OrderTitle']); ?>
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
                                                    <option  <?php setOptionSelected($order['FoundationId'] , $item['FoundationId']); ?> value="<?php echo $item['FoundationId']; ?>">
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
                                                <option <?php setOptionSelected($order['BreakContent'] , 0); ?>  value="0">خیر</option>
                                                <option <?php setOptionSelected($order['BreakContent'] , 1); ?>  value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakTable">شکستن جدول</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputBreakTable" id="inputBreakTable">
                                                <option <?php setOptionSelected($order['BreakTable'] , 0); ?>   value="0">خیر</option>
                                                <option <?php setOptionSelected($order['BreakTable'] , 1); ?>   value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputIsActive">وضعیت</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputIsActive">
                                                <option <?php setOptionSelected($order['IsActive'] , 1); ?> value="1">فعال</option>
                                                <option <?php setOptionSelected($order['IsActive'] , 0); ?> value="0">غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button type="button" id="editOrder" class="btn btn-success waves-effect pull-left">ذخیره</button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>