    <h3><?= h($cmiProduct->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($cmiProduct->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Url Name') ?></th>
            <td><?= h($cmiProduct->url_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($cmiProduct->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Full Url') ?></th>
            <td><?= h($cmiProduct->full_url) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cmiProduct->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Country Id') ?></th>
            <td><?= $this->Number->format($cmiProduct->country_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Type Id') ?></th>
            <td><?= $this->Number->format($cmiProduct->product_type_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Id') ?></th>
            <td><?= $this->Number->format($cmiProduct->product_id) ?></td>
        </tr>
    </table>
