<header class="d-lg-block d-none">
    <div class="top_nav shadow py-2 bg-white">
        <nav
            class="container navbar navbar-expand-lg navbar-light navbar_padding rounded d-flex justify-content-between">
            <div class="set_logo d-none d-lg-block d-md-block">
                <a href="{{ route('home') }}"><img class="img-fluid"
                        src="{{ asset('frontend/images/logo_desktop.png') }}" alt="logo"></a>
            </div>
            <div class="col-md-4 my-2 my-md-0 ">
                <form method="get" action="{{route('searchindex')}}" class="d-flex text-right margin_search" id="search">
                    <div class="input-icon">
                    <input type="text" class="form-control search_radius"   value="{{ isset(request()->q) ? request()->q : '' }}" name="q" placeholder="Search..."
                            id="kt_datatable_search_query" />
                        <span>
                            <i class="flaticon2-search-1 text-muted"></i>
                        </span>
                    </div>
                    <div>
                       <button type="submit" class="btn si_btn_btn"><i class="fa fa-search"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
            <div class="container d-block d-lg-none d-md-none d-sm-block">
                <div class="si_logo d-flex justify-content-between">
                    <div class="set_logo">
                        <a href="{{ route('home') }}"><img class="img-fluid"
                                src="{{ asset('frontend/images/logo_desktop.png') }}" alt="logo"></a>
                    </div>
                    <div class="su_search_width">
                        <form class="d-flex text-right pl-3 si_position">
                            <input class="form-control su_search_focus me-2" type="search" aria-label="Search">
                            <button class="btn su_nav_search" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- <div id="main_navbar" class="bg_blue shadow main_navbar">
        <nav class="container navbar navbar-expand-custom navbar_padding1">
            <button class="navbar-toggler su_padding_icon" type="button" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="navbar-collapse su_postion si_overflow_style" style="justify-content: left; display: none;"
                id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item su_nav_change @if (Route::is('home')=='home' ) active @endif">
                        <a class="nav-link su_navitem_clr" href="{{ route('home') }}"> Home</a>
                    </li>
                    <?php $drop_act = []; ?>
                    @if (count(get_all_category()))
                        @foreach (get_all_category() as $key => $val)
                            @if ($key < 4)
                                <li
                                    class="nav-item @if((isset(request()->category1) && request()->category1 == $val->slug)) active @endif">
                                    <a class="nav-link su_navitem_clr"
                                        href="{{ next_url($val) }}">{{ ucfirst($val->name) }}</a>
                                </li>
                                <?php $drop_act[] = $val->slug; ?>
                            @endif
                        @endforeach
                    @endif

                    @if (count(get_all_category()) > 4)
                        <div class="dropdown su_postion su_more_nav">
                            <a class="dropdown-toggle su_navitem_clr2" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false"> More
                            </a>
                            <ul class="dropdown-menu su_drop_width2" aria-labelledby="dropdownMenuLink">
                                @foreach (get_all_category() as $key => $val)
                                    @if ($key > 4)
                                        <li><a id="nav_cat{{ isset(request()->category1) ? request()->category1 : '' }}"
                                                class="dropdown-item su_more" @if (isset(request()->category1) && !in_array(request()->category1, $drop_act)) data-id="1" @else data-id="0" @endif
                                                href="{{ next_url($val) }}">{{ ucfirst($val->name) }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <li class="nav-item su_nav_change">
                        <a class="nav-link su_navitem_clr" href="{{ route('home.typing_test') }}"> Typing Test</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div> -->
    <div id="main_navbar" class="bg_blue shadow main_navbar">
        <nav class="container navbar navbar-expand-custom navbar_padding1">
            <button class="navbar-toggler su_padding_icon" type="button" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="navbar-collapse su_postion si_overflow_style" style="justify-content: left; display: none;"
                id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item su_nav_change @if (Route::is('home')=='home' ) active @endif">
                        <a class="nav-link su_navitem_clr" href="{{ route('home') }}"> Home</a>
                    </li>
                                <li
                                    class="nav-item @if((isset(request()->category1) && request()->category1 == $val->slug)) active @endif">
                                    <a class="nav-link su_navitem_clr"
                                        href="{{route('online_quiz')}}">Online Quiz</a>
                                </li>
                   
                    <li class="nav-item su_nav_change">
                        <a class="nav-link su_navitem_clr" href="{{ route('home.typing_test') }}"> Typing Test</a>
                    </li>
                    <li class="nav-item su_nav_change">
                        <a class="nav-link su_navitem_clr" href="{{ route('government_jobs') }}">Government jobs</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<header class="d-lg-none d-block">
    <div class="top_nav shadow py-2 bg-white">
        <nav
            class="container navbar navbar-expand-lg navbar-light navbar_padding rounded d-flex justify-content-between">
            <div class="set_logo d-none d-lg-block d-md-block">
                <a href="{{ route('home') }}"><img class="img-fluid"
                        src="{{ asset('frontend/images/logophotoshop.jpg') }}" alt="logo"></a>
            </div>
            <div class="d-none d-lg-block d-md-block">
                <form method="get" action="{{ route('search') }}" class="d-flex text-right" id="search">
                    <input class="form-control su_search_focus d-none d-lg-block d-md-block me-2" type="search"
                        value="" name="q"
                        aria-label="Search">
                    <button class="btn su_nav_search" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="container d-block d-lg-none d-md-none d-sm-block">
                <div class="si_logo d-flex justify-content-between">
                    <div class="set_logo">
                        <a href="{{ route('home') }}"><img class="img-fluid"
                                src="{{ asset('frontend/images/logo_desktop.png') }}" alt="logo"></a>
                    </div>
                    <div class="su_search_width">
                        <form class="d-flex text-right pl-3 si_position">
                            <input class="form-control su_search_focus me-2" type="search" aria-label="Search" value="{{ isset(request()->q) ? request()->q : '' }}" name="q">
                            <button class="btn su_nav_search" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div id="main_navbar" class="bg_blue shadow main_navbar">
        <nav class="container navbar navbar-expand-custom navbar_padding1">
            <button class="navbar-toggler su_padding_icon" type="button" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="navbar-collapse su_postion si_overflow_style" style="justify-content: left; display: none;"
                id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item su_nav_change @if (Route::is('home')=='home' ) active @endif">
                        <a class="nav-link su_navitem_clr" href="{{ route('home') }}"> Home</a>
                    </li>
                    <?php $drop_act = []; ?>
                    @if (count(get_all_category()))
                        @foreach (get_all_category() as $key => $val)
                            <li
                                class="nav-item @if((isset(request()->category1) && request()->category1 == $val->slug)) active @endif">
                                <a class="nav-link su_navitem_clr"
                                    href="{{ next_url($val) }}">{{ ucfirst($val->name) }}</a>
                            </li>
                            <?php $drop_act[] = $val->id; ?>

                        @endforeach
                    @endif


                    <div class="fixed_search">
                        <form method="get" action="{{ route('search') }}" class="d-flex text-right" id="search">
                            <input class="form-control su_search_focus me-2" type="search"
                                value="{{ isset(request()->search) ? request()->search : '' }}" name="search"
                                aria-label="Search">
                            <button class="btn su_nav_search" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
            </div>
        </nav>
    </div>
</header>
