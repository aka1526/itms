 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
      <h3>General</h3>
      <ul class="nav side-menu" >
        <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="index.html">Dashboard</a></li>
            <li><a href="index2.html">Dashboard2</a></li>
            <li><a href="index3.html">Dashboard3</a></li>
          </ul>
        </li>
        <li class="active">
            <a href="/masterlist"><i class="fa fa-laptop"></i> Master List </a></li>

        <li><a><i class="fa fa-edit"></i> คำร้องขอเอกสาร <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <?php
                $PurposeMenus = \App\Models\Purpose::getPurposemenu();
            ?>

            @foreach ($PurposeMenus as $key => $row)
                <li><a href="{{ $row->PURPOSE_URL}}">{{ $row->PURPOSE_NAME}}</a></li>
            @endforeach

          </ul>
        </li>

      </ul>
    </div>
    <div class="menu_section">
      <h3>ตั้งค่าระบบพื้นฐาน</h3>
      <ul class="nav side-menu">
        <li><a><i class="fa fa-bug"></i> กำหนดเอกสารใบ DAR <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="/base/purpose">หัวข้อวัตถุประสงค์</a></li>
            <li><a href="/base/reason">หัวข้อเหตุผลในการขอ</a></li>
            <li><a href="/base/docinternal">หัวข้อเอกสารภายใน</a></li>
            <li><a href="/base/docexternal">หัวข้อเอกสารภายนอก</a></li>
            <li><a href="/base/section">หน่วยงาน/Section</a></li>
            <li><a href="/base/review">ทบทวนรหัสเอกสาร</a></li>
            <li><a href="/base/mctype">ประเภทเครื่องจักร</a></li>
          </ul>
        </li>
        </ul>
    </div>

  </div>

