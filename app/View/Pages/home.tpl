<div class="text-center jumbotron">
    <h1>Framgia E-learning System</h1><br/>
    {if !$this->Session->read('Auth.User')}
    	<a class="btn btn-lg btn-primary" href="/users/register">Sign up</a>
	{/if}
</div>