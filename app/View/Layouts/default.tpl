<!DOCTYPE html>
<html lang="en">
<head>
    {$this->Html->charset()}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$this->fetch('title', _('Framgia E-Learning System'))}</title>
    {$this->Html->meta('icon')}
    {$this->Html->css('landing-page')}
    {$this->Html->css('/bower_components/bootstrap/dist/css/bootstrap')}
    {$this->Html->css('/bower_components/font-awesome/css/font-awesome')}
    {$this->fetch('css')}
</head>
<body>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"  href="{$this->webroot}"> Fels 138</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{$this->webroot}">{_('Home')}</a>
                        </li>
                        <li>
                            <a href="/categories">{__('Category')}</a>
                        </li>
                        <li>
                            <a href="/words">{__('Words')}</a>
                        </li>
                    </ul>
                <ul class="nav navbar-nav navbar-right">
                    {if $this->Session->read('Auth.User')}
                         <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <img alt="" src="{$this->Session->read('Auth.User.avatar')}" width="20" class="avatar" height="20"> <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a>{_('Hello')}, {$this->Session->read('Auth.User.username')}<span class="bold"> </span>
                                </a> 
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/users/{$this->Session->read('Auth.User.id')}"><i class="fa fa-user fa-fw"></i> {_('Profile')} </a>
                            </li>
                            <li>
                                <a href="/users/logout"><i class="fa fa-sign-out fa-fw"></i> {_('Logout')} </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    {else}
                        <li>
                            {$this->Html->link(_('Register'), [
                                'controller' => 'users',
                                'action' => 'register'
                            ])}
                        </li>
                        <li>
                            {$this->Html->link(_('Login'), [
                                'controller' => 'users',
                                'action' => 'login'
                            ])}
                        </li>
                    {/if}
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="top-gap"></div>
        <div class="container fluid">
            {$this->Session->flash()}
            {$this->fetch('content')}
        </div>
    <!-- Footer -->
    <footer>
        <div class="container center">
            <div class="row ">
                <div class="col-lg-12">
                    <ul class="list-inline center">
                        <li>
                            {_('Language')}
                        </li>
                        <li>
                            <a href="">{_('English')}</a>
                        </li>

                        <li class="footer-menu-divider">&sdot;</li>

                        <li>
                            <a href="">{_('Vietnamese')}</a>
                        </li>                        

                    </ul>
                </div>
            </div>
        </div>
    </footer>
    {$this->Html->script('/bower_components/jquery/dist/jquery')}
    {$this->Html->script('/bower_components/bootstrap/dist/js/bootstrap')}
    <!-- Custom JavaScript -->
    {$this->fetch('script')}
    {$this->element('sql_dump')}
    <script>
        // add class for sql_dump :)) 
        $('.cake-sql-log').addClass('table table-hover table-bordered');
        $('caption').remove();
    </script>
</body>
</html>
