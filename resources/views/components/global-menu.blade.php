 <!-- Global Menu -->
 <div id="global_menu_button_container">
    <p class="site_title">Cris Fandino</p>
    <i class="fa fa-bars" id="global_menu_button"></i>
</div>

<ul id="global_menu_items">
    <div>
        <i class="fa fa-close" id="global_menu_close_button"></i>
        <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> About</a></li>
        <li><a href="{{ url('/resume') }}"><i class="fas fa-file-alt"></i> Resume</a></li>
        <li><a href="{{ url('/projects') }}"><i class="fas fa-pen-nib"></i> Projects</a></li>
        <li><a href="{{ url('/services') }}"><i class="fas fa-cog"></i> Services</a></li>
        <li><a href="{{ url('/contact') }}"><i class="fas fa-phone-square"></i> Contact</a></li>
    </div>
</ul>

<!--x Global Menu x-->



<!-- sidebar -->
<div class="sidebar_container">
    <!-- Sidebar Image -->
    <div class="image">
        <img src="img/profile.png" alt="Cris Fandino">
        <div class="right_image_box"></div>
        <div class="left_image_box"></div>
    </div>

    <!-- sidebar Content -->
    <div class="sidebar_content">
        <!-- Long name can be applied so easily -->
        <h1>Cris Fandino</h1>
        <p>Full stack developer</p>
        <!-- Social Medias -->
        <div class="social_media">
            <a href="https://www.facebook.com/crisfandino01"><i class="fab fa-facebook"></i></a>
            <a href="https://github.com/darkcris1"><i class="fab fa-github"></i></a>
            <a href="https://instagram.com/darkcris0301"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <!-- Sidebar Buttom Menu -->
    <div class="sidebar_buttom_menu" id="sidebar_buttom_menu">
        <i class="fa fa-bars" id="sidebar_menu_icon"></i>
    </div>

    <!-- Sidebar Navigation -->
    <ul class="sidebar_navigation" id="sidebar_navigation">
        <li><a href="/" class="active">About</a></li>
        <li><a href="{{ url('/resume') }}">Resume</a></li>
        <li><a href="{{ url('/projects') }}">Projects</a></li>
        <li><a href="{{ url('/services') }}">Services</a></li>
        <li><a href="{{ url('/contact') }}">Contact</a></li>
    </ul>

</div>