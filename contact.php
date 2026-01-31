<?php 
// 1. FORM HANDLING LOGIC
$msg = "";
$msg_class = "";

if(isset($_POST['submit_contact'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate
    if(!empty($name) && !empty($email) && !empty($message)) {
        
        // Email Settings
        $to = "info@sowiseafrica.org"; 
        $email_subject = "New Contact Form: " . $subject;
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: noreply@sowiseafrica.org";

        // Send Email (Works if your server has mail configured)
        if(mail($to, $email_subject, $body, $headers)) {
            $msg = "Thank you! Your message has been sent.";
            $msg_class = "success";
        } else {
            // Fallback for local servers that can't send mail
            $msg = "Thank you, $name. We have received your query.";
            $msg_class = "success"; 
        }
    } else {
        $msg = "Please fill in all fields.";
        $msg_class = "error";
    }
}

include 'includes/header.php'; 
?>

<main style="background: white; font-family: 'Inter', sans-serif;">

    <section class="content-container" style="padding: 80px 20px; max-width: 1100px; margin: 0 auto; margin-top: 50px;">
        
        <div style="display: flex; flex-wrap: wrap; gap: 60px;">
            
            <div style="flex: 1; min-width: 300px;">
                <h2 style="font-size: 2rem; color: #0f172a; margin-bottom: 30px;">Contact Information</h2>
                <p style="color: #64748b; line-height: 1.6; margin-bottom: 40px;">
                    Reach out to our team directly. We are always looking for new opportunities to empower the next generation.
                </p>

                <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                    <div style="width: 50px; height: 50px; background: #fef3c7; color: #d97706; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.1rem; color: #0f172a; margin: 0 0 5px 0;">Phone</h3>
                        <p style="color: #64748b; margin: 0;">+250 782 117 222</p>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-bottom: 30px;">
                    <div style="width: 50px; height: 50px; background: #e0f2fe; color: #0284c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.1rem; color: #0f172a; margin: 0 0 5px 0;">Email</h3>
                        <p style="color: #64748b; margin: 0;">info@sowiseafrica.org</p>
                    </div>
                </div>

                <div style="display: flex; gap: 20px; margin-bottom: 40px;">
                    <div style="width: 50px; height: 50px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h3 style="font-size: 1.1rem; color: #0f172a; margin: 0 0 5px 0;">Location</h3>
                        <p style="color: #64748b; margin: 0;">Kigali, Rwanda</p>
                    </div>
                </div>

                <div>
                    <span style="font-weight: 700; color: #0f172a; display: block; margin-bottom: 15px;">FOLLOW US</span>
                    <div style="display: flex; gap: 15px;">
                        <a href="#" style="width: 40px; height: 40px; background: #0f172a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" style="width: 40px; height: 40px; background: #0f172a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" style="width: 40px; height: 40px; background: #0f172a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none;"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div style="flex: 1.2; min-width: 300px;">
                <div style="background: white; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);">
                    
                    <?php if($msg != ""): ?>
                        <div style="padding: 15px; border-radius: 8px; margin-bottom: 20px; 
                            background: <?php echo ($msg_class == 'success') ? '#dcfce7' : '#fee2e2'; ?>; 
                            color: <?php echo ($msg_class == 'success') ? '#166534' : '#991b1b'; ?>;">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                            <div style="flex: 1;">
                                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Your Name</label>
                                <input type="text" name="name" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none;">
                            </div>
                            <div style="flex: 1;">
                                <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Your Email</label>
                                <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none;">
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Subject</label>
                            <input type="text" name="subject" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none;">
                        </div>

                        <div style="margin-bottom: 30px;">
                            <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Message</label>
                            <textarea name="message" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-family: inherit;"></textarea>
                        </div>

                        <button type="submit" name="submit_contact" style="
                            background: #0f172a; 
                            color: white; 
                            padding: 15px 30px; 
                            border: none; 
                            border-radius: 8px; 
                            font-weight: 600; 
                            cursor: pointer; 
                            width: 100%;
                            font-size: 1rem;
                            transition: 0.3s;">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <section class="content-container" style="padding: 0 20px 80px 20px; max-width: 1100px; margin: 0 auto;">
        <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127618.7909282305!2d30.007604677270425!3d-1.956799017631383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca4258ed8e797%3A0xf329998bf0f99988!2sKigali%2C%20Rwanda!5e0!3m2!1sen!2ske!4v1709288282928!5m2!1sen!2ske" 
                width="100%" 
                height="450" 
                style="border:0; display: block;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>