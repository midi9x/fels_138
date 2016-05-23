{$this->start('css')}
	{$this->Html->css('login-register')}
{$this->end()}

<div class="col-sm-offset-3 col-sm-6">
{$this->Form->create('User')}
    {$this->Form->input('username', [
        'before' => '<div class="form-group">',
        'after' => '</div>',
        'class' => 'form-control'
    ])}

    {$this->Form->input('password', [
        'before' => '<div class="form-group">',
        'after' => '</div>',
        'class' => 'form-control',
        'type' => 'password'
    ])}

    {$this->Form->submit('Login', [
        'class' => 'btn btn-primary btn-lg'
    ])}
{$this->Form->end()}
</div>