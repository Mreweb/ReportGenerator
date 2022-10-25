<input type="hidden" id="inputAreaId"  <?php  setInputValue($area['AreaId']);?>  />
<input type="hidden" id="inputAreaItemsCount"  <?php  setInputValue(sizeof($areaItems));?>  />
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>حوزه</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaTitle">عنوان حوزه ارزیابی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php  setInputValue($area['AreaTitle']);?>
                                                   maxlength="80" minlength="3"
                                                   disabled
                                                   id="inputAreaTitle" name="inputAreaTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaDataType">نوع داده</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select
                                                disabled class="form-control" id="inputAreaDataType">
                                                <?php setSelectData($Enum['AreaDataType'] , $area['AreaDataType']); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>بارگذاری فایل</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaTitle">
                                        انتخاب فایل
                                        <button id="exportScoreFile" class="btn btn-primary">(دریافت فایل خروجی نمرات)</button>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control"  id="file" name="file"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>نمرات</legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="fit">نام</th>
                                        <th class="fit">نام خانوداگی</th>
                                        <th class="fit">کد ملی</th>
                                        <?php foreach ($areaItems as $item){ ?>
                                            <th class="fit">
                                                <?php echo $item['FATTitle'] ?>
                                            </th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody class="table-rows"></tbody>
                                </table>
                                <div class="col-xs-12">
                                    <div class="pagination-holder clearfix">
                                        <div id="light-pagination" class="pagination light-theme simple-pagination">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>