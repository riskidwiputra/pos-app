<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ auth()->user()->name }}! 🎉</h5>
                                <p class="mb-4">
                                    Anda login sebagai <span class="fw-bold">{{ $userRole }}</span>. 
                                    Menu dan fitur yang tersedia disesuaikan dengan permissions role Anda.
                                </p>

                                @superadmin
                                <a href="{{ route('roles.manage-permissions') }}" class="btn btn-sm btn-outline-primary" wire:navigate>
                                    Manage Role Permissions
                                </a>
                                @endsuperadmin
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="{{ Vite::asset('resources/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140"
                                    alt="View Badge User"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-user rounded bx-md text-primary"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Your Role</span>
                        <h3 class="card-title mb-2">{{ $userRole }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-shield rounded bx-md text-success"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Permissions</span>
                        <h3 class="card-title mb-2">{{ $totalPermissions }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-menu rounded bx-md text-info"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Menu Access</span>
                        <h3 class="card-title mb-2">{{ $menuAccess }}</h3>
                    </div>
                </div>
            </div>

            @permission('supplier.view')
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-store rounded bx-md text-warning"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Suppliers</span>
                        <h3 class="card-title mb-2">0</h3>
                    </div>
                </div>
            </div>
            @endpermission
        </div>

        <!-- Your Menu Access -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Your Menu Access</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($menus as $menu)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                    <div class="d-flex align-items-center p-3 bg-label-primary rounded">
                                        <i class="bx bx-{{ $menu->icon }} me-2 fs-4"></i>
                                        <span>{{ $menu->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @superadmin
        <!-- Super Admin Only Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            <i class="bx bx-crown me-2"></i>Super Admin Access
                        </h5>
                        <p class="mb-3">
                            Anda memiliki akses penuh untuk mengelola semua permissions dan mengatur akses menu untuk role lain.
                        </p>
                        <a href="{{ route('roles.manage-permissions') }}" class="btn btn-primary" wire:navigate>
                            <i class="bx bx-cog me-1"></i> Manage Role Permissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endsuperadmin
    </div>
</div>