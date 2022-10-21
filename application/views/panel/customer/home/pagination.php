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
            <td class="fit"><?php echo $counter++; ?></td>
            <td><?php echo $item['CustomerTitle']; ?></td>
            <td class="fit"><?php echo $item['FoundationTitle']; ?></td>
            <td class="fit"><?php echo convertDate($item['CreateDateTime']); ?></td>
            <td class="fit">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        عملیات <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url('Panel/Customer/account/') . $item['CustomerId']; ?>">رابط ها</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Panel/Customer/edit/') . $item['CustomerId']; ?>">ویرایش</a>
                        </li>
                        <li>
                            <a class="remove" data-id="<?php echo $item['CustomerId']; ?>" data-title="<?php echo $item['CustomerTitle']; ?>">
                                حذف
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php }
} ?>