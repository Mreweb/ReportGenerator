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
            <td class="fit"><?php echo $item['FoundationId']; ?></td>
            <td><?php echo $item['FoundationTitle']; ?></td>
            <td class="fit"><?php echo pipeStatus($item['IsActive']); ?></td>
            <td class="fit"><?php echo convertDate($item['CreateDateTime']); ?></td>
            <td class="fit">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                        عملیات <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url('Panel/Foundation/account/') . $item['FoundationId']; ?>">رابط</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Panel/Foundation/edit/') . $item['FoundationId']; ?>">ویرایش</a>
                        </li>
                        <li>
                            <a class="remove" data-id="<?php echo $item['FoundationId']; ?>"
                               data-title="<?php echo $item['FoundationTitle']; ?>">
                                حذف
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php }
} ?>