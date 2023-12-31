<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12 info">
                                <legend>مشخصات دوره</legend>
                                <input type="hidden" class="form-control" <?php setInputValue($order['OrderId']); ?> id="inputOrderId" name="inputOrderId"/>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputOrderTitle">عنوان دوره</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   disabled
                                                <?php setInputValue($order['OrderTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputOrderTitle" name="inputOrderTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>افزودن حوزه</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaTitle">عنوان حوزه ارزیابی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
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
                                                <?php setSelectData($Enum['AreaDataType']); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputTanasob">تناسب دارد؟</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputTanasob" id="inputTanasob">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
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
                                    <label class="required" for="inputBreakContentFont">اندازه فونت متن</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputBreakContentFont" name="inputBreakContentFont"/>
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
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakTableFont">اندازه فونت جدول</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputBreakTableFont" name="inputBreakTableFont"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputBreakChart">شکستن نمودار</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputBreakChart" id="inputBreakChart">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputCommonFeatures">ویژگی های برجسته</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control" name="inputCommonFeatures" id="inputCommonFeatures">
                                                <option value="0">خیر</option>
                                                <option value="1">بله</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAreaTitle">تعداد ویژگی های برجسته</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputCommonFeaturesCount" name="inputCommonFeaturesCount"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <label class="required" for="inputAreaContent">توضیحات</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea type="text" class="form-control" style="width: 100%;height: 150px;resize: none" id="inputAreaContent" name="inputAreaContent"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="addAbility" type="button"
                                            class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend> حوزه های ارزیابی دوره <?php echo $order['OrderTitle']; ?></legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>عنوان حوزه ارزیابی</th>
                                        <th class="fit">نوع داده</th>
                                        <th class="fit">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody  class="sortable">
                                    <?php
                                    foreach ($orderArea as $item) {  ?>
                                        <tr class="ability-row">
                                            <td><?php echo $item['AreaTitle']; ?></td>
                                            <td class="fit"><?php echo pipeEnum('AreaDataType', $item['AreaDataType']); ?></td>
                                            <td class="fit">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        عملیات <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/uploadItemsScore/' . $item['AreaId']); ?>">بارگذاری نمرات</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/uploadItems/' . $item['AreaId']); ?>">بارگذاری مولفه ها</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/editArea/' . $item['AreaId']); ?>">ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="remove"
                                                               data-id="<?php echo $item['AreaId']; ?>"
                                                               data-title="<?php echo $item['AreaTitle']; ?>">
                                                                حذف
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>