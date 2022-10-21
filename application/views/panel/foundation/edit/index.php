<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">

                            <fieldset class="col-xs-12">
                                <legend>اطلاعات موسسه ارزیابی</legend>
                                <input <?php setInputValue($foundation['FoundationId']); ?> type="hidden"
                                       name="inputFoundationId" id="inputFoundationId"/>

                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label class="required" for="inputFoundationTitle">عنوان موسسه ارزیابی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   <?php setInputValue($foundation['FoundationTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputFoundationTitle" name="inputFoundationTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputIsActive">وضعیت</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" id="inputIsActive">
                                                <option <?php setOptionSelected($foundation['IsActive'] , 1); ?> value="1">فعال</option>
                                                <option <?php setOptionSelected($foundation['IsActive'] , 0); ?> value="0">غیرفعال</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-xs-12 p-0">
                                <button type="button" id="editFoundation" class="btn btn-primary waves-effect">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

