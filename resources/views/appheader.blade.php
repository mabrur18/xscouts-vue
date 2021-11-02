<div id="topbar" class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home">
            <img class="img-responsive" src="{{ asset('images/logo.png') }}" />
        </a>
        <?php 
            if(Auth::check() ){ 
        ?>
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
        </button>
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php
                            $user_photo = $user->UserPhoto();
                            if($user_photo){
                            Html::img($user_photo, 30, 30);
                            }
                            else{
                        ?>
                        <span class="avatar-icon"><i class="material-icons">account_box</i></span>
                        <?php
                            }
                        ?>
                        <span>Hi <?php echo $user->UserName(); ?> !</span>
                    </a>
                    <ul class="dropdown-menu">
                        <a class="dropdown-item" href="<?php print_link('account') ?>"><i class="material-icons">account_box</i> My Account</a>
                        <a class="dropdown-item" href="<?php print_link('auth/logout') ?>"><i class="material-icons">exit_to_app</i> Logout</a>
                    </ul>
                </li>
            </ul>
        </div>
        <?php 
            } 
        ?>
    </div>
</div>
<?php 
    if(Auth::check() ){ 
?>
<nav id="sidebar" class="navbar-light bg-light">
<ul class="nav navbar-nav w-100 flex-column align-self-start">
    <li class="menu-profile text-center nav-item">
        <a class="avatar" href="<?php print_link('account') ?>">
        <?php 
            $user_photo = $user->UserPhoto();
            if($user_photo){
            Html::page_img($user_photo, 260, 200, "medium"); 
            }
            else{
        ?>
        <span class="avatar-icon"><i class="material-icons">account_box</i></span>
        <?php
            }
        ?>
    </a>
    <h5 class="user-name">Hi 
    <?php echo $user->UserName(); ?>
    <?php $userRoles = $user->getRoleNames()->toArray(); ?>
    <br />
    <small class="text-muted text-capitalize"> <?php echo implode(", ", $userRoles); ?></small>
    </h5>
    <div class="dropdown menu-dropdown">
        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons">account_box</i>
        </button>
        <ul class="dropdown-menu">
            <a class="dropdown-item" href="<?php print_link('account') ?>"><i class="material-icons">account_box</i> My Account</a>
            <a class="dropdown-item" href="<?php print_link('auth/logout') ?>"><i class="material-icons">exit_to_app</i> Logout</a>
        </ul>
    </div>
</li>
</ul>
{{ Html::render_menu(Menu::navbarsideleft()  , "nav navbar-nav w-100 flex-column align-self-start"  , "accordion") }}
</nav>
<?php 
    } 
?>