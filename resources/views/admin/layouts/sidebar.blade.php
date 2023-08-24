<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard.index') }}" class="brand-link">
        <img src="{{ asset('images/admin-logo.svg') }}" alt="{{ Config::get('constants.APP_NAME') }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><span class="just-color">{{ Config::get('constants.APP_NAME')
                }}</span></span>
    </a>

    <!-- Sidebar -->

    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.index') }}"
                        class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __("Dashboard") }}</p>
                    </a>
                </li>

                @if(auth()->guard('admin')->user()->is_super)
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}"
                        class="nav-link {{ request()->is('admin/user') || request()->is('admin/user/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>{{ __("Users") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}"
                        class="nav-link {{ request()->is('admin/category') || request()->is('admin/category/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>{{ __("Category") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.homepage.index') }}"
                        class="nav-link {{ request()->is('admin/homepage') || request()->is('admin/homepage/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-images"></i>
                        <p>{{ __("Home Page") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.coupon.index') }}"
                        class="nav-link {{ request()->is('admin/coupon') || request()->is('admin/coupon/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>{{ __("Coupon") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.shipping_charge') }}"
                        class="nav-link {{ request()->is('admin/country_shipping_charge') || request()->is('admin/country_shipping_charge/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>{{ __("Shipping Charge") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.country.index') }}"
                        class="nav-link {{ request()->is('admin/country') || request()->is('admin/country/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>{{ __("Currency Converter") }}</p>
                    </a>
                </li>
                <li
                    class="nav-item  @if(request()->is('admin/blogcategory') || request()->is('admin/blogcategory/*') || request()->is('admin/blog') || request()->is('admin/blog/*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-rss"></i>
                        <p>
                            {{ __("Blogs") }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.blogcategory.index') }}"
                                class="nav-link {{ request()->is('admin/blogcategory') || request()->is('admin/blogcategory/*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-list-alt"></i>
                                <p>{{ __("Blog Category") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.blog.index') }}"
                                class="nav-link {{ request()->is('admin/blog') || request()->is('admin/blog/*') ? 'active' : '' }}">
                                <i class="nav-icon fa fa-rss"></i>
                                <p>{{ __("Blog") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item  @if(request()->is('admin/size') || request()->is('admin/size/*') || request()->is('admin/shape') || request()->is('admin/shape/*') || request()->is('admin/color') || request()->is('admin/color/*') || request()->is('admin/materialmetal') || request()->is('admin/materialmetal/*') || request()->is('admin/labour') || request()->is('admin/labour/*') || request()->is('admin/packet') || request()->is('admin/packet/*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-rss"></i>
                        <p>
                            {{ __("Masters") }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.size.index') }}"
                                class="nav-link {{ request()->is('admin/size') || request()->is('admin/size/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Size") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.size-master-price.index') }}"
                                class="nav-link {{ request()->is('admin/size-master-price') || request()->is('admin/size-master-price/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>Size Master Price</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.shape.index') }}"
                                class="nav-link {{ request()->is('admin/shape') || request()->is('admin/shape/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Shape") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.color.index') }}"
                                class="nav-link {{ request()->is('admin/color') || request()->is('admin/color/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Color") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.clarity.index') }}"
                                class="nav-link {{ request()->is('admin/clarity') || request()->is('admin/clarity/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Clarity") }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.materialmetal.index') }}"
                                class="nav-link {{ request()->is('admin/materialmetal') || request()->is('admin/materialmetal/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Material Metal") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.labour.index') }}"
                                class="nav-link {{ request()->is('admin/labour') || request()->is('admin/labour/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Labour") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.packet.index') }}"
                                class="nav-link {{ request()->is('admin/packet') || request()->is('admin/packet/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Packet") }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                    class="nav-item  @if(request()->is('admin/metal') || request()->is('admin/metal/*') || request()->is('admin/material') || request()->is('admin/material/*') || request()->is('admin/product') || request()->is('admin/product/*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>

                        <p>
                            {{ __("Products") }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.metal.index') }}"
                                class="nav-link {{ request()->is('admin/metal') || request()->is('admin/metal/*') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Metal") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.material.index') }}"
                                class="nav-link {{ request()->is('admin/material') || request()->is('admin/material/*') ? 'active' : '' }}">
                                <i class="fas fa-solid fa-recycle nav-icon"></i>
                                <p>{{ __("Material") }}</p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}"
                                class="nav-link {{ request()->is('admin/product') || request()->is('admin/product/*') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Product") }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}"
                        class="nav-link {{ request()->is('admin/order') || request()->is('admin/order/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-flag"></i>
                        <p>{{ __("Orders") }}</p>
                    </a>
                </li>

                <li
                    class="nav-item  @if((request()->is('admin/cmspage') || request()->is('admin/cmspage/*') ) || request()->is('admin/faq') || request()->is('admin/faq/*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pager"></i>

                        <p>
                            {{ __("CMS Pages") }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','about-us') }}"
                                class="nav-link {{ request()->is('admin/cmspage/about-us') || request()->is('admin/cmspage/about-us') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("About US") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','privacy-policy') }}"
                                class="nav-link {{ request()->is('admin/cmspage/privacy-policy') || request()->is('admin/cmspage/privacy-policy') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Privacy Policy") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','delivery-returns') }}"
                                class="nav-link {{ request()->is('admin/cmspage/delivery-returns') || request()->is('admin/cmspage/delivery-returns') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Delivery Returns") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','warranty') }}"
                                class="nav-link {{ request()->is('admin/cmspage/warranty') || request()->is('admin/cmspage/warranty') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Warranty") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','terms-of-use') }}"
                                class="nav-link {{ request()->is('admin/cmspage/terms-of-use') || request()->is('admin/cmspage/terms-of-use') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Terms And conditions") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','our-story') }}"
                                class="nav-link {{ request()->is('admin/cmspage/our-story') || request()->is('admin/cmspage/our-story') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Our Story") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.testimonial.index') }}"
                                class="nav-link {{ request()->is('admin/cmspage/testimonial') || request()->is('admin/testimonial/*') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Testimonial") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','sustainablity') }}"
                                class="nav-link {{ request()->is('admin/cmspage/sustainablity') || request()->is('admin/cmspage/sustainablity') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Sustainablity") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','bonica5bs3') }}"
                                class="nav-link {{ request()->is('admin/cmspage/bonica5bs3') || request()->is('admin/cmspage/bonica5bs3') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Bonica 5bs 3") }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','our-team') }}"
                                class="nav-link {{ request()->is('admin/cmspage/our-team') || request()->is('admin/cmspage/our-team') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Our Team") }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.cmspage','size-guide') }}"
                                class="nav-link {{ request()->is('admin/cmspage/size-guide') || request()->is('admin/cmspage/size-guide') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>{{ __("Size Guides") }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.faq.index') }}"
                                class="nav-link {{ request()->is('admin/faq') || request()->is('admin/faq/*') ? 'active' : '' }}">
                                <i class="fa fa-question-circle nav-icon"></i>
                                <p>{{ __("FAQ") }}</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.contact.index') }}"
                        class="nav-link {{ request()->is('admin/contact') || request()->is('admin/contact/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-address-book"></i>
                        <p>{{ __("Contact") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.appointment.index') }}"
                        class="nav-link {{ request()->is('admin/appointment') || request()->is('admin/appointment/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-calendar-check"></i>
                        <p>{{ __("Appointment") }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.newsletter.index') }}"
                        class="nav-link {{ request()->is('admin/newsletter') || request()->is('admin/newsletter/*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-calendar-check"></i>
                        <p>{{ __("Newsletter") }}</p>
                    </a>
                </li>


                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
