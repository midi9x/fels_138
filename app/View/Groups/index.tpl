<div class="row">
    <div class="col-sm-3">
        <h2>{__('Groups')}</h2>
    </div>
    <div class="col-sm-2 col-sm-offset-7">
        {$this->Html->link('<i class="fa fa-plus"></i> Add', ['action' => 'add'], [
            'class' => 'btn btn-primary',
            'escape' => false
        ])}
    </div>
</div>
<table class="table table-hover">
    <tr>
        <th width="30">#</th>
        <th width="300">{__('Name')}</th>
        <th class="actions"  width="80">{__('Actions')}</th>
    </tr>
    {foreach $groups as $group }
        <tr>
            <td>{$group['Group']['id']}</td>
            <td>{$group['Group']['name']}</td>
            <td class="actions">
                {$this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'edit', $group['Group']['id']], [
                    'class' => 'btn btn-warning',
                    'escape' => false
                ])}
                {$this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $group['Group']['id']], [
                    'confirm' => 'Are you sure to delete?',
                    'class' => 'btn btn-danger',
                    'escape' => false
                ])}
            </td>
        </tr>
    {/foreach}
</table>
<div class="text-center ">
    <ul>
        {$this->Paginator->prev('Previous', ['class' => 'btn btn-default prev'], null, [
            'class' => 'btn btn-default prev disabled'
        ])}
        {$this->Paginator->numbers([
            'separator' => '',
            'class' => 'btn btn-default', 
            'currentClass' => 'disabled'
        ])}
        {$this->Paginator->next('Next', ['class' => 'btn btn-default next'], null, [
            'class' => 'btn btn-default next disabled'
        ])}
        </ul>
</div>
