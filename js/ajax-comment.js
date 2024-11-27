jQuery(document).ready(function($) {
    // استبدال نص الرابط بأيقونة
    $('a.comment-edit-link').each(function() {
        var icon = '<i class="fas fa-edit"></i>'; // استخدم Font Awesome أو أي أيقونة تفضلها
        $(this).html(icon); // استبدال محتوى الرابط بالأيقونة
    });
});






jQuery(document).ready(function($) {
    $('.tj-post-comment__form').on('submit', function(e) {
        e.preventDefault(); // منع إعادة تحميل الصفحة عند إرسال النموذج

        // الحصول على البيانات من الحقول
        var formData = $(this).serialize();

        // إرسال البيانات باستخدام Ajax إلى admin-ajax.php
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url, // استخدام URL الذي تم تمريره من PHP
            data: {
                action: 'submit_contact_form', // اسم العملية AJAX
                form_data: formData
            },
            success: function(response) {
                if (response.success) {
                    $('#form-message').html('<p style="color:green;">Your message has been sent successfully!</p>').show();
                    $('.tj-post-comment__form')[0].reset(); // مسح الحقول بعد الإرسال
                } else {
                    $('#form-message').html('<p style="color:red;">There was an error sending your message. Please try again.</p>').show();
                }
            },
            error: function() {
                $('#form-message').html('<p style="color:red;">There was an error sending your message. Please try again.</p>').show();
            }
        });
    });
});
