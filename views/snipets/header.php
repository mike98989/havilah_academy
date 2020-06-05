

<div class="super_container">

	<!-- Header -->

	<header class="header">
			
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="top_bar_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
								<div class="top_bar_phone"><span class="top_bar_title">phone:</span>+234 803 604 1653</div>
								<div class="top_bar_right ml-auto">

									<!-- Social -->
									<div class="top_bar_social">
										<span class="top_bar_title social_title">follow us</span>
										<ul>
											<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>

		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container mr-auto" style="width: auto">
								<a href="#">
								<div class="logo_text" style="float:left"><img src="<?php echo URL;?>public/images/sabi_s_only_logo.png" style="margin-top:-10px;width:40px;float:left"> Sabi.<span style="color:#000">XYZ</span></div>
								</a>
							</div>
							<nav class="main_nav_contaner">
								<ul class="main_nav">
									<li class="<?php if($url[1]==''){echo 'active';}?>"><a href="<?php echo URL;?>">Home</a></li>
									<li class="<?php if($url[1]=='books'){echo 'active';}?>"><a href="<?php echo URL;?>books">Books</a></li>
									<li class="<?php if($url[1]=='register'){echo 'active';}?>"><a href="<?php echo URL;?>register">Register</a></li>
									<li class="<?php if($url[1]=='contact'){echo 'active';}?>"><a href="<?php echo URL;?>contact">Contact</a></li>

								</ul>
							</nav>
							<div class="header_content_right ml-auto text-right">

								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</header>




	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="search">
			<form action="#" class="header_search_form menu_mm">
				<input type="search" class="search_input menu_mm" placeholder="Search" required="required">
				<button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
					<i class="fa fa-search menu_mm" aria-hidden="true"></i>
				</button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="<?php echo URL;?>">Home</a></li>
				<li class="menu_mm"><a href="<?php echo URL;?>books">Books</a></li>
				<li class="menu_mm"><a href="<?php echo URL;?>register">Register</a></li>
				<li class="menu_mm"><a href="<?php echo URL;?>contact">Contact</a></li>
			</ul>
		</nav>
		<div class="menu_extra">
			<div class="menu_phone"><span class="menu_title">phone:</span>+234 803 604 1653</div>
			<div class="menu_social">
				<span class="menu_title">follow us</span>
				<ul>
					<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	