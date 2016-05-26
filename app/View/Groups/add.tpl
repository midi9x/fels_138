<div class="row">
{$this->Form->create('Group')}
    {$this->Form->input('name', [
        'before' => '<div class="form-group">',
        'after' => '</div>',
        'class' => 'form-control',
        'label' => 'Group name: '
    ])}

    {$this->Form->submit('Add ', [
        'class' => 'btn btn-primary'
    ])}
{$this->Form->end()}
</div>
