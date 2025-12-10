<ul class="metismenu" id="menu">
    <li>
        <a href="{{route('owner.dashboard')}}">
        <div class="parent-icon">
            <ion-icon name="home-outline"></ion-icon>
        </div>
        <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li>
        <a class="has-arrow" href="javascript:;">
            <div class="parent-icon">
                <ion-icon name="create-outline"></ion-icon>
            </div>
            <div class="menu-title">Profile</div>
        </a>
        <ul>
            <li>
                <a href="{{route('owner.profile.index')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>Edit Profile
                </a>
            </li>
             <li>
                <a href="{{route('owner.profile.information')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>Information
                </a>
            </li>
             <li>
                <a href="{{route('owner.profile.business')}}">
                    <ion-icon name="ellipse-outline"></ion-icon>Business Information
                </a>
            </li>
        </ul>
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
