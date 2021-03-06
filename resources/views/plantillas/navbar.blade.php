<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title"><i class="fa fa-shopping-cart"></i> <span>TIENDAS BUAP</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <!--
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>

          -->
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!--<h3>General</h3>-->
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-plus-square"></i> Productos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/productos">Listado de productos</a></li>
                    </ul>
                  </li>
                  @if(in_array(\Session::get('categoria')[0], ['ADMINISTRADOR','ENCARGADO']))
                  <li><a><i class="fa fa-map-marker"></i> Espacios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/espacios">Tiendas/Bodegas</a></li>
                    </ul>
                  </li>
                  @endif

                  <li><a><i class="fa fa-shopping-cart"></i> Venta <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/venta">Venta de artículos</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-file"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                    <!--<ul class="nav child_menu">
                      <li><a href="/reportes/inventario">Reporte de inventario</a></li>
                    </ul>-->
                    <ul class="nav child_menu">
                      <li><a href="/reportes/ventas">Reporte de ventas</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-file"></i> Inventarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/inventario">Elaborar inventario</a></li>
                      @if(in_array(\Session::get('categoria')[0], ['CAJERO']))
                        <li><a href="/espacios/{{\Session::get('id_tienda')[0]}}/inventario">Inventario interno</a></li>
                      @endif
                    </ul>
                  </li>

                  @if(in_array(\Session::get('categoria')[0], ['ADMINISTRADOR','ENCARGADO']))
                  <li><a><i class="fa fa-user"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/usuarios">Registrar usuario</a></li>
                    </ul>
                  </li>
                  @endif
                  <li><a href="/salir"><i class="fa fa-sign-out"></i> Salir </a>
                  </li>
                  
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <!--<a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a> -->
              <!--<a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>-->
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->