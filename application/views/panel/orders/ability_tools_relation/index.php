<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <input type="hidden" id="inputOrderId" value="<?php echo $order['OrderId']; ?>" />
                            <fieldset class="col-xs-12">
                                <div class="col-xs-12 p-0">
                                    <table class="table table-bordered table-striped table-hover table-condensed">
                                        <thead>
                                        <tr>
                                            <th>شایستگی</th>
                                            <th>نشانگر</th>
                                            <?php foreach ($orderTools as $orderTool) { ?>
                                                <th data-tool-id="<?php echo $orderTool['ToolId']; ?>">
                                                    <?php echo $orderTool['ToolTitle']; ?>
                                                </th>
                                            <?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        foreach ($orderModelAbility as $oma) {
                                            foreach ($oma['markers'] as $marker) { ?>
                                                <tr>
                                                    <td data-tool-id="<?php echo $oma['AbilityId']; ?>">
                                                        <?php echo $oma['AbilityTitle']; ?>
                                                    </td>
                                                    <td data-tool-id="<?php echo $marker['MarkerId']; ?>">
                                                        <?php echo $marker['MarkerTitle']; ?>
                                                    </td>
                                                    <?php foreach ($orderTools as $orderTool) { ?>
                                                        <td>
                                                            <input
                                                                    type="checkbox"
                                                                    name="inputItem"
                                                                    data-ability-id="<?php echo $oma['AbilityId']; ?>"
                                                                    data-marker-id="<?php echo $marker['MarkerId']; ?>"
                                                                    data-tool-id="<?php echo $orderTool['ToolId']; ?>"
                                                                    data-title="<?php echo $marker['MarkerTitle']; ?>"
                                                                    <?php
                                                                        foreach ($oar as $item) {
                                                                            if($item['ToolId'] == $orderTool['ToolId'] && $item['MarkerId'] == $marker['MarkerId'] && $item['AbilityId'] == $oma['AbilityId']){
                                                                                echo "checked";
                                                                            }
                                                                        }
                                                                    ?>
                                                                    id="<?php echo $oma['AbilityId']; ?>-<?php echo $marker['MarkerId']; ?>-<?php echo $orderTool['ToolId']; ?>" class="filled-in relation-tick">
                                                            <label for="<?php echo $oma['AbilityId']; ?>-<?php echo $marker['MarkerId']; ?>-<?php echo $orderTool['ToolId']; ?>"></label>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-xs-12">
                                    <button id="update" type="button" class="btn btn-success waves-effect pull-left">
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
</section>