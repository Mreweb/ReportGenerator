<span class="btn btn-info table-row-count"><?php echo $count; ?></span>
<?php
if ((isset($data) && !$data) || $data == NULL) { ?>
    <tr class="warning">
        <td colspan="6">موردی یافت نشد</td>
    </tr>
<?php } else {
    $counter = $startPage+1;
    foreach ($data as $state) { ?>
        <tr>
            <td class="fit"><?php echo $counter++; ?></td>
            <td><?php echo $state['StateName']; ?></td>
            <td class="fit">
                <a href="<?php echo base_url('Panel/States/cities/') . $state['StateId']; ?>">
                    <button type="button"
                            class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                        <i class="material-icons">rate_review</i>
                    </button>
                </a>
            </td>
            <td class="fit">
                <a href="<?php echo base_url('Panel/States/edit/') . $state['StateId']; ?>">
                    <button type="button"
                            class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
                        <i class="material-icons">rate_review</i>
                    </button>
                </a>
            </td>
        </tr>
    <?php }
} ?>