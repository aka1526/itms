 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a  href="/dashboards"><i class="fa fa-bar-chart"></i>สถิติแจ้งซ่อม </a>
            </li>
        </ul>
        @if(isset(Auth::user()->name))
        <h3>ข้อมูลซ่อมบำรุง</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-calendar"></i>ข้อมูลซ่อมบำรุงคอมพิวเตอร์<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="/pmplans">แผนซ่อมบำรุง</a></li>
                <li><a href="/fixasset">ปฎิทินซ่อมบำรุง</a></li>

              </ul>
            </li>
            </ul>
      <h3>ตั้งค่าระบบพื้นฐาน</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-desktop"></i>ข้อมูลคอมพิวเตอร์<span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="/repairs">รายการแจ้งซ่อม</a></li>
            <li><a href="/fixasset">รายการคอมพิวเตอร์</a></li>
            <li><a href="/problems">ข้อมูลปัญหา</a></li>
            <li><a href="/periods">ข้อมูลรอบเวลา</a></li>
            <li><a href="/checklists">ข้อมูล Check List</a></li>
          </ul>
        </li>
        </ul>
        @endif


    </div>

  </div>

