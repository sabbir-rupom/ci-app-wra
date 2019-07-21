<nav class="navbar navbar-expand-lg navbar-light bg-info main-nav">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <div class="toggle-bar mr-auto">
                <span class="btn btn-inline sidebar-toggle fa fa-bars"></span>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $userData['username']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= base_url('admin/logout'); ?>"><i class="fa fa-sign-out"></i> Sign Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>