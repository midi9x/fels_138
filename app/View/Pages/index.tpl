<div class="col-md-3 left-side-bar text-center">
    <div class="row row-item">
        <div class="avatar-img col-md-12">
            {$this->Html->image("uploads/{$user['avatar']}", [
                'class' => 'img-responsive'
            ])}
        </div>
    </div>
    <div class="row row-item">
        <div class="col-md-12">{$user['username']}</div>
    </div>
    <div class="row row-item">
        <div class="col-md-12">{__('Learned %d words', $totalWordLearned)}</div>
    </div>
</div>
<div class="main-content col-md-9">
    <div class="row link-group">
        <div class="col-md-6"><a class="btn btn-lg btn-primary float-right" href="/words">{__('Word')}</a></div>
        <div class="col-md-6"><a class="btn btn-lg btn-primary" href="/Categories">{__('Lesson')}</a></div>
    </div>
    <div class="row content-title title border-bottom">
        <div class="col-md-12">
            {__('Activities')}
        </div>
    </div>
    <div class="row row-content-data">
        <ul class="list-group">
            {foreach $activities as $activity}
                <li class="row-item list-group-item">
                    {$activity}
                </li>
            {/foreach}
        </ul>
    </div>
</div>
