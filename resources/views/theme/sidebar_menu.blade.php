 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a  href="/dashboards"><i class="fa fa-bar-chart"></i>สถิติแจ้งซ่อม </a>
            </li>
        </ul>
        <ul class="nav side-menu">
            <li><a  href="/actions/reqerp"><i class="fa fa-cubes"></i>ขอปรับปรุง ERP </a>
            </li>
        </ul>
        @if(isset(Auth::user()->name))

        <ul class="nav side-menu">
            <li><a><i class="fa fa-calendar"></i>ข้อมูลซ่อมบำรุงคอมพิวเตอร์<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">

                <li><a href="/repairs">ระบบแจ้งซ่อม</a></li>
                <li><a href="/pmplans">แผนบำรุงรักษา</a></li>
                <li><a href="/fixasset">ข้อมูลคอมพิวเตอร์</a></li>
                {{-- <li><a href="/fixasset">ปฎิทินซ่อมบำรุง</a></li> --}}

              </ul>
            </li>
            </ul>

      <ul class="nav side-menu">
        <li><a><i class="fa fa-desktop"></i>ค่าระบบพื้นฐาน<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">


            <li><a href="/problems">ข้อมูลปัญหา</a></li>
            <li><a href="/periods">ข้อมูลรอบเวลา</a></li>
            <li><a href="/checklists">ข้อมูล Check List </a></li>
          </ul>
        </li>
        </ul>
        @endif


    </div>

  </div>

