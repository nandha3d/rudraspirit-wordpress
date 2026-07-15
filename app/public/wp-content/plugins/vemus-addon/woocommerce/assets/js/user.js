(function ($) {
    'use strict';
    var handleLogin = function () {
        $('#tfwc_custom_login_form').on('submit', function (e) {
            e.preventDefault();
            $('.tfwc-login-form').validate({
                errorElement: 'span',
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true
                    }
                },
                messages: {
                    username: "",
                    password: ""
                }
            });
            var form = $(this);
            var formData = form.serialize();
            var message = form.find('.tfwc-message');
            
            if (form.valid()) {                
                $.ajax({                    
                    type: 'POST',
                    url: user_script_variables.ajaxUrl,
                    data: formData + '&action=custom_login&security=' + user_script_variables.nonce,
                    beforeSend: function () {
                        message.empty().append('<span class="success text-success"> Loading </span>');
                    },
                    success: function (response) {
                        // Handle the registration success response
                        if (response.status) {
                            window.location.href = response.redirect_url;
                        } else {
                            message.empty().append('<span class="error text-danger"><i class="fa fa-close"></i> ' + response.message + '</span>');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle the registration error response
                        console.log(error);
                    }
                });
            }
        });
    }
    var handleRegister = function () {
        $('#tfwc_custom_register_form').on('submit', function (e) {
            e.preventDefault();
            $('.tfwc-registration-wrapper').validate({
                errorElement: "span",
                rules: {
                    username: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        pattern: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,10}$/
                    },
                    phone: {
                        required: true,
                        pattern: /^[0-9]{11}$/
                    },
                    password: {
                        required: true
                    },
                    // confirm_password: {
                    //     required: true
                    // }
                },
                messages: {
                    username: "",
                    email: "",
                    phone: "",
                    password: "",
                    // confirm_password: ""
                }
            });
            var form = $(this);
            var formData = form.serialize();
            var message = $(this).find('.tfwc-message');
            if (form.valid()) {
                $.ajax({
                    type: 'POST',
                    url: user_script_variables.ajaxUrl,
                    data: formData + '&action=custom_register&security=' + user_script_variables.nonce,
                    beforeSend: function () {
                        message.empty().append('<span class="success text-success"> Loading </span>');
                    },
                    success: function (response) {
                        // Handle the registration success response
                        if (response.status) {
                            message.empty().append('<span class="success text-success"><i class="fa fa-check"></i> ' + response.message + '</span>');

                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);

                        } else {
                            message.empty().append('<span class="error text-danger"><i class="fa fa-close"></i> ' + response.message + '</span>');
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle the registration error response
                        console.log(error);
                    }
                });
            }
        })
    }

    var handleResetPassword = function () {
        $('.tfwc_forgetpass').on('click', function (e) {
            e.preventDefault();
            var $form = $(this).parents('form');
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxUrl,
                dataType: 'json',
                data: $form.serialize(),
                beforeSend: function () {
                    $('.tfwc_messages_reset_password').empty().append('<span class="success text-success"> Loading </span>');
                },
                success: function (response) {
                    if (response.success) {
                        $('.tfwc_messages_reset_password').empty().append('<span class="success text-success"><i class="fa fa-check"></i> ' + response.message + '</span>');
                    } else {
                        $('.tfwc_messages_reset_password').empty().append('<span class="error text-danger"><i class="fa fa-close"></i> ' + response.message + '</span>');
                    }
                }
            });
        });
    }

    var setAccessTokenGoogle = function () {
        var urlParams = new URLSearchParams(window.location.search);
        var code = urlParams.get('code');
        if (code) {
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxUrl,
                dataType: 'json',
                data: {
                    'action': 'set_access_token_google',
                    'security': ajax_object.nonce,
                    'code': code
                },
                success: function (res) {
                    if (res.status) {
                        handleLoginGoogle();
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            })
        }
    }

    var handleLoginGoogle = function () {
        $.ajax({
            type: 'post',
            url: ajax_object.ajaxUrl,
            dataType: 'json',
            data: {
                'action': 'handle_google_login',
                'security': ajax_object.nonce,
            },
            success: function (res) {
                if (res.status) {
                    window.location.href = res.redirect_url;
                }
            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    var handleLoginFacebook = function () {
		$('.btn-login-fb').on('click', function (e) {			
			var urlParams = new URLSearchParams(window.location.search);
			var code = urlParams.get("code");
			console.log(code);
			$.ajax({
				type: "post",
				url: ajax_object.ajaxUrl,
				dataType: "json",
				data: {
					action: "handle_facebook_login",
					security: ajax_object.nonce,
					code: code,
				},
				success: function (res) {
					console.log(res);
					if (res.status) {
						// window.location.href = res.redirect_url;
					}
				},
				error: function (error) {
					console.log(error);
				},
			});
		});
	};

    /* Show Password 
    -------------------------------------------------------------------------*/
    var showPassword = function () {
        $(".toggle-pass").on("click", function () {
            const wrapper = $(this).closest(".password-wrapper");
            const input = wrapper.find(".password-field");
            const icon = $(this);

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("icon-show-password").addClass("icon-view");
            } else {
                input.attr("type", "password");
                icon.removeClass("icon-view").addClass("icon-show-password");
            }
        });
    };

    jQuery(document).ready(function () {
        handleLogin();        
        handleRegister();
        handleResetPassword();
        setAccessTokenGoogle();
        handleLoginFacebook();
        showPassword();
    })
})(jQuery);