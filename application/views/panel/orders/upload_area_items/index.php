<input type="hidden" id="inputAreaId"  <?php  setInputValue($area['AreaId']);?>  />
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
                                        <a href="<?php echo base_url('template/area_item.xlsx') ?>">(فایل نمونه)</a>
                                    </label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control"  id="file" name="file"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>مولفه ها</legend>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>عنوان مولفه</th>
                                        <th class="fit">تاریخ ثبت</th>
                                        <th class="fit">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody  class="sortable">
                                    <?php
                                    foreach ($areaItems as $item) { ?>
                                        <tr class="ability-row">
                                            <td><?php echo $item['FATTitle']; ?></td>
                                            <td class="fit"><?php echo convertDate($item['CreateDateTime']); ?></td>
                                            <td class="fit">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        عملیات <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="<?php echo base_url('Panel/Orders/editAreaItem/' . $item['FATId']); ?>">ویرایش</a>
                                                        </li>
                                                        <li>
                                                            <a class="remove"
                                                               data-id="<?php echo $item['FATId']; ?>"
                                                               data-title="<?php echo $item['FATTitle']; ?>">
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