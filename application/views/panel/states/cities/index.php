 <section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 info-box" style="padding: 28px;font-weight: 900;">
                        استان <?php echo $data['StateName']; ?>
                </div>
                <div class="row col-xs-12 info-box"  style="padding:15px;font-weight: 900;">
                    <div class="row col-xs-12 body zp">
                        <div  class="row col-xs-12">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="hidden"
                                           value="<?php echo $data['StateId']; ?>"
                                           id="inputStateId" name="inputStateId"/>
                                    <div class="form-line">
                                        <input type="text" class="form-control"
                                               placeholder="عنوان شهرستان را جهت افزودن به استان وارد کنید"
                                               id="inputCityName" name="inputCityName"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <button
                                        style="position: relative;top:6px;"
                                        type="button" id="addStateCity" class="btn btn-primary waves-effect pull-right">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="fit">#</th>
                                    <th>عنوان شهرستان</th>
                                    <th class="fit">حذف</th>
                                </tr>
                                </thead>
                                <tbody class="table-rows">
                                <?php
                                if ((isset($cities) && !$cities) || $cities == NULL) { ?>
                                    <tr class="warning">
                                        <td colspan="6">موردی یافت نشد</td>
                                    </tr>
                                <?php } else {
                                    $counter = 1;
                                    foreach ($cities as $city) { ?>
                                        <tr>
                                            <td class="fit"><?php echo $counter++; ?></td>
                                            <td class="edit-city" data-id="<?php echo $city['CityId']; ?>" contentEditable='true'><?php echo $city['CityName']; ?></td>
                                            <td class="fit">
                                                <a class="remove-city"
                                                   data-id="<?php echo $city['CityId']; ?>"
                                                   data-state-id="<?php echo $data['StateId']; ?>"
                                                   data-title="<?php echo $city['CityName']; ?>">
                                                    <button type="button"
                                                            class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
