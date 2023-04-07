<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="{{ route('admin.dashboard.index') }}" class="nav-link">Home</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown user-menu">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if(auth()->guard('admin')->user()->profile_image)
                    @php $imagePath = 'uploads/admin/'.auth()->guard('admin')->user()->id.'/thumbnail/'.auth()->guard('admin')->user()->profile_image; @endphp

                @else
                    <!-- <img width="30" src="{{ asset('images/logo.svg') }}"alt="User Image"> -->
                @endif
				<span class="d-none d-md-inline">{{ auth()->guard('admin')->user()->name }}</span>
			</a>
			<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<!-- User image -->
				<li class="user-header bg-default">
					@if(auth()->guard('admin')->user()->profile_image)
                        @php $imagePath = 'uploads/admin/'.auth()->guard('admin')->user()->id.'/thumbnail/'.auth()->guard('admin')->user()->profile_image; @endphp
                       <!--  <img width="30" src="{{ asset($imagePath) }}"alt="User Image" onerror="this.onerror=null;this.src='{{ asset('logo/logo192x192.png') }}'"> -->
                    @else
                        <!-- <img width="30" src="{{ asset('logo/logo192x192.png') }}"alt="User Image"> -->
                    @endif
					<p>
						{{ auth()->guard('admin')->user()->name }} ( @if (auth()->guard('admin')->user()->is_super) System @endif Admin )
					</p>
					<p>{{ auth()->guard('admin')->user()->email }}</p>
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<a href="{{ route('admin.change.password') }}" class="btn btn-default">Profile</a>
					<a href="{{ route('admin.logout') }}" class="btn btn-default float-right">
						Sign out
					</a>
				</li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.logout') }}" title="Sign out">
				<i class="fas fa-sign-out-alt"></i>
			</a>
		</li>
	</ul>
</nav>
