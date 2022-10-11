<div class="destop-header">
    <div class="container">
        <div class="all-item-destop">
            <div class="logo-destop">
                <a href="{!! pll_current_language('slug')==='vi' ? site_url() : site_url('en') !!} "> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/header/Logo_SUT.jpg" alt="hr"></a>
            </div>
            <div class="navbar-right">
                <div class="first-group">
                    @if (has_nav_menu('first-menu'))
                    {!! wp_nav_menu(['theme_location' => 'first-menu', 'menu_class' => 'menu-primary']) !!}
                    {!! do_action('sut_language_switcher') !!}
                    @endif
                </div>
                <div class="second-grounp">
                    @if (has_nav_menu('second-menu'))
                    {!! wp_nav_menu(['theme_location' => 'second-menu', 'menu_class' => 'menu-second']) !!}
                    @endif
                    <div class="nav-search">
                        {{ get_search_form() }}
                    </div>
                </div>
                <div class="all-content-out">
                    <div class="double-button">
                        <a class="enqui" href="{!! pll_current_language('slug')==='vi' ? get_field('enquiry_link_to_home', $object_current->ID) : get_field('enquiry_link_to_home', $object_current->ID)!!}"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> {!! pll_current_language('slug')==='vi' ? 'Tìm hiểu thông tin' : 'enquiry'!!} </a>
                        <a class="applica" href="{!! pll_current_language('slug')==='vi' ? get_field('application_link_to_home', $object_current->ID) : get_field('application_link_to_home', $object_current->ID)!!}"><i class="fa fa-pencil" aria-hidden="true"></i> {!! pll_current_language('slug')==='vi' ? 'Đăng ký nhập học Online' : 'Online application'!!} </a>
                    </div>
               </div>
            </div>
        </div>
    </div>
</div>
<!-- Phần menu mobile -->
<header class="main-header">
    <nav id='cssmenu'>
        <div class="logo">
            <div class="logo-img">
                <a href="{{ site_url() }}"> <img src="{{ get_stylesheet_directory_uri() }}/resources/assets/images/header/Logo_SUT.jpg" alt="hr"></a>
            </div>
            <div class="search-mobile">
                {{ get_search_form() }}
            </div>
            <div class="lang-mobile">
                {!! do_action('sut_language_switcher') !!}
            </div>

        </div>
<div class="all-content-out">
        <div class="double-button">
            <a class="enqui" href="{!! pll_current_language('slug')==='vi' ? get_field('enquiry_link_to_home', $object_current->ID) : get_field('enquiry_link_to_home', $object_current->ID)!!}"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> {!! pll_current_language('slug')==='vi' ? 'Tìm hiểu thông tin' : 'enquiry'!!} </a>
            <a class="applica" href="{!! pll_current_language('slug')==='vi' ? get_field('application_link_to_home', $object_current->ID) : get_field('application_link_to_home', $object_current->ID)!!}"><i class="fa fa-pencil" aria-hidden="true"></i> {!! pll_current_language('slug')==='vi' ? 'Đăng ký nhập học Online' : 'Online application'!!} </a>
        </div>
    </div>
        {{-- <div id="head-mobile"></div> --}}
        <div class="button"></div>
        <ul class="nav-updown">
            <li>
                @if (has_nav_menu('first-menu'))
                {!! wp_nav_menu(['theme_location' => 'first-menu', 'menu_class' => 'menu-primary']) !!}
                @endif
                @if (has_nav_menu('second-menu'))
                {!! wp_nav_menu(['theme_location' => 'second-menu', 'menu_class' => 'menu-second']) !!}
                @endif
            </li>
        </ul>
    </nav>
</header>