<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                                    <fieldset class="col-xs-12 info">
                                        <legend>مشخصات سفارش</legend>
                                        <input type="hidden" class="form-control"
                                            <?php  setInputValue($order['OrderId']); ?>
                                               id="inputOrderId" name="inputOrderId"/>
                                        <input type="hidden" class="form-control"
                                               <?php  setInputValue($orderModel['ModelId']); ?>
                                               id="inputModelId" name="inputModelId"/>

                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label class="required" for="inputModelTitle">عنوان مدل</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                           disabled
                                                           <?php  setInputValue($orderModel['ModelTitle']); ?>
                                                           maxlength="80" minlength="3"
                                                           id="inputModelTitle" name="inputModelTitle"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="col-xs-12">
                                        <legend>افزودن ابزار</legend>
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <label class="required" for="inputToolType">نوع ابزار</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select class="form-control" id="inputToolType">
                                                        <?php foreach ($Enum['ToolType'] as $key=>$value) { ?>
                                                            <option value="<?php echo $key; ?>">
                                                                <?php echo $value; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 hidden tool-other">
                                            <label class="required" for="inputToolTitle">عنوان ابزار</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                           maxlength="80" minlength="3"
                                                           id="inputToolTitle" name="inputToolTitle"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-3 hidden tool-common">
                                            <label class="required">عنوان ابزار</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select class="form-control tool-common-select">
                                                        <?php foreach ($orderCommonTools as $orderCommonTool) { ?>
                                                            <option
                                                                    data-common-file="<?php echo $orderCommonTool['ToolGuideFile']; ?>"
                                                                    value="<?php echo $orderCommonTool['ToolTitle']; ?>">
                                                                <?php echo $orderCommonTool['ToolTitle']; ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-3 tool-other-file">
                                            <label for="inputDescriptionFile">فایل راهنما</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="file" class="form-control"
                                                           id="inputDescriptionFile" name="inputDescriptionFile"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-6 col-md-3 hidden tool-common-file">
                                            <label for="inputToolCommonDescriptionFile">فایل راهنما</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                           maxlength="80" minlength="3"
                                                           id="inputToolCommonDescriptionFile" name="inputToolCommonDescriptionFile"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xs-12">
                                            <button id="addTools" type="button" class="btn btn-success waves-effect pull-left">
                                                ذخیره
                                            </button>
                                        </div>
                                    </fieldset>
                                    <fieldset class="col-xs-12">
                                        <legend> فهرست ابزارها</legend>
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>عنوان ابزار</th>
                                                <th class="fit">سفارش</th>
                                                <th class="fit">نوع</th>
                                                <th class="fit">فایل</th>
                                                <th class="fit">عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($orderTools as $item) {  ?>
                                            <tr>
                                                <td><?php echo $item['ToolTitle']; ?></td>
                                                <td class="fit"><?php echo $order['OrderTitle']; ?></td>
                                                <td class="fit"><?php echo pipeToolType($item['ToolType']); ?></td>
                                                <td class="fit">

                                                    <a download class="down-btn" href="<?php echo $item['ToolGuideFile']; ?>">
                                                        <button class="btn btn-warning">
                                                            دانلود
                                                        </button>
                                                    </a>
                                                </td>
                                                <td class="fit">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            عملیات <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="<?php echo base_url('Panel/Orders/uploadToolComponet/'.$item['ToolId']); ?>">بارگذاری فایل بعد/مولفه</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo base_url('Panel/Orders/toolsEdit/'.$item['ToolId']); ?>">ویرایش</a>
                                                            </li>
                                                            <li>
                                                                <a class="remove" data-id="<?php echo $item['ToolId']; ?>"
                                                                   data-title="<?php echo $item['ToolTitle']; ?>">
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