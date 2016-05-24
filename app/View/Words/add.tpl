<div class="col-md-4">
    <h2>{_('Add Word')}</h2>
</div>

{$this->Form->create('Word')}
    <div class="col-sm-12">
        {$this->Form->input('category_id', [
            'options' => $categories,
            'empty' => _('Select category'),
            'before' => '<div class="form-group">',
            'after' => '</div>',
            'class' => 'form-control'
        ])}
    </div>

    <div class="col-sm-12">
        {$this->Form->input('content', [
            'before' => '<div class="form-group">',
            'after' => '</div>',
            'class' => 'form-control',
            'rows' => 3,
            'label' => _('Word name')
        ])}
    </div>

    <div>
        <div class="col-sm-9">
            {$this->Form->input('WordAnswer.0.content', [
                'before' => '<div class="form-group">',
                'after' => '</div>',
                'class' => 'form-control',
                'label' => _('Answer 1'),
                'type' => 'text'
            ])}  
        </div>
        <div class="col-sm-3">
            {$this->Form->input('WordAnswer.0.correct', [
                'options' => [1 => 'Correct'], 
                'checked' => true,
                'type' => 'checkbox', 
                'before' => '<div class="checkbox correct">',
                'after' => '</div>',
                'id' => 'correct',
                'div' => false
            ])}
        </div>
    </div>

    <div>
        <div class="col-sm-9">
            {$this->Form->input('WordAnswer.1.content', [
                'before' => '<div class="form-group">',
                'after' => '</div>',
                'class' => 'form-control',
                'label' => _('Answer 2'),
                'type' => 'text'
            ])}  
        </div>
        <div class="col-sm-3">
            {$this->Form->input('WordAnswer.1.correct', [
                'options' => [1 => 'Correct'], 
                'type' => 'checkbox', 
                'before' => '<div class="checkbox correct">',
                'after' => '</div>',
                'id' => 'correct',
                'div' => false
            ])}
        </div>
    </div>

    <div>
        <div class="col-sm-9">
            {$this->Form->input('WordAnswer.2.content', [
                'before' => '<div class="form-group">',
                'after' => '</div>',
                'class' => 'form-control',
                'label' => _('Answer 3'),
                'type' => 'text'
            ])}  
        </div>
        <div class="col-sm-3">
            {$this->Form->input('WordAnswer.2.correct', [
                'options' => [1 => 'Correct'], 
                'type' => 'checkbox', 
                'before' => '<div class="checkbox correct">',
                'after' => '</div>',
                'id' => 'correct',
                'div' => false
            ])}
        </div>
    </div>

    <div>
        <div class="col-sm-9">
            {$this->Form->input('WordAnswer.3.content', [
                'before' => '<div class="form-group">',
                'after' => '</div>',
                'class' => 'form-control',
                'label' => _('Answer 4'),
                'type' => 'text'
            ])}  
        </div>
        <div class="col-sm-3">
            {$this->Form->input('WordAnswer.3.correct', [
                'options' => [1 => 'Correct'], 
                'type' => 'checkbox', 
                'before' => '<div class="checkbox correct">',
                'after' => '</div>',
                'id' => 'correct',
                'div' => false
            ])}
        </div>
    </div>

    <div class="col-sm-12">
        {$this->Form->submit(_('Create'), [
            'class' => 'btn btn-primary btn-lg'
        ])}
    </div>

{$this->Form->end()}

{$this->start('script')}
    <script>
        //single choice checkbox
        $('input:checkbox').on('click', function() {
            $box = $(this);
            $group = $("input:checkbox[id = 'correct']");
            if ($box.is(':checked')) {
                $group.prop('checked', false);
                $box.prop('checked', true);
            } else {
                $box.prop('checked', false);
            }
        });
    </script>
{$this->end()}


