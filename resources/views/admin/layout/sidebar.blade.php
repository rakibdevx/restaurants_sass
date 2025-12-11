<ul class="metismenu" id="menu">
    <li>
        <a href="{{route('admin.dashboard')}}">
        <div class="parent-icon">
            <ion-icon name="home-outline"></ion-icon>
        </div>
        <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="cog-outline"></ion-icon>
            </div>
            <div class="menu-title">Settings</div>
        </a>
        <ul>
            <li>
                <a href="{{route('admin.setting.index')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>General Setting
                </a>
            </li>
            <li>
                <a href="{{route('admin.setting.image')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>Image Setting
                </a>
            </li>
            <li>
                <a href="{{route('admin.setting.index')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>General Setting
                </a>
            </li>
            <li>
                <a href="{{route('admin.setting.index')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>General Setting
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{route('admin.profile.index')}}">
            <div class="parent-icon">
                <ion-icon name="create-outline"></ion-icon>
            </div>
            <div class="menu-title">Profile</div>
        </a>
    </li>
    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="list-outline"></ion-icon>
            </div>
            <div class="menu-title">Menu Levels</div>
        </a>
        <ul>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <ion-icon name="ellipse-outline"></ion-icon>Level One
                </a>
                <ul>
                    <li>
                        <a class="has-arrow" href="javascript:;">
                            <ion-icon name="ellipse-outline"></ion-icon>Level Two
                        </a>
                        <ul>
                            <li>
                                <a href="javascript:;">
                                    <ion-icon name="ellipse-outline"></ion-icon>Level Three
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

</ul>
