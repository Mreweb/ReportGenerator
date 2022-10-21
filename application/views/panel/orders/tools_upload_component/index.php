<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <input type="hidden" class="form-control" <?php setInputValue($tool['ToolId']); ?>
                                   maxlength="80" minlength="3" id="inputToolId" name="inputToolId"/>
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation"><a href="#home" data-toggle="tab">بارگذاری فایل</a></li>
                                <li role="presentation" class="active"><a href="#profile" data-toggle="tab">تخصیص روابط بعد / مولفه</a></li>
                                <li role="presentation"><a href="#score" data-toggle="tab">بارگذاری فایل نمره</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade" id="home">
                                    <fieldset class="col-xs-12">
                                        <legend>مشخصات ابزار</legend>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label class="required" for="inputToolTitle">عنوان ابزار</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                           disabled
                                                        <?php setInputValue($tool['ToolTitle']); ?>
                                                           maxlength="80" minlength="3"
                                                           id="inputToolTitle" name="inputToolTitle"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="col-xs-12">
                                        <legend>بارگذاری فایل</legend>
                                        <form id="fileupload" method="POST" enctype="multipart/form-data">
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <label class="required" for="inputFile">انتخاب فایل</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control"
                                                               id="inputFile" name="inputFile"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <label for="uploadComponent">&nbsp;</label>
                                                <div class="form-group">
                                                    <button class="btn btn-success" id="uploadComponent">بارگذاری</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label>&nbsp;</label>
                                            <div class="form-group">
                                                <a href="<?php echo base_url('assets/xls/UploadToolComponet.xlsx') ?>">
                                                    <button class="btn btn-info">دریافت فایل نمونه</button>
                                                </a>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="col-xs-12">
                                        <legend>
                                            بعد/مولفه های
                                            <?php echo $tool['ToolTitle']; ?>
                                        </legend>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>عنوان مولفه</th>
                                                <th class="fit">توضیحات</th>
                                                <th class="fit">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (empty($components)) { ?>
                                                <tr>
                                                    <td colspan="10">
                                                        موردی یافت نشد
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php foreach ($components as $item) { ?>
                                                <tr>
                                                    <td><?php echo $item['ComponentTitle']; ?></td>
                                                    <td class="fit"><?php echo $item['Description']; ?></td>
                                                    <td class="fit">
                                                        <a class="remove" data-id="<?php echo $item['ComponentId']; ?>"
                                                           data-title="<?php echo $item['ComponentTitle']; ?>">
                                                            <button type="button" class="btn btn-danger">
                                                                حذف
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in active" id="profile">

                                    <fieldset class="col-xs-12">
                                        <legend>افزودن رابطه نشانگر - بعد/مولفه</legend>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label class="required" for="inputAbilityMarker">شایستگی-نشانگر</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select class="form-control selectpicker" id="inputAbilityMarker"
                                                            data-live-search="true">
                                                        <?php foreach ($TOA as $item) { ?>
                                                            <option value="<?php echo $item['MarkerId']; ?>"
                                                                    data-marker-id="<?php echo $item['MarkerId']; ?>"
                                                                    data-ability-id="<?php echo $item['AbilityId']; ?>">
                                                                <?php echo $item['AbilityTitle'] . "----" . $item['MarkerTitle']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label class="required" for="inputComponentId">بعد/مولفه</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select class="form-control selectpicker" id="inputComponentId"
                                                            data-live-search="true">
                                                        <?php foreach ($components as $item) { ?>
                                                            <option value="<?php echo $item['ComponentId']; ?>">
                                                                <?php echo $item['ComponentTitle']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-1">
                                            <label class="required" for="inputWeight">وزن</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input class="form-control" type="text" id="inputWeight"
                                                           name="inputWeight"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <label for="inputWeight">&nbsp;</label>
                                            <div class="form-group">
                                                <button id="addComponentAbilityRelation" type="button"
                                                        class="btn btn-primary">افزودن
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="col-xs-12">
                                        <legend>فهرست رابطه نشانگر - بعد/مولفه</legend>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th class="fit">شناسه رابطه</th>
                                                <th>عنوان بعد/مولفه</th>
                                                <th class="fit">ابزار</th>
                                                <th class="fit">شایستگی</th>
                                                <th class="fit">نشانگر</th>
                                                <th class="fit">وزن</th>
                                                <th class="fit">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if (empty($ComponentMarkerRelation)) { ?>
                                                <tr>
                                                    <td colspan="10">
                                                        موردی یافت نشد
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php foreach ($ComponentMarkerRelation as $item) { ?>
                                                <tr>
                                                    <td class="fit"><?php echo $item['RowId']; ?></td>
                                                    <td><?php echo $item['ComponentTitle']; ?></td>
                                                    <td class="fit"><?php echo $tool['ToolTitle']; ?></td>
                                                    <td class="fit">
                                                        <?php foreach ($TOA as $t) {
                                                            if($t['AbilityId'] == $item['AbilityId']){
                                                                echo  $t['AbilityTitle'];
                                                                break;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td class="fit">
                                                        <?php foreach ($TOA as $t) {
                                                            if($t['MarkerId'] == $item['MarkerId']){
                                                                echo  $t['MarkerTitle'];
                                                                break;
                                                            }
                                                        } ?>
                                                    </td>
                                                    <td class="fit"><?php echo $item['Weight']; ?></td>
                                                    <td class="fit">
                                                        <a class="remove-relation" data-id="<?php echo $item['RowId']; ?>"
                                                           data-title="رابطه با شناسه <?php echo $item['RowId']; ?>">
                                                            <button type="button" class="btn btn-danger">
                                                                حذف
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </fieldset>



                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="score">

                                    <fieldset class="col-xs-12">
                                        <legend>بارگذاری فایل</legend>
                                        <form id="scorefileupload" method="POST" enctype="multipart/form-data">
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <label class="required" for="inputScoreFile">انتخاب فایل</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="file" class="form-control"
                                                               id="inputScoreFile" name="inputScoreFile"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-3">
                                                <label for="uploadComponent">&nbsp;</label>
                                                <div class="form-group">
                                                    <button class="btn btn-success" id="uploadScoreComponent">بارگذاری</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label>&nbsp;</label>
                                            <div class="form-group">
                                                <a href="<?php echo base_url('assets/xls/UploadToolComponet.xlsx') ?>">
                                                    <button class="btn btn-info">دریافت فایل نمونه</button>
                                                </a>
                                            </div>
                                        </div>
                                    </fieldset>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>