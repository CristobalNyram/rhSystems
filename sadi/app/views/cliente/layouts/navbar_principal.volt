<div id="wrapper" style="    margin-bottom: 90px;">

  <!-- <div class="main_container" id="{{gcolor}}"> -->
      
      <!-- top navigation -->
      <header id="topnav">

          <div class="navbar-custom navbar-custom-crm">
              <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">

                          <li class="dropdown notification-list ">
                              <!-- Mobile menu toggle-->

                              <a class="navbar-toggle nav-link navigation-color">
                                  <div class="lines">
                                    <!-- <i class="fa fa-bars" aria-hidden="true"></i> -->
                                      <span></span>
                                      <span></span>
                                      <span></span>
                                  </div>
                              </a>
                              <!-- End mobile menu toggle-->
                          </li>

                          <li class="dropdown notification-list">
                              <a class="nav-link dropdown-toggle nav-user mr-0 " data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                {{ image("assets/images/users/avatar-1.jpg", "alt": "user-image", "class": "rounded-circle") }}
                                  <!-- <img src="assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle"> -->
                                  <span class="pro-user-name d-none d-xl-inline-block ml-2 navigation-color">
                                  Hola, <b>{{ nombreadmin }}</b>  <i class="mdi mdi-chevron-down"></i> 
                                  </span>
                              </a>
                              <ul class="navbar-nav">
                              <li class="nav-item dropdown">
                                  <!-- item-->
                                  <ul class="dropdown-menu dropdown-menu-right">

                                    
                                    <!-- item-->

                                    <!-- item-->
                                    {{ link_To(['session/end_aes','class': 'dropdown-item','<i class="mdi mdi-logout-variant"></i><span> Salir</span>']) }}
                                  </ul>
                              </li>
                            </ul>
                          </li>

                </ul>
                <div class="logo-box">
                    <a class="logo text-center">
                        <span class="logo-lg">
                          
                          {{ image("assets/images/small/logo_white.svg", "alt": " ", "height": "36") }} 
                          
                        </span>
                        <span class="logo-sm">
                          {{ image("assets/images/small/logo_sm.svg", "alt": " ", "height": "36") }}
                        </span>
                    </a>
                </div>
                  
        
         
                <div class="clearfix"></div>
              </div>
          </div>

      </header>
     
    

     
</div>