<div>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Manage Role Permissions</h4>

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Role Selection -->
            <div class="col-lg-3 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Select Role</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($roles as $role)
                                <button 
                                    type="button"
                                    wire:click="selectRole({{ $role->id }})"
                                    class="list-group-item list-group-item-action {{ $selectedRole && $selectedRole->id === $role->id ? 'active' : '' }}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $role->name }}</h6>
                                    </div>
                                    <small>{{ $role->description }}</small>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions Management -->
            <div class="col-lg-9 col-md-12">
                @if($selectedRole)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Permissions for {{ $selectedRole->name }}</h5>
                            <button 
                                type="button"
                                wire:click="savePermissions"
                                class="btn btn-primary"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>
                                    <i class="bx bx-save me-1"></i> Save Changes
                                </span>
                                <span wire:loading>
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Saving...
                                </span>
                            </button>
                        </div>
                        <div class="card-body">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <button 
                                        type="button"
                                        wire:click="switchTab('menus')"
                                        class="nav-link {{ $activeTab === 'menus' ? 'active' : '' }}">
                                        <i class="bx bx-menu me-1"></i> Menu Navigation
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button 
                                        type="button"
                                        wire:click="switchTab('features')"
                                        class="nav-link {{ $activeTab === 'features' ? 'active' : '' }}">
                                        <i class="bx bx-cog me-1"></i> Feature Permissions
                                    </button>
                                </li>
                            </ul>

                            <!-- Menu Tab -->
                            @if($activeTab === 'menus')
                                <div>
                                    @foreach($menuPermissions as $index => $permissions)
                                        <div class="card mb-3">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">{{ $permissions->first()->category }}</h6>
                                                <button 
                                                    type="button"
                                                    wire:click="toggleAllInCategory({{ $loop->index }}, 'menu')"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Toggle All
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($permissions as $permission)
                                                        <div class="col-md-6 mb-3">
                                                            <div class="form-check">
                                                                <input 
                                                                    class="form-check-input" 
                                                                    type="checkbox" 
                                                                    wire:click="togglePermission({{ $permission->id }})"
                                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    id="perm-{{ $permission->id }}">
                                                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                                    <i class="bx bx-{{ $permission->icon }} me-1"></i>
                                                                    <strong>{{ $permission->name }}</strong>
                                                                    <br>
                                                                    <small class="text-muted">{{ $permission->description }}</small>
                                                                    <br>
                                                                    <small class="text-info">Route: {{ $permission->route }}</small>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Feature Tab -->
                            @if($activeTab === 'features')
                                <div>
                                    @foreach($featurePermissions as $index => $permissions)
                                        <div class="card mb-3">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h6 class="mb-0">{{ $permissions->first()->category }}</h6>
                                                <button 
                                                    type="button"
                                                    wire:click="toggleAllInCategory({{ $loop->index }}, 'feature')"
                                                    class="btn btn-sm btn-outline-primary">
                                                    Toggle All
                                                </button>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($permissions as $permission)
                                                        <div class="col-md-3 mb-2">
                                                            <div class="form-check">
                                                                <input 
                                                                    class="form-check-input" 
                                                                    type="checkbox" 
                                                                    wire:click="togglePermission({{ $permission->id }})"
                                                                    {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                                                    id="perm-{{ $permission->id }}">
                                                                <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="bx bx-shield-x" style="font-size: 64px; color: #ddd;"></i>
                            <h5 class="mt-3">Pilih role untuk mengelola permissions</h5>
                            <p class="text-muted">Silakan pilih role dari daftar di sebelah kiri</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>