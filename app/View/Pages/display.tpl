<style>
    .link-button {
        text-align: center;
    }
    .btn-large{
        padding: 20px 90px;
    }
</style>
<div class="row">
    <div class="col-md-3 left-content">
        <div class="row">
            {*<div class="col-md-12 avatar-img">{$this->session->read('Auth.User.avatar')}</div>*}
            {*<div class="col-md-12 user-name">{$this->session->read('Auth.User.username')}</div>*}
            <div class="col-md-12 user-result">Learned: {$totalWordLearned} words</div>
        </div>
    </div>
    <div class="col-md-9 main-content">
        <div class="row">
            <div class="col-md-6 link-button"><a href="#" class="btn btn-primary btn-large">111</a></div>
            <div class="col-md-6 link-button"><a href="#" class="btn btn-primary btn-large">222</a></div>
        </div>
        <div class="row activity-content">
            <div class="col-md-12 content-title">This is the title</div>
            {foreach $activities as $activity}
                <div class="col-md-12 content-item">
                    {$activity['Activity']['content']}
                </div>
            {/foreach}
        </div>
    </div>
</div>