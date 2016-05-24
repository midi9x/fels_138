<div class="col-md-12">
    <div class="col-md-4">
        <h2>{_('All user')}</h2>
    </div>
</div>

<div class="col-md-12">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th class="small-with">﻿#</th>
                <th class="large-with">{_('User Name')}</th>
                <th class="large-with">{_('Email')}</th>
                <th class="medium-with">{_('Avatar')}</th>
                <th class="medium-with">{_('Action')}</th>
            </tr>
        </thead>
        <tbody>
            {foreach $users as $user}
                <tr>
                    <td>﻿{$user['User']['id']}</td>
                    <td>﻿
                        {$this->Html->link($user['User']['username'], ['action' => 'view', $user['User']['id']])}
                    </td>
                    <td>﻿{$user['User']['email']}</td>
                    <td>﻿
                        {$this->Html->image($user['User']['avatar'], [
                            'class' => 'img-user'
                        ])}
                    <td>﻿
                        {$this->Html->link('<i class="fa fa-pencil"></i>', ['action' => 'update', $user['User']['id']], [
                            'class' => 'btn btn-warning',
                            'escape' => false
                        ])}

                        {$this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $user['User']['id']], [
                            'confirm' => __('Are you sure to delete?'),
                            'class' => 'btn btn-danger',
                            'escape' => false
                        ])}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <div class="text-center ">
        <ul>
            {$this->Paginator->prev(__('Previous'), ['class' => 'btn btn-default prev'], null, [
                'class' => 'btn btn-default prev disabled'
            ])}

            {$this->Paginator->numbers([
                'separator' => '',
                'class' => 'btn btn-default', 
                'currentClass' => 'disabled'
            ])}

            {$this->Paginator->next(__('Next'), ['class' => 'btn btn-default next'], null, [
                'class' => 'btn btn-default next disabled'
            ])}
            </ul>
    </div>
</div>
