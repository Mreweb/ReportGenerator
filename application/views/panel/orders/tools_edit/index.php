<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">

                            <input type="hidden" class="form-control"
                                <?php setInputValue($tool['ToolId']); ?>
                                   maxlength="80" minlength="3"
                                   id="inputToolId" name="inputToolId"/>
                                <fieldset class="col-xs-12">
                                    <legend>ویرایش ابزار</legend>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <label class="required" for="inputToolType">نوع ابزار</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select class="form-control" id="inputToolType">
                                                    <?php foreach ($Enum['ToolType'] as $key=>$value) { ?>
                                                        <option
                                                            <?php setOptionSelected($tool['ToolType'] , $key); ?>
                                                                value="<?php echo $key; ?>">
                                                            <?php echo $value; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <label class="required" for="inputToolTitle">عنوان ابزار</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control"
                                                    <?php setInputValue($tool['ToolTitle']); ?>
                                                       maxlength="80" minlength="3"
                                                       id="inputToolTitle" name="inputToolTitle"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3">
                                        <label for="inputDescriptionFile">فایل توضیحات</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" class="form-control"
                                                       id="inputDescriptionFile" name="inputDescriptionFile"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <button id="editTools" type="button" class="btn btn-success waves-effect pull-left">
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
    </div>
</section>