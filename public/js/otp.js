$(document).ready(function () {
    const $sendOtpBtn = $('#sendOtpBtn');
    const $sendOtpSection = $('#sendOtpSection');
    const $otpFormSection = $('#otpFormSection');
    const $inputs = $('.otp-input');
    const $form = $('#otpForm');
    const $successAnimation = $('#successAnimation');
    const $resendLink = $('#resendLink');
    const $countdown = $('#countdown');
    const $otpSentMessage = $('#otpSentMessage');
    let countdownTimer = null;

    // send otp

    $sendOtpBtn.on('click', function (e) {
     e.preventDefault();
        console.log("OTP Email:", otpEmail);
        $sendOtpBtn.prop('disabled', true)
                   .html('<span class="spinner-border spinner-border-sm me-2"></span> Sending...');

        $.ajax({
            url: otpSendUrl,
            type: "POST",
            headers:{
                'X-CSRF-TOKEN':tocken
            },
            data: {
                email:otpEmail,
            },
            success: function (res) {
                if (res.success) {
                $sendOtpBtn.hide();
                $otpSentMessage.addClass('show-message');
                 setTimeout(function () {
                    $sendOtpSection.hide();      // poora send section hide
                    $otpFormSection.show();      // OTP form show
                    $inputs.first().focus();
                    startCountdown(60);
                }, 2000);
                } else {
                    alert(res.message || 'Failed to send OTP');
                    resetSendBtn();
                }
            },
            error: function (xhr) {
                 alert(
                    "Kuch galat Hua hai . Status: " +
                    xhr.status
                );
                resetSendBtn();
            }
        });
    });

    function resetSendBtn() {
        $sendOtpBtn.prop('disabled', false).html('Send OTP');
    }

    // ========== RESEND OTP ==========
    $resendLink.on('click', function (e) {
        e.preventDefault();
        if ($resendLink.hasClass('disabled')) return;

        $resendLink.addClass('disabled').text('Sending...');

        $.ajax({
            url: "{{ route('otp.send') }}",
            type: "POST",
            data: {
                email: "{{ $email ?? '' }}",
                _token: "{{ csrf_token() }}"
            },
            success: function (res) {
                 console.log("STATUS:", xhr.status);
                console.log("FULL ERROR:", xhr.responseJSON);
                if (res.success) {
                    startCountdown(60);
                    alert('OTP resent successfully!');
                } else {
                    alert(res.message || 'Failed to resend OTP');
                    $resendLink.removeClass('disabled').text('Resend');
                }
            },
            error: function () {
                alert('Something went wrong');
                $resendLink.removeClass('disabled').text('Resend');
            }
        });
    });

    // ========== COUNTDOWN ==========
    function startCountdown(seconds) {
        let time = seconds;
        $resendLink.addClass('disabled').css({
            'pointer-events': 'none',
            'opacity': '0.5'
        });
        $countdown.text(`(${time}s)`);

        clearInterval(countdownTimer);
        countdownTimer = setInterval(function () {
            time--;
            $countdown.text(`(${time}s)`);

            if (time <= 0) {
                clearInterval(countdownTimer);
                $countdown.text('');
                $resendLink.removeClass('disabled').css({
                    'pointer-events': 'auto',
                    'opacity': '1'
                }).text('Resend');
            }
        }, 1000);
    }

    // ========== OTP INPUT AUTO MOVE ==========
    $inputs.on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
        const index = $inputs.index(this);

        if (this.value.length === 1 && index < $inputs.length - 1) {
            $inputs.eq(index + 1).focus();
        }
    });

    $inputs.on('keydown', function (e) {
        const index = $inputs.index(this);
        if (e.key === 'Backspace' && !this.value && index > 0) {
            $inputs.eq(index - 1).focus();
        }
    });

    // ========== VERIFY OTP ==========
    $form.on('submit', function (e) {
        e.preventDefault();
        let otp = '';
        $inputs.each(function () {
            otp += $(this).val();
        });
        if (otp.length !== 6) {
            alert('Please enter complete 6-digit OTP');
            return;
        }
        const $verifyBtn = $('#verifyBtn');
        $verifyBtn.prop('disabled', true)
                  .html('<span class="spinner-border spinner-border-sm me-2"></span> Verifying...');

        $.ajax({
            url: "/home/otp/verify",
            type: "POST",
            headers:{
                'X-CSRF-TOKEN':tocken
            },
            data: {
                otp: otp,
                email:otpEmail,
            },
            success: function (res) {
                if (res.success) {
                    $successAnimation.addClass('show');
                    setTimeout(function () {
                         window.location.href = res.redirect;
                    }, 2000);
                } else {
                    alert(res.message || 'Invalid OTP');
                    $verifyBtn.prop('disabled', false).html('Verify OTP');
                }
            },
            error: function () {
                alert('Something went wrong');
                $verifyBtn.prop('disabled', false).html('Verify OTP');
            }
        });
    });

   
});