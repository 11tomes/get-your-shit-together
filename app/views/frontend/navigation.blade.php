<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-eye-open"></i> View Todos <b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li><a href="{{ route('todos.index') }}">As List</a></li>
			<li><a href="{{ route('todos.agenda') }}">Agenda</a></li>
			<li><a href="{{ route('todos.priorities') }}">By Priorities</a></li>
			<li><a href="{{ route('todos.labels') }}">By Labels</a></li>
		</ul>
	</li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-cog"></i> Settings <b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li><a href="{{ route('settings.labels.index') }}">Labels</a></li>
			<li><a href="{{ route('settings.priorities.index') }}">Priorities</a></li>
		</ul>
	</li>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-user"></i> Account <b class="caret"></b>
		</a>
		<ul class="dropdown-menu">
			<li><a href="{{ URL::route('profile') }}">Profile</a></li>
			<li><a href="{{ URL::route('change-password') }}">Change Password</a></li>
			<li><a href="{{ URL::route('change-email') }}">Change Email</a></li>
			<li><a href="{{ URL::route('logout') }}">Logout</a></li>
		</ul>
	</li>
</ul>
