<header id="header" >
				<div  class="{{ Request::is('/') ? 'container-home' : 'container' }}">
					<div class="menu">
						<div class="topmenu" onclick="changeMenu(this)">
							<div class="bar1"></div>
							<div class="bar2"></div>
							<div class="bar3"></div>
						</div>
						<div id="mySidenav" class="sidenav">
							<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
							<a class="gold-sidenav"style = "margin-top:40%;" href="/">Acasa</a>
							<a class="gold-sidenav" href="/portofoliu">Portofoliu</a>
							<a class="gold-sidenav" href="/servicii">Servicii</a>
							<a class="gold-sidenav" href="/clienti">clienti</a>
							<a class="gold-sidenav" href="/contact">contact</a>
						</div>
						<div class="logo">
							<a href="/"><img src="{{ Voyager::image(setting('site.logo')) }}"></a>
						</div>
						<div class="header-right">
							<div class="facebook-header">
								<a href="{{setting('site.facebook')}}"><i class="fa fa-facebook"></i></a>
							</div>
						</div>
					</div>
				</div>
			</header>