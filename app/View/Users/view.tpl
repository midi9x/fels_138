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
    <div class="row row-item">
        <div class="col-md-12">{$this->ShowContent->showFollowButton($followType, ['followClass' => 'btn btn-primary', 'unfollowClass' => 'btn btn-default'])}</div>
    </div>
</div>
<div class="main-content col-md-9">
    <div class="row content-title title border-bottom follow-title">
        <div class="col-md-12">
            {__('Follow')}
        </div>
    </div>
    <div class="row row-content-data follow-content">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#follower">{__('Follower')}</a></li>
            <li><a data-toggle="tab" href="#following">{__('Following')}</a></li>
        </ul>

        <div class="tab-content">
            <div id="follower" class="tab-pane fade in active">
                {$this->ShowContent->showFollow($follower)}
            </div>
            <div id="following" class="tab-pane fade">
                {$this->ShowContent->showFollow($following)}
            </div>
        </div>
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
</div>

