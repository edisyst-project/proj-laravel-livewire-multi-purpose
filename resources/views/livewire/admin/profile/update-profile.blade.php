<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center" x-data="{ imagePreview: '{{ auth()->user()->avatar_url }}' }">
                                <input type="file"
                                       class="d-none"
                                       wire:model="image"
                                       x-ref="image"
                                       x-on:change="
                                       reader = new FileReader();
                                       reader.onload = (event) => {
                                            imagePreview = event.target.result;
                                            document.getElementById('profileImage').src = `${imagePreview}`;
                                       };
                                       reader.readAsDataURL($refs.image.files[0]);
                                   "
                                /> {{--SI ATTIVA SE CLICCO SU $refs.image--}}
                                <img
                                    x-on:click="$refs.image.click()"
                                    x-bind:src="imagePreview ? imagePreview : '{{ auth()->user()->avatar_url }}'"
                                    class="profile-user-img img-circle" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                            <p class="text-muted text-center">{{ auth()->user()->role }}</p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->



                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card" x-data="{ currentTab: $persist('editProfile') }">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" wire:ignore>
                                <li @click.prevent="currentTab = 'editProfile'" class="nav-item"><a class="nav-link" :class="currentTab == 'editProfile' ? 'active' : ''" href="#editProfile" data-toggle="tab"><i class="fa fa-user mr-1"></i>Edit Profile</a></li>
                                <li @click.prevent="currentTab = 'changePass'"  class="nav-item"><a class="nav-link" :class="currentTab == 'changePass'  ? 'active' : ''" href="#changePass"  data-toggle="tab"><i class="fa fa-key mr-1"></i>Change Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" :class="currentTab == 'editProfile' ? 'active' : ''" id="editProfile" wire:ignore.self>
                                    <form wire:submit.prevent="updateProfile" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="state.name" type="text" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="state.email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i>Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" :class="currentTab == 'changePass' ? 'active' : ''" id="changePass" wire:ignore.self>
                                    <form wire:submit.prevent="changePassword" class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="currentPassword" class="col-sm-2 col-form-label">Current Password</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="state.current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" placeholder="Your Password">
                                                @error('current_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="New Password">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="passwordConfirmation" class="col-sm-2 col-form-label">Retype New Password</label>
                                            <div class="col-sm-10">
                                                <input wire:model.defer="state.password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder="Retype New Password">
                                                @error('password_confirmation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>


@push('styles')
    <style>
        .profile-user-img:hover {
            background-color: blue;
            cursor: pointer;
        }
    </style>
@endpush


@push('alpine-plugins')
    <script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
@endpush


@push('js')
    <script>
        $(document).ready(function () {
            Livewire.on('nameChanged', (changedName) => {
                // console.log('nome nuovo: ' + changedName);
                $('[x-ref="username"]').text(changedName)
            })
        });
    </script>
@endpush
