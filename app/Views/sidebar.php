<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <!--logo-->
                        <?php echo anchor('dashboard','<i class="fa-solid fa-house me-2"></i> Dashboard',['class'=>'nav-link text-dark']); ?>
                        </li>
                    <li class="nav-item">
                        <?php echo anchor('kecamatan','<i class="fa-solid fa-landmark me-2"></i> Kecamatan',['class'=>'nav-link text-dark']); ?>
                        </li>
                        <li class="nav-item">
                            <?php echo anchor('apotik','<i class="fa-solid fa-medkit me-2"></i> Apotik',['class'=>'nav-link text-dark']); ?>
                            </li>
                        </ul>
                        <hr>
                        <div class="small">&copy 2024 - UNU Al Ghazali Cilacap</div>
                    </div>
                </nav>