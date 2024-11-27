<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // التحقق من وجود القيم المطلوبة في النموذج
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // التحقق من أن الحقول ليست فارغة
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $to = "tofa.sasa84@gmail.com"; // استبدل هذا بالبريد الإلكتروني الذي ترغب في استقبال الرسائل عليه
        $email_subject = "New Contact Form Message: " . $subject;
        $email_message = "Name: " . $name . "\n\n";
        $email_message .= "Email: " . $email . "\n\n";
        $email_message .= "Message: \n" . $message . "\n";

        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');

        // إرسال البريد الإلكتروني
        if (wp_mail($to, $email_subject, $email_message, $headers)) {
            echo 'success';
        } else {
            echo 'error';
        }
    } else {
        echo 'error'; // إذا كانت الحقول فارغة أو غير صالحة
    }
} else {
    echo 'error'; // إذا كان الطلب غير صالح
}
?>
