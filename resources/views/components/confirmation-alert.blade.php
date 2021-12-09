@push('js')
    <!-- Sweetalert2 CDN scripts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed');
                }
            })
        })
        window.addEventListener('appointment-delete', event => {
            Swal.fire(
                'Deleted!',
                event.detail.message,
                'success'
            )
            // toastr.success(event.detail.message, 'Success !!!');
        })
    </script>
@endpush
