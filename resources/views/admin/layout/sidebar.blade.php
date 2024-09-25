
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">

        {{-- <div class="form-group">
            <select class="form-control">
            <option> <a href="{{ route('change_direction' , ['lang'=>'en']) }}">English</a></option>
            <option> <a href="{{ route('change_direction' , ['lang'=>'ar']) }}">العربيه</a></option>

            </select>
        </div> --}}

        <div class="input-group-prepend">
            <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="background-color: #17a2b8;color:#FFF">
                {{ ( app()->getLocale() ) == 'en' ? 'English':'العربيه' }}
            </button>
            <ul class="dropdown-menu" style="left:30px !important">

                <li class="dropdown-item" {{ ( app()->getLocale() ) == 'en' ? 'selected':'' }}> <a href="{{ route('change_direction' , ['lang'=>'en']) }}" >English</a></li>
                <li class="dropdown-item" {{ ( app()->getLocale() ) == 'ar' ? 'selected':'' }}><a href="{{ route('change_direction' , ['lang'=>'ar']) }}" >العربيه</a></li>
            </ul>
            </div>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.index')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Cangrow</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset("dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">CanGrow Dashboard</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if($settings->finish )
                    @if($settings->slider)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-image"></i>
                                <p>
                                    @lang('sidebar.sliders')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.sliders.index')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('sidebar.sliders')</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.sliders.add')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('main.add')</p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.sliders.setting')}}" class="nav-link">
                                        <i class="fa fa-cog nav-icon"></i>
                                        <p>@lang('main.setting')</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif


                    @if($settings->messages)

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-comments nav-icon"></i>
                                    <p>
                                        @lang('sidebar.messages')
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{route('admin.messages.index')}}" class="nav-link">
                                            <i class="fa fa-language nav-icon"></i>
                                            <p>  @lang('sidebar.messages') </p>
                                        </a>
                                    </li>


                                </ul>
                            </li>

                        @endif



                        @if($settings->feedback)

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-comments nav-icon"></i>
                                <p>
                                    @lang('sidebar.feedbacks')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.feedback.index')}}" class="nav-link">
                                        <i class="fa fa-language nav-icon"></i>
                                        <p>  @lang('main.all') </p>
                                    </a>
                                </li>


                                
                                <li class="nav-item">
                                    <a href="{{route('admin.feedback.index')}}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>  @lang('main.add') </p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                    @endif






                    @if($settings->about_us)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-address-card nav-icon"></i>
                                <p>
                                    @lang('sidebar.about_us')
                                   <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.about.index')}}" class="nav-link">
                                    <i class="far fa-address-card nav-icon"></i>
                                    <p> @lang('sidebar.about_us') </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if($settings->contact_us)
                       <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-phone-volume"></i>
                            <p>
                                @lang('sidebar.contact_us')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.contact.index')}}" class="nav-link">
                            <i class="far fa-volume-control-phone nav-icon"></i>
                            <p>@lang('sidebar.contact_us')</p>
                        </a>
                    </li>


                </ul>
            </li>
                    @endif

                    @if($settings->social_media )
                        <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="far fa-newspaper nav-icon"></i>
                    <p>
                        @lang('sidebar.social_media')
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.social_media.index')}}" class="nav-link">
                            <i class="far fa-newspaper nav-icon"></i>
                            <p> @lang('sidebar.social_media') </p>
                        </a>
                    </li>


                </ul>
            </li>
                    @endif



                    
                    @if($settings->faq )
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-comments"></i>
                            <p>
                                @lang('sidebar.faq')
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin.main_faq.index')}}" class="nav-link">
                                <i class="fas fa-comments"></i>
                                <p> @lang('sidebar.main_faq') </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('admin.faq.index')}}" class="nav-link">
                                <i class="fas fa-comments"></i>
                                <p> @lang('sidebar.faq') </p>
                            </a>
                        </li>

                    </ul>
                    </li>
                    @endif




                    @if($settings->clients )
                        <li class="nav-item has-treeview">
                                                    <a href="#" class="nav-link">
                                                        <i class="fa fa-users nav-icon"></i>
                                                        <p>
                                                            @lang('sidebar.add_clients')
                                                            <i class="right fas fa-angle-left"></i>
                                                        </p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        <li class="nav-item">
                                                            <a href="{{route('admin.our_clients.index')}}" class="nav-link">
                                                                <i class="fa fa-users nav-icon"></i>
                                                                <p>  @lang('sidebar.add_clients') </p>
                                                            </a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a href="{{route('admin.our_clients.add')}}" class="nav-link">
                                                                <i class="fa fa-plus nav-icon"></i>
                                                                <p> @lang('main.add') </p>
                                                            </a>
                                                        </li>


                                                    </ul>
                                                </li>
                    @endif

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-user-circle nav-icon"></i>
                                <p>
                                    @lang('sidebar.users')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.users.index')}}" class="nav-link">
                                        <i class="fa fa-user nav-icon"></i>
                                        <p>   @lang('sidebar.my_users') </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.delivery.index')}}" class="nav-link">
                                        <i class="fa fa-user nav-icon"></i>
                                        <p>   @lang('sidebar.my_delivery') </p>
                                    </a>
                                </li>




                            </ul>
                        </li>

                    @if($settings->our_works )
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-briefcase nav-icon"></i>
                                    <p>
                                        @lang('sidebar.our_work')
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{route('admin.our_works.index')}}" class="nav-link">
                                            <i class="fa fa-briefcase nav-icon"></i>
                                            <p> @lang('sidebar.our_work') </p>
                                        </a>
                                    </li>



                                </ul>
                            </li>
                    @endif

                        <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-search nav-icon"></i>
                        <p>
                            Website Meta
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin.meta.index')}}" class="nav-link">
                                <i class="fa fa-language nav-icon"></i>
                                <p>  Meta </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('admin.meta.services')}}" class="nav-link">
                                <i class="fa fa-language nav-icon"></i>
                                <p>  Services </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.meta.categories')}}" class="nav-link">
                                <i class="fa fa-language nav-icon"></i>
                                <p>  Categories </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('admin.meta.blogs')}}" class="nav-link">
                                <i class="fa fa-language nav-icon"></i>
                                <p>  Blogs </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('admin.meta.products')}}" class="nav-link">
                                <i class="fa fa-language nav-icon"></i>
                                <p>  products </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('admin.meta.projects')}}" class="nav-link">
                                <i class="fa fa-language nav-icon"></i>
                                <p>  projects </p>
                            </a>
                        </li>




                    </ul>
                </li>

                    @if($settings->categories )
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>
                                        @lang('sidebar.category') 
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{route('admin.category.index')}}" class="nav-link">
                                            <i class="fa fa-bars nav-icon"></i>
                                            <p>  @lang('sidebar.category')  </p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{route('admin.category.add')}}" class="nav-link">
                                            <i class="fa fa-plus  nav-icon"></i>
                                            <p>  @lang('main.add')  </p>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                    @endif


                    @if($settings->products )
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-search nav-icon"></i>
                                <p>
                                    @lang('sidebar.products')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.products.index')}}" class="nav-link">
                                        <i class="fa fa-language nav-icon"></i>
                                        <p>  @lang('sidebar.products') </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.products.add')}}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>  @lang('main.add') </p>
                                    </a>
                                </li>



                                <li class="nav-item">
                                    <a href="{{route('admin.featured.index')}}" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>  @lang('main.featured') </p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                    @endif



                    @if($settings->types )
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-search nav-icon"></i>
                            <p>
                                @lang('sidebar.types')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.types.index')}}" class="nav-link">
                                    <i class="fa fa-language nav-icon"></i>
                                    <p>  @lang('sidebar.types') </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.types.create')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>  @lang('main.add') </p>
                                </a>
                            </li>



                            {{-- <li class="nav-item">
                                <a href="{{route('admin.featured.index')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>  @lang('main.featured') </p>
                                </a>
                            </li> --}}


                        </ul>
                    </li>
                    @endif



                    
                    @if($settings->extras )
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-search nav-icon"></i>
                            <p>
                                @lang('sidebar.extras')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.extra.index')}}" class="nav-link">
                                    <i class="fa fa-language nav-icon"></i>
                                    <p>  @lang('sidebar.extras') </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.extra.create')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>  @lang('main.add') </p>
                                </a>
                            </li>




                        </ul>
                    </li>
                    @endif
                    @if($settings->combos )
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-search nav-icon"></i>
                            <p>
                                @lang('sidebar.combos')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.combo.index')}}" class="nav-link">
                                    <i class="fa fa-language nav-icon"></i>
                                    <p>  @lang('sidebar.combos') </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.combo.create')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>  @lang('main.add') </p>
                                </a>
                            </li>




                        </ul>
                    </li>
                    @endif



                    @if($settings->branches )
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-search nav-icon"></i>
                            <p>
                                @lang('sidebar.branches')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.branches.index')}}" class="nav-link">
                                    <i class="fa fa-language nav-icon"></i>
                                    <p>  @lang('sidebar.branches') </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.branches.create')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>  @lang('main.add') </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    @endif




                    @if($settings->services )
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-building nav-icon"></i>
                                <p>
                                    @lang('sidebar.services')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.services.index')}}" class="nav-link">
                                        <i class="fa fa-building nav-icon"></i>
                                        <p>   @lang('sidebar.services') </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.services.add')}}" class="nav-link">
                                        <i class="fa fa-plus  nav-icon"></i>
                                        <p>   @lang('main.add') </p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                    @endif


                    @if($settings->cms )
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-newspaper nav-icon"></i>
                                <p>
                                    @lang('sidebar.blog')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.cms.index')}}" class="nav-link">
                                        <i class="fa fa-newspaper nav-icon"></i>
                                        <p>   @lang('sidebar.blog') </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.cms.add')}}" class="nav-link">
                                        <i class="fa fa-plus  nav-icon"></i>
                                        <p>   @lang('main.add') </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif

                    @if($settings->payments )
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-dollar-sign nav-icon"></i>
                            <p>
                                @lang('sidebar.payments')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.payments.index')}}" class="nav-link">
                                    <i class="fas fa-dollar-sign nav-icon"></i>
                                    <p>   @lang('sidebar.payments') </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.payments.status')}}" class="nav-link">
                                    <i class="fas fa-dollar-sign nav-icon"></i>
                                    <p>   @lang('main.status') </p>
                                </a>
                            </li>



                        </ul>
                    </li>
                   @endif


                   


                    @if($settings->mission_vission)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-newspaper nav-icon"></i>
                                    <p>
                                        @lang('sidebar.mission_vission')
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{route('admin.mission_vission.index')}}" class="nav-link">
                                            <i class="fa fa-newspaper nav-icon"></i>
                                            <p> @lang('sidebar.mission_vission') </p>
                                        </a>
                                    </li>


                                </ul>
                            </li>
                @endif


                @if($settings->offers)
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-newspaper nav-icon"></i>
                            <p>
                                @lang('sidebar.offers')

                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.offers.index')}}" class="nav-link">
                                    <i class="fa fa-newspaper nav-icon"></i>
                                    <p>  @lang('sidebar.offers') </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('admin.offers.add')}}" class="nav-link">
                                    <i class="fa fa-plus nav-icon"></i>
                                    <p>  @lang('main.add') </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                @endif



                @if($settings->coupons)
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>
                            @lang('sidebar.coupons')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin.coupons.index')}}" class="nav-link">
                                <i class="fas fa-hand-holding-usd"></i>
                                <p>    @lang('sidebar.coupons') </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{route('admin.coupons.add')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>    @lang('main.add') </p>
                            </a>
                        </li>


                    </ul>
                </li>
            @endif


            @if($settings->points)
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-coins"></i>
                        <p>
                            @lang('sidebar.points') 
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin.points.index')}}" class="nav-link">
                                <i class="fas fa-coins"></i>
                                <p> @lang('sidebar.points')  </p>
                            </a>
                        </li>


                    </ul>
                </li>
         @endif









            @if($settings->carts)
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fa fa-shopping-cart nav-icon"></i>
                    <p>
                        @lang('sidebar.carts') 
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('admin.cards.index')}}" class="nav-link">
                            <i class="fa fa-shopping-cart nav-icon"></i>
                            <p> @lang('sidebar.carts')  </p>
                        </a>
                    </li>




                </ul>
            </li>
        @endif



        @if($settings->orders)
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="fa fa-shopping-cart nav-icon"></i>
                    <p>
                        @lang('sidebar.orders') 
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{route('admin.orders.index')}}" class="nav-link">
                            <i class="fa fa-shopping-cart nav-icon"></i>
                            <p> @lang('sidebar.orders')  </p>
                        </a>
                    </li>


                </ul>
            </li>
        @endif




        @if($settings->city_price)
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-truck"></i>
                <p>
                    @lang('sidebar.city_price')
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{route('admin.city_price.check_gov')}}" class="nav-link">
                        <i class="fa fa-money nav-icon"></i>
                        <p>  @lang('sidebar.get_gov') </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.city_price.check_city')}}" class="nav-link">
                        <i class="fa fa-money nav-icon"></i>
                        <p>  @lang('sidebar.get_city') </p>
                    </a>
                </li>







                <li class="nav-item">
                    <a href="{{route('admin.city_price.index')}}" class="nav-link">
                        <i class="fa fa-money nav-icon"></i>
                        <p>  @lang('sidebar.city_price') </p>
                    </a>
                </li>

            </ul>
        </li>
    @endif










                    @if($settings->media )
                        <li class="nav-item has-treeview">




                            <a href="#" class="nav-link">
                                <i class="fa fa-microphone nav-icon"></i>
                                <p>
                                    @lang('main.media')
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route('admin.group_media.index')}}" class="nav-link">
                                        <i class="fa fa-images nav-icon"></i>
                                        <p>   @lang('main.media') </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route('admin.media.gallery')}}" class="nav-link">
                                        <i class="fa fa-images nav-icon"></i>
                                        <p>   @lang('main.gallery') </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.media.videos')}}" class="nav-link">
                                        <i class="fa fa-video  nav-icon"></i>
                                        <p>   @lang('main.videos') </p>
                                    </a>
                                </li>


                                <li class="nav-item">
                                    <a href="{{route('admin.media.files')}}" class="nav-link">
                                        <i class="fa fa-file  nav-icon"></i>
                                        <p>   @lang('main.files') </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    @endif


                    @if($settings->des )
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-comment nav-icon"></i>
                                    <p>
                                        @lang('sidebar.des') 
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{route('admin.des.index')}}" class="nav-link">
                                            <i class="fa fa-comment nav-icon"></i>
                                            <p>    @lang('sidebar.des')  </p>
                                        </a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="{{route('admin.des.add')}}" class="nav-link">
                                            <i class="fa fa-plus  nav-icon"></i>
                                            <p>    @lang('sidebar.add')  </p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif


                    @if($settings->achievement )
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-comment nav-icon"></i>
                                    <p>
                                        Achievement
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        <a href="{{route('admin.ach.index')}}" class="nav-link">
                                            <i class="fa fa-google nav-icon"></i>
                                            <p>  Achievement </p>
                                        </a>
                                    </li>



                                </ul>
                            </li>
                        @endif






                @endif


                <!-- start language and setting -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cog nav-icon"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{route('admin.settings.index')}}" class="nav-link">
                                <i class="fa fa-cog nav-icon"></i>
                                <p>  Setting </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.auth.showUpdate')}}" class="nav-link">
                                <i class="fa fa-image nav-icon"></i>
                                <p>  Info </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('admin.auth.logout')}}" class="nav-link">
                                <i class="fa fa-image nav-icon"></i>
                                <p>  Logout </p>
                            </a>
                        </li>



                    </ul>
                </li>
                <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fa fa-language nav-icon"></i>
                            <p>
                                Langs
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{route('admin.lang.index')}}" class="nav-link">
                                    <i class="fa fa-language nav-icon"></i>
                                    <p>  Languages </p>
                                </a>
                            </li>



                        </ul>
                    </li>





            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
