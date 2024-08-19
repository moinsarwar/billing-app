<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed">
    <a href="/" class="brand-link">

        <span class="brand-text font-weight-light"><b>Solution for Billing</b></span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image" style="">

            </div>
            <div class="info">
{{--                <a href="#" class="d-block">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</a>--}}
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar active">

                        <li class="nav-item">
                            <a href="{{route('productCategory')}}" class="nav-link @if(request()->routeIs('productCategory') || request()->routeIs('createProductCategory') || request()->routeIs('editProductCategory'))) active @endif">
                                <i class="fa-sharp fa-solid fa-layer-group"></i> &nbsp
                                <p><b>Product Category</b></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('product')}}"
                               class="nav-link @if(request()->routeIs('product') || request()->routeIs('createProduct') || request()->routeIs('editProduct'))) active @endif">
                                <i class="fa-brands fa-product-hunt"></i>  &nbsp
                                <p><b>Product</b></p>
                            </a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('createPost')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('createPost')) active @endif">--}}
{{--                                <i class="fas fa-pen-to-square nav-icon"></i>--}}
{{--                                <p>CREATE POST</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('uploadPostFeed')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('uploadPostFeed')) active @endif">--}}
{{--                                <i class="fas fa-plus nav-icon"></i>--}}
{{--                                <p>ADD POST FEED</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <hr>--}}
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('event')}}" class="nav-link">--}}
{{--                        <i class="fas fa-calendar-week nav-icon"></i>--}}
{{--                        <p>PLANNER EVENTS</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('poll')}}" class="nav-link">--}}
                {{--                        <i class="fas fa-poll nav-icon"></i>--}}
                {{--                        <p>POLLS</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <div class="nav-item">

{{--                    <ul class="administrationSubMenu">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('region')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('region')) active @endif">--}}
{{--                                <i class="fas fa-map-location nav-icon"></i>--}}
{{--                                <p>REGIONS</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('country') }}"--}}
{{--                               class="nav-link @if(request()->routeIs('country')) active @endif">--}}
{{--                                <i class="fas fa-earth nav-icon"></i>--}}
{{--                                <p>COUNTRIES</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}


{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('city')}}" class="nav-link @if(request()->routeIs('city')) active @endif">--}}
{{--                                <i class="fas fa-city   nav-icon"></i>--}}
{{--                                <p>CITIES</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('mosque')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('mosque')) active @endif">--}}
{{--                                <i class="fas fa-mosque   nav-icon"></i>--}}
{{--                                <p>MOSQUES</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('prayer_times')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('prayer_times')) active @endif">--}}
{{--                                <i class="fas fa-clock nav-icon"></i>--}}
{{--                                <p>PRAYERS TIMES</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('monthAdjustment')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('monthAdjustment')) active @endif">--}}
{{--                                <i class="fas fa-calendar-alt nav-icon"></i>--}}
{{--                                <p>MONTH ADJUSTMENT</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}

{{--                            <a href="{{route('prayerAdhan')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('prayerAdhan')) active @endif">--}}
{{--                                <i class="fas fa-music nav-icon"></i>--}}
{{--                                <p>ADHAAN</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('appIcon') }}"--}}
{{--                               class="nav-link @if(request()->routeIs('appIcon')) active @endif">--}}
{{--                                <i class="fa-solid fa-icons nav-icon"></i>--}}
{{--                                <p>App Icons</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <hr>--}}

{{--                    </ul>--}}
                </div>
                <div class="nav-item">

{{--                    <ul class="playlistSubmenu">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('videoAuthor')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('videoAuthor')) active @endif">--}}
{{--                                <i class="fas fa-user nav-icon"></i>--}}
{{--                                <p>SPEAKER</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('videos')}}"--}}
{{--                               class="nav-link @if(request()->routeIs('videos')) active @endif">--}}
{{--                                <i class="fas fa-play nav-icon"></i>--}}
{{--                                <p>LECTURES</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <hr>--}}

{{--                    </ul>--}}
                </div>
{{--                <li class="nav-item">--}}
{{--                    <a href="{{route('profileSetting')}}" class="nav-link">--}}
{{--                        <i class="fas fa-user nav-icon"></i>--}}
{{--                        <p>PROFILE SETTING</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            </ul>
        </nav>
    </div>
</aside>


