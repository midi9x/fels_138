<div class="main-content col-md-12">
    <div class="row content-title">
        <div class="col-md-12">
            {__('Update profile')}
        </div>
    </div>
    <div class="row form-content">
        {$this->Form->create('User', ['type' => 'file'])}
        <div class="form-group">
            {$this->Form->input('username', ['label' => __('User name'), 'class' => 'form-control', 'value' => $user['username']])}
        </div>
        <div class="form-group">
            {$this->Form->input('email', ['label' => 'Email', 'class' => 'form-control', 'value' => $user['email']])}
        </div>
        <div class="form-group">
            {$this->Form->input('avatar_image', ['label' => __('Avatar Image'), 'type' => 'file', 'class' => 'form-control'])}
        </div>
        {$roleOptions = ['admin' => 'Admin', 'author' => 'Author']}
        <div class="form-group">
            <label>Role</label>
            <select name="data[User][role]" class="form-control">
                {foreach $roleOptions as $k => $option}
                    <option value="{$k}" {($k == $user['role']) ? 'selected' : ''}>{$option}</option>
                {/foreach}
            </select>
        </div>
    </div>
    {$this->Form->end(['label' => __('Save'), 'class' => ['class' => 'btn btn-primary']])}
</div>
</div>

