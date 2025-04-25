<?php
function render_header()
{

    echo '<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid d-flex justify-content-between flex-nowrap">
                <a class="navbar-brand ms-2" href="home">Yummy Restaurant Group Limited</a>
                    <!-- <div class="justify-content-end me-2 w-auto d-grid gap-2 d-md-flex"> (for two button) -->

                    <!-- Nav Item - User Information -->
                    <div class="dropdown me-2 w-auto">
                        <button class="dropdown-toggle btn btn-outline-dark" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>' . $_SESSION['username'] . ', ' . $_SESSION['role'] . '</span>
                        </button>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-end shadow"
                        aria-labelledby="userDropdown">
                        <!-- Profile -->
                        <a class="dropdown-item d-flex align-items-center p-1" href="profile">
                            <i class="bx bx-user ms-2 me-2"></i>
                            Profile
                        </a>
                        <!-- Setting -->
                        <a class="dropdown-item d-flex align-items-center p-1" href="setting">
                            <i class="bx bx-cog ms-2 me-2"></i>
                            Settings
                        </a>
                        <!-- Activity Log -->
                        <a class="dropdown-item d-flex align-items-center p-1" href="activitylog">
                            <i class="bx bx-list-ul ms-2 me-2"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <!-- Logout -->
                        <a class="dropdown-item d-flex align-items-center p-1" href="logout" data-toggle="modal" data-target="#logoutModal">
                            <i class="bx bx-log-out ms-2 me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>';
}
