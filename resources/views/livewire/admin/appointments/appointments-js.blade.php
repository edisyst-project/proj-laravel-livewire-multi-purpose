@push('js')
    <!-- Tempus Dominus scripts -->
    <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>


    <script>
        $('#colorPicker').colorpicker().on('change', function (event) {
            $('#colorPicker .fa-square').css('color', event.color.toString());
        });
    </script>


    <!-- CK Editor scripts -->
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#appointmentNote'))
        .then(editor => {
            console.log(editor);
            editor.model.document.on('change:data', () => {
                // let note = $('#appointmentNote').data('appointment-note');
                // // console.log($('#appointmentNote').val())
                // // eval(note).set('state.note', $('#appointmentNote').val());
                // eval(note).set('state.note', editor.getData());
                document.querySelector('#appointmentSave').addEventListener('click', () => {
                    let note = $('#appointmentNote').data('appointment-note');
                    eval(note).set('state.note', editor.getData());
                });
            });
        })
        .catch(error => {
            console.error(error);
        });


        $('form').submit(function () {
            @this.set('state.members', $('#members').val());
            @this.set('state.note', $('#appointmentNote').val());
            @this.set('state.color', $('[name=color]').val());
        })
    </script>
@endpush















