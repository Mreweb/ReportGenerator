<span class="btn btn-info table-row-count"><?php echo $count; ?></span>
<?php
if ((isset($data) && !$data) || $data == NULL) { ?>
    <tr class="warning">
        <td colspan="12">موردی یافت نشد</td>
    </tr>
<?php } else {
    $counter = $startPage + 1;
    foreach ($data as $item) { ?>
        <tr>
            <td class="fit"><?php echo $item['OrderId']."-".$item['FoundationId']."-".$item['CustomerId']; ?></td>
            <td><?php echo $item['OrderTitle']; ?></td>
            <td class="fit"><?php echo $item['CustomerTitle']; ?></td>
            <td class="fit"><?php echo $item['FoundationTitle']; ?></td>
            <td class="fit"><?php echo pipeStatus($item['orderIsActive']); ?></td>
            <td class="fit"><?php echo convertDate($item['CreateDateTime']); ?></td>
            <td class="fit">
                    <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                        عملیات <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url('Customer/Panel/Orders/result/') . $item['OrderId']; ?>">نتایج سفارش</a></li>
                    </ul>
                </div>
                <?php }  ?>
            </td>
        </tr>
    <?php } ?>