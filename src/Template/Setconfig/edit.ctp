<div class="actions columns col-lg-2 col-md-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="nav nav-stacked nav-pills">
        <li class="active disabled"><?= $this->Html->link(__('Edit Setconfig'), ['action' => 'edit', $setconfig->id]) ?> </li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $setconfig->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $setconfig->id), 'class' => 'btn-danger']
            )
        ?></li>
        <li><?= $this->Html->link(__('New Setconfig'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Setconfig'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="setconfig form col-lg-10 col-md-9 columns">
    <?= $this->Form->create($setconfig); ?>
    <fieldset>
        <legend><?= __('Edit Setconfig') ?></legend>
        <?php
            echo $this->Form->input('attribute');
            echo $this->Form->input('value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class' => 'btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
