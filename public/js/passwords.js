$(document).ready(function () {
    const $changeForm = $('#changePasswordForm');
    const $forgotForm = $('#forgotPasswordForm');
    const $successMessage = $('#successMessage');
    const $formTitle = $('#formTitle');
    const $formSubtitle = $('#formSubtitle');


    function showSuccess() {

        $changeForm.hide();
        $forgotForm.hide();
        $formTitle.text('Success!');
        $formSubtitle.text('');
        $successMessage.show();
    }

  
    $changeForm.on('submit', function (event) {

        event.preventDefault();
        $('.field-error').hide().text('');
        const $btn = $(this).find('button[type="submit"]');
        $btn.prop('disabled', true).text('Updating...');
        $.ajax({
            url: $(this).attr('action'),
            type: "POST", // Laravel accepts PUT over POST payload via @_method
            data: $(this).serialize(),
            success: function (res) {
                if (res.success) {
                     showSuccess();
                    $changeForm[0].reset(); // Form clear karne ke liye
                }
                 setTimeout(function() {
                    $btn.prop('disabled', false).text('Update Password');
                    }, 3000); 
                setTimeout(function () {
                         window.location.href = res.redirect;
                    }, 2000);
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON?.errors) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        const $errDiv = $('#' + field + '_error');
                        if ($errDiv.length) {
                            $errDiv.text(messages[0]).show();
                            $('[name="' + field + '"]').addClass('is-invalid');
                        }
                    });
                    return;
            } 
            setTimeout(function() {
                $btn.prop('disabled', false).text('Update Password');
            }, 3000); 

            if (xhr.responseJSON?.message) {
                $('#errorText').text(xhr.responseJSON.message);
                $('#errorMessage').show();
                setTimeout(function() {
                 $('#errorMessage').hide();
                }, 3000); 
            } else {
                // Fallback
                $('#errorText').text('Kuch gadbad hui, phir try karo.');
                $('#errorMessage').show();
            }
            }
            
        });


    });


    $forgotForm.on('submit', function (event) {
        event.preventDefault();
        showSuccess();

    });

});