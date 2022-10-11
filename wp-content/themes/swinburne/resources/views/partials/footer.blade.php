<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="single-item-ft wow bounceInDown" data-wow-duration="1s">
					<h2>
						{!! pll_current_language('slug')==='vi' ? 'Swinburne Việt Nam' : 'Swinburne Vietnam'!!}
					</h2>
					 @if (has_nav_menu('footer_col1'))
                     {!! wp_nav_menu(['theme_location' => 'footer_col1', 'menu_class' => 'footer_col1']) !!}
            		@endif
				</div>
			</div>
			<div class="col-md-3">
				<div class="single-item-ft wow bounceInDown" data-wow-duration="1.5s">
					<h2> {!! pll_current_language('slug')==='vi' ? 'Tuyển sinh' : 'Admission'!!}</h2>
					 @if (has_nav_menu('footer_col2'))
                     {!! wp_nav_menu(['theme_location' => 'footer_col2', 'menu_class' => 'footer_col2']) !!}
            		@endif
				</div>
			</div>
			<div class="col-md-3">
				<div class="single-item-ft wow bounceInDown" data-wow-duration="2">
					<h2> {!! pll_current_language('slug')==='vi' ? 'Nghiên cứu' : 'Research'!!}</h2>
					 @if (has_nav_menu('footer_col3'))
                     {!! wp_nav_menu(['theme_location' => 'footer_col3', 'menu_class' => 'footer_col3']) !!}
            		@endif
				</div>
			</div>
			<div class="col-md-3">
				<div class="single-item-ft wow bounceInDown" data-wow-duration="2.5s">
					<h2> {!! pll_current_language('slug')==='vi' ? 'Sinh viên Swinburne' : 'Current Student'!!}</h2>
					 @if (has_nav_menu('footer_col4'))
                     {!! wp_nav_menu(['theme_location' => 'footer_col4', 'menu_class' => 'footer_col4']) !!}
            		@endif
				</div>
			</div>
		</div>
	</div>	
	
	<div class="footer-address" >
		<div class="container">
			<div class="footer-intro">
				<div class="intro-content">
					<?php is_active_sidebar('footer-intro-sidebar') ? dynamic_sidebar('footer-intro-sidebar')  : '' ?>
				</div>
			</div>
			<div class="footer-address-wrap">
				<div class="footer-padding row">
					@if(!empty(get_option('name_address1_en')) || !empty(get_option('name_address1')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_address')}}" aria-hidden="true"></i>
							<span class="text-footer">
								{!! pll_current_language("slug")==='vi' ? get_option('name_address1_en') : get_option('name_address1')!!}
							</span>
						</div>
					@endif
					@if(!empty(get_option('phone_number1')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_phone')}}" aria-hidden="true"></i>
							<span class="text-footer">{{get_option('phone_number1')}}</span>
						</div>
					@endif
					@if(!empty(get_option('email_footer1')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_email')}}" aria-hidden="true"></i>
							<span class="text-footer">{{get_option('email_footer1')}}</span>
						</div>
					@endif
					@if(!empty(get_option('name_facebook1')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_facebook')}}" aria-hidden="true"></i>
							<span class="text-footer">
								<a href="{{get_option('link_facebook1')}}" style="text-decoration: none !important">
									{{get_option('name_facebook1')}}
								</a>
							</span>
						</div>
					@endif
				</div>
			
				<div class="footer-padding row">
					@if(!empty(get_option('name_address2_en')) || !empty(get_option('name_address2')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_address')}}" aria-hidden="true"></i>
							<span class="text-footer">
								{!! pll_current_language("slug")==='vi' ? get_option('name_address2_en') : get_option('name_address2')!!}
							</span>
						</div>
					@endif
					@if(!empty(get_option('phone_number2')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_phone')}}" aria-hidden="true"></i>
							<span class="text-footer">{{get_option('phone_number2')}}</span>
						</div>
					@endif
					@if(!empty(get_option('email_footer2')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_email')}}" aria-hidden="true"></i>
							<span class="text-footer">{{get_option('email_footer2')}}</span>
						</div>
					@endif
					@if(!empty(get_option('name_facebook2')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_facebook')}}" aria-hidden="true"></i>
							<span class="text-footer">
								<a href="{{get_option('link_facebook2')}}" style="text-decoration: none !important">
									{{get_option('name_facebook2')}}
								</a>
							</span>
						</div>
					@endif
				</div>
				<div class="footer-padding row">
					@if(!empty(get_option('name_address3_en')) || !empty(get_option('name_address3')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_address')}}" aria-hidden="true"></i>
							<span class="text-footer">
								{!! pll_current_language("slug")==='vi' ? get_option('name_address3_en') : get_option('name_address3')!!}
							</span>
						</div>
					@endif
					@if(!empty(get_option('phone_number3')))
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 footer-colum">
							<i class="fa {{get_option('icons_phone')}}" aria-hidden="true"></i>
							<span class="text-footer">{{get_option('phone_number3')}}</span>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>

</footer>