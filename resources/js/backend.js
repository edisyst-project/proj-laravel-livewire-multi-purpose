$(document).ready(function () {
    // $('#appointmentDate').datetimepicker({
    //     format: 'L'
    // });
    //
    // $('#appointmentTime').datetimepicker({
    //     format: 'LT'
    // });
    //
    // $("#appointmentDate").on("change.datetimepicker", function (e) {
    //     // $('#appointmentDate').datetimepicker('minDate', e.date);
    //     let date = $(this).data('appointment-date');
    //     // console.log(date);
    //     eval(date).set('state.date', $('#appointmentDateInput').val());
    // });
    //
    // $("#appointmentTime").on("change.datetimepicker", function (e) {
    //     let time = $(this).data('appointment-time');
    //     eval(time).set('state.time', $('#appointmentTimeInput').val());
    // });

    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    }

    window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
        toastr.success(event.detail.message, 'Success !!!');
    })
})

window.addEventListener('show-form', event => {
    $('#form').modal('show');
})
window.addEventListener('hide-form', event => {
    $('#form').modal('hide');
})
window.addEventListener('show-delete-modal', event => {
    $('#confirmDeleteModal').modal('show');
})
window.addEventListener('hide-delete-modal', event => {
    $('#confirmDeleteModal').modal('hide');
    toastr.success(event.detail.message, 'Success !!!');
})
window.addEventListener('alert', event => {
    toastr.success(event.detail.message, 'Success !!!');
})
window.addEventListener('updated', event => {
    toastr.success(event.detail.message, 'Success !!!');
})

$('[x-ref="profileLink"]').on('click', function () {
    localStorage.setItem('_x_currentTab', '"editProfile"');
})
$('[x-ref="changePassLink"]').on('click', function () {
    localStorage.setItem('_x_currentTab', '"changePass"');
})
