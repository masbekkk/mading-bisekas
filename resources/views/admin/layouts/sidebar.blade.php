  <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
          <div class="brand-logo d-flex align-items-center justify-content-between">
              <a href="/" class="text-nowrap logo-img">
                  <img src="https://bisekas.com/wp-content/uploads/2022/05/Logo_Biseka-removebg-preview.png" height="80" alt="" />
              </a>
              <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                  <i class="ti ti-x fs-8"></i>
              </div>
          </div>
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
              <ul id="sidebarnav">
                  <li class="nav-small-cap">
                      <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                      <span class="hide-menu">Home</span>
                  </li>
                  <li class="sidebar-item">
                      <a class="sidebar-link {{ Route::is('admin-mading.index') ? 'active' : '' }}" href="/admin-mading" aria-expanded="false">
                          <span>
                              <iconify-icon icon="solar:home-smile-bold-duotone" class="fs-6"></iconify-icon>
                          </span>
                          <span class="hide-menu">Dashboard</span>
                      </a>
                  </li>
                  <li class="sidebar-item  ">
                    <a type="button" class='sidebar-link {{ Route::is('logout') ? 'active' : '' }}' id="button-logout">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
              </ul>
            
          </nav>
          <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
  </aside>
