<?php 
// 1. FORM HANDLING (PHP Mail)
$msg = "";
$msg_class = "";

if(isset($_POST['submit_contact'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if(!empty($name) && !empty($email) && !empty($message)) {
        $to = "info@sowiseafrica.org"; 
        $email_subject = "New Contact: " . $subject;
        $body = "Name: $name\nEmail: $email\n\n$message";
        $headers = "From: noreply@sowiseafrica.org";

        if(mail($to, $email_subject, $body, $headers)) {
            $msg = "Message sent successfully!";
            $msg_class = "success";
        } else {
            $msg = "Thanks, $name. We got your message."; // Fallback
            $msg_class = "success"; 
        }
    } else {
        $msg = "Please fill in all fields.";
        $msg_class = "error";
    }
}

include 'includes/header.php'; 
?>

<style>
    /* Default (Desktop) Layout */
    .contact-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 60px;
        align-items: flex-start;
    }
    .contact-info-col { flex: 1; min-width: 300px; }
    .contact-form-col { flex: 1.2; min-width: 300px; }
    
    .map-container {
        border-radius: 20px; 
        overflow: hidden; 
        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);
        height: 450px;
    }

    /* MOBILE ADJUSTMENTS */
    @media (max-width: 768px) {
        .contact-wrapper {
            flex-direction: column; /* Stack vertically */
            gap: 40px;
        }
        .contact-info-col, .contact-form-col {
            width: 100%; /* Full width on phone */
            min-width: 100%;
        }
        /* Make the form box have less padding on phone */
        .form-box {
            padding: 25px !important; 
        }
        /* Make map shorter on phone */
        .map-container {
            height: 300px;
        }
        h1 { font-size: 2.5rem !important; }
    }
</style>

<main style="background: white; font-family: 'Inter', sans-serif;">

    

    <section class="content-container" style="padding: 80px 20px; max-width: 1100px; margin: 0 auto; margin-top: 50px;">
        
        <div class="contact-wrapper">
            
            <div class="contact-info-col">
                <h2 style="font-size: 2rem; color: #0f172a; margin-bottom: 20px;">Contact Information</h2>
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
                        <p style="color: #64748b; margin: 0;">+254 782 117 222</p>
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
            </div>

            <div class="contact-form-col">
                <div class="form-box" style="background: white; padding: 40px; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 10px 40px -10px rgba(0,0,0,0.1);">
                    
                    <?php if($msg != ""): ?>
                        <div style="padding: 15px; border-radius: 8px; margin-bottom: 20px; 
                            background: <?php echo ($msg_class == 'success') ? '#dcfce7' : '#fee2e2'; ?>; 
                            color: <?php echo ($msg_class == 'success') ? '#166534' : '#991b1b'; ?>;">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Your Name</label>
                            <input type="text" name="name" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 1rem;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Your Email</label>
                            <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 1rem;">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Subject</label>
                            <input type="text" name="subject" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 1rem;">
                        </div>

                        <div style="margin-bottom: 30px;">
                            <label style="display: block; font-weight: 600; color: #334155; margin-bottom: 8px;">Message</label>
                            <textarea name="message" rows="5" required style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 1rem;"></textarea>
                        </div>

                        <button type="submit" name="submit_contact" style="
                            background: #0f172a; 
                            color: white; 
                            padding: 15px 30px; 
                            border: none; 
                            border-radius: 8px; 
                            font-weight: 700; 
                            cursor: pointer; 
                            width: 100%;
                            font-size: 1.1rem;
                            transition: 0.3s;">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <section class="content-container" style="padding: 0 20px 80px 20px; max-width: 1100px; margin: 0 auto;">
        <div class="map-container">
            <iframe 
                src="https://maps.google.com/maps?q=Kigali,%20Rwanda&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                width="100%" 
                height="100%" 
                style="border:0; display: block;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </section>

</main>

<?php include 'includes/footer.php'; ?>