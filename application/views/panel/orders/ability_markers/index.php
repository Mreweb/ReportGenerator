<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">

                            <fieldset class="col-xs-12 info">
                                <input type="hidden" class="form-control"
                                    <?php setInputValue($ability['AbilityId']); ?>
                                       id="inputAbilityId" name="inputAbilityId"/>
                                <legend>مشخصات شایستگی</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputAbilityTitle">عنوان شایستگی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   disabled
                                                <?php setInputValue($ability['AbilityTitle']); ?>
                                                   maxlength="80" minlength="3"
                                                   id="inputAbilityTitle" name="inputAbilityTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>افزودن نشانگر</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputMarkerTitle">عنوان نشانگر</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" maxlength="200" minlength="3"
                                                   id="inputMarkerTitle" name="inputMarkerTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="addMarker" type="button" class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend> نشانگر های شایستگی <?php echo $ability['AbilityTitle']; ?></legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>عنوان نشانگر</th>
                                        <th class="fit">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($markers as $item) { ?>
                                        <tr>
                                            <td><?php echo $item['MarkerTitle']; ?></td>
                                            <td class="fit">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        عملیات <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/markerEdit/' . $item['MarkerId']); ?>">ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="remove" data-id="<?php echo $item['MarkerId']; ?>"
                                                               data-title="<?php echo $item['MarkerTitle']; ?>">
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
</section>