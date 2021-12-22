<div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form wire:submit.prevent="updateSettings">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="siteName">Site name</label>
                                    <input wire:model.defer="state.site_name" type="text" class="form-control" id="siteName" placeholder="Enter Site name">
                                </div>
                                <div class="form-group">
                                    <label for="siteName">Site email</label>
                                    <input wire:model.defer="state.site_email" type="email" class="form-control" id="siteEmail" placeholder="Enter Site email">
                                </div>
                                <div class="form-group">
                                    <label for="siteName">Site title</label>
                                    <input wire:model.defer="state.site_title" type="text" class="form-control" id="siteTitle" placeholder="Enter Site title">
                                </div>
                                <div class="form-group">
                                    <label for="footerText">Footer Text</label>
                                    <input wire:model.defer="state.footer_text" type="text" class="form-control" id="footerText" placeholder="Enter Footer Text">
                                </div>
                                <div class="form-group">
                                    <label for="sidebar_collapse">Sidebar collapse</label>
                                    <br />
                                    <input wire:model.defer="state.sidebar_collapse" type="checkbox" class="" id="sidebar_collapse">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

