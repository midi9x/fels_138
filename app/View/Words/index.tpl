<div class="col-md-12">
    <div class="col-md-4">
        <h2>{_('Word List')}</h2>
    </div>
    <div class="col-md-2 col-md-offset-6 text-right">
        <a title="" class="btn btn-primary" href="/words/add">
            <i class="fa fa-plus"></i> Add word
        </a>
    </div>
</div>

<div class="col-md-12">
{$this->Form->create('Word', ['type' => 'get'])}
    <div class="col-md-3">
        {$this->Form->input('category_id', [
            'options' => $categories,
            'empty' => [0 => _('All category')],
            'before' => '<div class="form-group">',
            'after' => '</div>',
            'class' => 'form-control',
            'label' => false,
            'required' => false,
            'selected' => $this->request->query('category_id')
        ])}
    </div>

    <div class="col-md-4">
        {$this->Form->input('filter', [
            'options' => [1 => 'Learned', 2 => 'Not learned', 3 => 'All'], 
            'default' => 3,
            'type' => 'radio', 
            'fieldset' => false,
            'legend' => false,
            'hiddenField' => false,
            'label' => false,
            'class' => false,
            'separator' => '<span class="space"></span>',
            'value' => $this->request->query('filter')
            
        ])}
    </div>

    <div class="col-md-1">
        {$this->Form->submit(_('Filter'), [
            'class' => 'btn btn-primary'
        ])}
    </div>
{$this->Form->end()}
</div>

<div class="col-md-12">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th width="20">﻿#</th>
                <th width="250">﻿Word</th>
                <th width="80">Action</th>
            </tr>
        </thead>
        <tbody>
            {foreach $words as $word}
                <tr>
                    <td>﻿{$word['Word']['id']}</td>
                    <td>﻿{$word['Word']['content']}</td>
                    <td>﻿
                        {$this->Html->link('<i class="fa fa-pencil"></i> Edit', ['action' => 'edit', $word['Word']['id']], [
                            'class' => 'btn btn-warning',
                            'escape' => false
                        ])}

                        {$this->Form->postLink('<i class="fa fa-trash"></i> Delete', ['action' => 'delete', $word['Word']['id']], [
                            'confirm' => 'Are you sure to delete?',
                            'class' => 'btn btn-danger',
                            'escape' => false
                        ])}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <div class="text-center"></div>
</div>
