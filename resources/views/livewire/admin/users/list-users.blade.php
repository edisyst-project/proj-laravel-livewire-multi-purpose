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
                    <div class="d-flex justify-content-end mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary">
                            <i class="fa fa-plus-circle mr-1"></i>
                            Add New User
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Registration date</th>
                                    <th scope="col">Options</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->toFormattedDate() }}</td>
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
                                            <td colspan="4">
                                                <div class="alert alert-default-danger">No users</div>
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

    <!-- Modal -->
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
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.defer="state.password" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" id="password_confirmation" wire:model.defer="state.password_confirmation" placeholder="Password Confirmation">
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
    <!-- /.Modal -->

    <!-- Modal Delete -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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


