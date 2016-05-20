<div class="main-content col-md-12">
    <div class="row title content-title">
        <div class="col-md-12">
            {__('Category Detail')}
        </div>
    </div>
    <div class="row row-content">
        <div class="col-md-12 title row-content-title">
            <div>
                {__('Category Name')}
            </div>
        </div>
        <div class="col-md-12 row-content">
            {$category['name']}
        </div>
    </div>
    <div class="row row-content">
        <div class="col-md-12 title row-content-title">
            {__('Word List')}
        </div>
        <div class="col-md-12 row-content">
            {foreach $words as $key => $word}
                <li><a href="#">{$word}</a></li>
            {/foreach}
        </div>
    </div>
</div>