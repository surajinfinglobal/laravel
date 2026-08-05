<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <style>
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .employee-card {
            background: rgba(31, 41, 55, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .row {
            display: flex;
            gap: 20px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            min-width: 280px;
        }

        label {
            display: block;
            color: #e2e8f0;
            margin-bottom: 8px;
            font-weight: 500;
        }

        input,
        select {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input::placeholder {
            color: #94a3b8;
        }

        /* Focus Effect - Black nahi hoga */
        input:focus,
        select:focus {
            outline: none;
            border-color: #60a5fa;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
        }

        .top-btn {
            position: absolute;
            right: 1px;
            top: 1px;
        }

        .btn-add {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-add:hover {
            background: #2563eb;
            transform: translateY(-2px);
        }

        .btn-remove {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-remove:hover {
            background: #dc2626;
        }

        .submit-area {
            text-align: right;
            margin-top: 40px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #16a34a, #22c55e);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(22, 163, 74, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(22, 163, 74, 0.5);
        }

        /* ====================== ERROR MESSAGES ====================== */

        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 6px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
            animation: fadeIn 0.3s ease;
        }

        .error-message::before {
            content: "⚠";
            font-size: 1rem;
        }

        .error-input {
            border-color: #ef4444 !important;
            background: rgba(248, 113, 113, 0.1) !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Laravel Validation Errors */
        .invalid-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        /* For dynamic error display */
        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .success-box {
            max-width: 580px;
            padding: 28px 40px;
            bottom: 100px;
            border-radius: 16px;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.4);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            animation: popIn 0.5s ease;
        }

        .success-icon {
            font-size: 3.2rem;
            color: #10b981;
            margin-bottom: 8px;
        }

        .success-text {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 500;
            color: #10b981;
            line-height: 1.5;
        }

        /* Animation */
        @keyframes popIn {
            0% {
                transform: scale(0.7);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet"
        href="{{ asset('css/admin-project.css') }}">

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    @extends('admin.navbar')
    <div class="toolbar-container">
        @if($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form id="contactForm"
            enctype="multipart/form-data" method="POST" action="{{ route('contacts.store') }}">

            @csrf
            <div id="formContainer">

                <div class="employee-card">

                    <div class="top-btn">
                        <button type="button"
                            id="addMore"
                            class="btn-add">
                            + Add
                        </button>
                    </div>

                    <div class="row">

                        <div class="col">
                            <label>First Name</label>
                            <input type="text" name="first_name[]">
                            <span class="error first_name_error"></span>
                        </div>

                        <div class="col">
                            <label>Last Name</label>
                            <input type="text" name="last_name[]">
                            <span class="error last_name_error"></span>
                        </div>

                        <div class="col">
                            <label>Designation</label>
                            <input type="text" name="designation[]">
                            <span class="error designation_error"></span>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col">
                            <label>Email</label>
                            <input type="email" name="email[]">
                            <span class="error email_error"></span>
                        </div>

                        <div class="col">
                            <label>Phone</label>
                            <input type="text" name="phone[]">
                            <span class="error phone_error"></span>
                        </div>

                        <div class="col">
                            <label>Image</label>
                            <div class="custom-file-upload">
                                <input type="file" name="image[]">
                                <span class="error image_error"></span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="submit-area">
                <button class="btn-submit" type="submit">
                    Submit
                </button>
            </div>

        </form>

    </div>
    <div id="success-message" style="display:none"
        class="alert alert-success text-center mx-auto success-box">
        <i class="fa-solid fa-circle-check success-icon"></i>
        <p class="success-text">htrjhyjytju</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // form ke data ko controller tak bhejne ke liye ajax 
        $("#contactForm").submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $(".error").html("");
            $.ajax({
                url: "{{ route('contacts.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#contactForm")[0].reset();
                    // Agar sirf pehla form rakhna ho
                    $(".employee-card:not(:first)").remove();
                    if (response.status) {
                        console.log(response.message);
                        $("#success-message .success-text").text(response.message);
                        $("#success-message").fadeIn();
                        setTimeout(function() {
                            $("#success-message").fadeOut();
                        }, 2500);
                    }

                },
                error: function(xhr) {
                    if (xhr.status === 422 || xhr.status === 500) {
                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {
                            if (key === "image") {

                                $(".image_error").html(value[0]);

                            } else {
                                let field = key.split(".");
                                let name = field[0];
                                let index = field[1];
                                $("[name='" + name + "[]']").eq(index).next(".error").html(value[0]);
                            }
                        });
                    }
                }
            });
        });
        // Aadd  more card ko duplicate karne ke liye template

        let template = `
                <div class="employee-card">

                <div class="top-btn">

                <button type="button" class="btn-remove" id ="removeCard">
                Remove
                </button>

                </div>

                <div class="row">

                <div class="col">
                <label>First Name</label>
                <input type="text" name="first_name[]">
                 <span class="error first_name_error"></span>
                </div>

                <div class="col">
                <label>Last Name</label>
                <input type="text" name="last_name[]">
                <span class="error last_name_error"></span>
                
                </div>

                <div class="col">
                <label>Designation</label>
                <input type="text" name="designation[]">
                <span class="error designation_error"></span>
                </div>

                </div>

                <div class="row">

                <div class="col">
                <label>Email</label>
                <input type="email" name="email[]">
                <span class="error email_error"></span>
                </div>

                <div class="col">
                <label>Phone</label>
                <input type="text" name="phone[]"
                    >
                    <span class="error phone_error"></span>
                </div>

                <div class="col">
                <label>Image</label>
                <input type="file" name="image[]">
                <span class="error image_error"></span>
                </div>

                </div>

                </div>
                `;

        $("#addMore").click(function() {
            $('.employee-card:last').after(template);

        });
        $(document).on('click', '.btn-remove', function() {
            $(this).closest('.employee-card').remove();
        });
    </script>

</body>

</html>