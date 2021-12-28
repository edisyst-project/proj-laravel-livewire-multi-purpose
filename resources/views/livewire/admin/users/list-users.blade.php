<div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

{{--            @if(session()->has('message'))--}}
{{--                <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                    <strong>--}}
{{--                        <i class="fa fa-check-circle mr-1"></i>--}}
{{--                        {{ session('message') }}--}}
{{--                    </strong>--}}
{{--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            @endif--}}

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary">
                            <i class="fa fa-plus-circle mr-1"></i>Add New User
                        </button>
                        <x-search-input wire:model="searchTerm"></x-search-input>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">
                                        Name
                                        <span wire:click="sortBy('name')" class="float-right text-sm" style="cursor: pointer">
                                            <i class="fa fa-arrow-up   {{ $sortColumnName === 'name' && $sortDirection === 'asc'  ? '' : 'text-muted' }}"></i>
                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                        </span>
                                    </th>
                                    <th scope="col">
                                        Email
                                        <span wire:click="sortBy('email')" class="float-right text-sm" style="cursor: pointer">
                                            <i class="fa fa-arrow-up   {{ $sortColumnName === 'email' && $sortDirection === 'asc'  ? '' : 'text-muted' }}"></i>
                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'email' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                        </span>
                                    </th>
                                    <th scope="col">Registration date</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse($users as $index => $user)
                                        <tr>
{{--                                            <td>{{ $loop->iteration }}</td>--}}
                                            <td>{{ $users->firstItem() + $index }}</td>
                                            <td>
                                                <img style="width: 50px;" class="img img-circle mr-1"
                                                     src="{{ $user->avatar_url }}" />
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at?->toFormattedDate() ?? 'Not Avaible' }}</td> {{-- il ? funge con PHP 8: mi accetta anche created_at=NULL --}}
                                            <td>
                                                <select class="form-control" wire:change="changeRole({{ $user }}, $event.target.value)">
                                                    <option value="admin" {{ ($user->role === 'admin') ? 'selected' : '' }}>ADMIN</option>
                                                    <option value="user"  {{ ($user->role === 'user')  ? 'selected' : '' }}>USER</option>
                                                </select>
                                            </td>
                                            <td>
                                                <a href="#" wire:click.prevent="edit({{ $user }})">
                                                    <i class="fa fa-edit mr-2"></i>
                                                </a>
                                                <a href="#" wire:click.prevent="confirmDelete({{ $user }})">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="alert alert-default-danger text-center">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/1178/1178479.png" alt="No results" height="50" />
                                                    <strong>No users found</strong>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- /.col-md-12 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Button trigger modal -->
{{--    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
{{--        Launch demo modal--}}
{{--    </button>--}}

    <!-- Modal create user -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'storeUser' }}" autocomplete="off">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal) <span>Edit User</span>
                            @else <span>Add New User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="state.name" placeholder="Enter full name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="state.email" placeholder="Enter email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                   wire:model.defer="state.password" placeholder="Password"
                            >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   wire:model.defer="state.password_confirmation" placeholder="Password Confirmation"
                            >
                        </div>

                        <div class="form-group">
                            <label for="customFile">Profile Photo</label>
                            <div class="custom-file">
                                <div x-data="{ isUploading: false, progress: 5 }"
                                     x-on:livewire-upload-start="isUploading = true"
                                     x-on:livewire-upload-finish="isUploading = false; progress = 5"
                                     x-on:livewire-upload-error="isUploading = false"
                                     x-on:livewire-upload-progress="progress = $event.detail.progress"
                                >
                                    <input wire:model.defer="photo" type="file" class="custom-file-input" id="customFile">
                                    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                             x-bind:style="`width: ${progress}%`"
                                        >
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom-file-label" for="customFile">
                                    @if ($photo) {{ $photo->getClientOriginalName() }}
                                    @else Choose your profile image
                                    @endif
                                </label>
                            </div>
                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="img img-circle d-block mt-2 w-50" />
                            @else
                                <img src="{{ $state['avatar_url'] ?? ''}}" class="img img-circle d-block mt-2 w-50" />
                            @endif
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                            @if ($showEditModal) <span>Update</span>
                            @else <span>Save</span>
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.Modal create -->

    <!-- Modal Delete user -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true"
         wire:ignore.self
    >
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'storeUser' }}" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete user</h5>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure you want to delete this user?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times mr-1"></i>Cancel
                        </button>
                        <button type="button" wire:click.prevent="deleteUser" class="btn btn-primary">
                            <i class="fa fa-trash mr-1"></i>Delete user
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.Modal Delete -->


</div>


