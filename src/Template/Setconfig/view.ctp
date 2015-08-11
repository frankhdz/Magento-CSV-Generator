<div class="actions columns col-lg-2 col-md-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="nav nav-stacked nav-pills">
        <li><?= $this->Html->link(__('Edit Setconfig'), ['action' => 'edit', $setconfig->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Setconfig'), ['action' => 'delete', $setconfig->id], ['confirm' => __('Are you sure you want to delete # {0}?', $setconfig->id), 'class' => 'btn-danger']) ?> </li>
        <li><?= $this->Html->link(__('List Setconfig'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Setconfig'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="setconfig view col-lg-10 col-md-9 columns">
    <h2><?= h($setconfig->id) ?></h2>
    <div class="row">
        <div class="col-lg-5 columns strings">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="subheader"><?= __('Attribute') ?></h6>
                    <p><?= h($setconfig->attribute) ?></p>
                    <h6 class="subheader"><?= __('Value') ?></h6>
                    <p><?= h($setconfig->value) ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-2 columns numbers end">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h6 class="subheader"><?= __('Id') ?></h6>
                    <p><?= $this->Number->format($setconfig->id) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
