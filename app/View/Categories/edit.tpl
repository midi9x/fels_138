<div class="main-content col-md-12">
    <div class="row content-title title">
        <div class="col-md-12">
            {__('Edit Category')}
        </div>
    </div>
    <div class="row form-content">
        <div class="col-md-12">
            {$this->Form->create('Category')}
            <div class="form-group">
                {$this->Form->input('name', ['label' => 'Category name', 'class' => 'form-control', 'value' => $category['name']])}
            </div>
            {$this->Form->end(['label' => __('Save'), 'class' => ['class' => 'btn btn-primary']])}
        </div>
    </div>
</div>