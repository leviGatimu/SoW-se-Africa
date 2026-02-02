<?php include 'includes/header.php'; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    :root {
        --primary: #0f172a;
        --accent: #f59e0b;
        --accent-hover: #d97706;
        --bg-light: #f8fafc;
        --border: #e2e8f0;
    }

    body { background-color: var(--bg-light); font-family: 'Inter', sans-serif; }

    /* 1. HERO SECTION */
    .donate-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #1e293b 100%);
        color: white;
        padding: 80px 0 150px; /* Extra padding for overlap */
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .donate-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url('https://www.sowiseafrica.org/wp-content/uploads/2021/11/SoWse-Coaching.jpg');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        mix-blend-mode: overlay;
    }

    .hero-badge {
        background: rgba(245, 158, 11, 0.2);
        color: var(--accent);
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 2px;
        display: inline-block;
        margin-bottom: 20px;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    /* 2. DONATION CARD (Floating) */
    .donation-container {
        max-width: 1000px;
        margin: -100px auto 60px; /* Negative margin to pull up */
        position: relative;
        z-index: 10;
        padding: 0 20px;
    }

    .donation-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        display: flex;
        overflow: hidden;
    }

    /* Left Side: Impact */
    .impact-side {
        flex: 1;
        background: #f1f5f9;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .impact-list {
        list-style: none;
        padding: 0;
        margin: 30px 0;
    }

    .impact-list li {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        font-size: 1.05rem;
        color: #475569;
    }

    .impact-icon {
        width: 40px; height: 40px;
        background: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        flex-shrink: 0;
    }

    /* Right Side: Form */
    .form-side {
        flex: 1.2;
        padding: 50px;
        background: white;
    }

    .amount-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .amount-radio { display: none; }
    
    .amount-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 15px;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-weight: 700;
        color: #64748b;
        cursor: pointer;
        transition: 0.2s;
    }

    .amount-radio:checked + .amount-label {
        border-color: var(--accent);
        background: #fffbeb;
        color: var(--accent);
    }

    .custom-amount {
        width: 100%;
        padding: 15px;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        margin-bottom: 25px;
        transition: 0.3s;
    }
    .custom-amount:focus { outline: none; border-color: var(--accent); }

    .btn-donate-lg {
        width: 100%;
        padding: 18px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 1.1rem;
        font-weight: 800;
        cursor: pointer;
        transition: 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .btn-donate-lg:hover { background: var(--accent-hover); transform: translateY(-2px); }

    /* 3. BANK DETAILS SECTION */
    .bank-section {
        max-width: 900px;
        margin: 60px auto 100px;
        padding: 0 20px;
    }

    .bank-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }

    .bank-header {
        background: #f8fafc;
        padding: 20px 30px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .bank-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        padding: 30px;
    }

    .bank-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .bank-item div {
        font-size: 1rem;
        color: var(--primary);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .copy-btn {
        background: none; border: none; color: var(--accent); cursor: pointer; font-size: 0.9rem;
    }
    .copy-btn:hover { color: var(--accent-hover); }

    /* Responsive */
    @media (max-width: 900px) {
        .donation-card { flex-direction: column; }
        .impact-side, .form-side { padding: 30px; }
    }
</style>

<main>

    <section class="donate-hero">
        <div class="content-container">
            <span class="hero-badge" style="margin-top: 80px;">Make a Difference</span>
            <h1 style="font-size: 3rem; font-weight: 800; margin-bottom: 15px;">Invest in Future Leaders</h1>
            <p style="font-size: 1.2rem; color: #cbd5e1; max-width: 600px; margin: 0 auto;">
                Your contribution equips African youth with the values, skills, and mentorship they need to transform their communities.
            </p>
        </div>
    </section>

    <div class="donation-container">
        <div class="donation-card reveal-up">
            
            <div class="impact-side">
                <h3 style="font-size: 1.8rem; font-weight: 800; color: var(--primary); margin-bottom: 10px;">Why Donate?</h3>
                <p style="line-height: 1.6; color: #64748b;">
                    So W!SE AFRICA is a non-profit dedicated to values-based leadership. Your donation goes directly to:
                </p>
                <ul class="impact-list">
                    <li>
                        <div class="impact-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                        <span>Sponsoring leadership training materials.</span>
                    </li>
                    <li>
                        <div class="impact-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <span>Facilitating mentorship workshops.</span>
                    </li>
                    <li>
                        <div class="impact-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <span>Community outreach programs.</span>
                    </li>
                </ul>
                <div style="margin-top: auto; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                    <small style="color: #94a3b8;"><i class="fa-solid fa-lock"></i> Secure Payment · Tax Deductible</small>
                </div>
            </div>

            <div class="form-side">
                <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--primary); margin-bottom: 20px;">Select Amount</h3>
                
                <form action="payment_gateway_placeholder.php" method="POST">
                    
                    <div class="amount-grid">
                        <input type="radio" name="amount" value="25" id="amt-25" class="amount-radio">
                        <label for="amt-25" class="amount-label">$25</label>

                        <input type="radio" name="amount" value="50" id="amt-50" class="amount-radio" checked>
                        <label for="amt-50" class="amount-label">$50</label>

                        <input type="radio" name="amount" value="100" id="amt-100" class="amount-radio">
                        <label for="amt-100" class="amount-label">$100</label>
                    </div>

                    <input type="number" name="custom_amount" placeholder="Other Amount (USD)" class="custom-amount">

                    <button type="button" class="btn-donate-lg" onclick="alert('This feature requires a Payment Gateway (Stripe/Flutterwave) integration. Please use Bank Transfer for now.')">
                        <i class="fa-regular fa-credit-card"></i> Donate Securely
                    </button>

                    <div style="text-align: center; margin-top: 20px; display: flex; justify-content: center; gap: 15px; color: #94a3b8; font-size: 1.5rem;">
                        <i class="fa-brands fa-cc-visa"></i>
                        <i class="fa-brands fa-cc-mastercard"></i>
                        <i class="fa-brands fa-google-pay"></i>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <section class="bank-section reveal-up">
        <div style="text-align: center; margin-bottom: 30px;">
            <span style="color: var(--accent); font-weight: 700; letter-spacing: 1px;">OFFLINE DONATION</span>
            <h2 style="font-size: 2rem; color: var(--primary); font-weight: 800;">Bank Transfer Details</h2>
            <p style="color: #64748b;">Prefer a direct transfer? Use the details below.</p>
        </div>

        <div class="bank-card">
            <div class="bank-header">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/36/Equity_Bank_Logo.png" alt="Equity Bank" style="height: 40px;">
                    <div>
                        <h4 style="margin: 0; color: var(--primary);">Equity Bank Rwanda</h4>
                        <small style="color: #64748b;">Kigali Head Office Branch</small>
                    </div>
                </div>
            </div>
            
            <div class="bank-grid">
                
                <div class="bank-item">
                    <label>Account Name</label>
                    <div>SOWISE AFRICA <button class="copy-btn" onclick="copyText('SOWISE AFRICA')"><i class="fa-regular fa-copy"></i></button></div>
                </div>

                <div class="bank-item">
                    <label>USD Account Number</label>
                    <div>4002200755385 <button class="copy-btn" onclick="copyText('4002200755385')"><i class="fa-regular fa-copy"></i></button></div>
                </div>

                <div class="bank-item">
                    <label>RWF Account Number</label>
                    <div>4002200755376 <button class="copy-btn" onclick="copyText('4002200755376')"><i class="fa-regular fa-copy"></i></button></div>
                </div>

                <div class="bank-item">
                    <label>Swift Code</label>
                    <div>EQBLRWRW</div>
                </div>

            </div>
            
            <div style="background: #fffbeb; padding: 15px 30px; font-size: 0.9rem; color: #92400e; border-top: 1px solid #fcd34d;">
                <strong><i class="fa-solid fa-circle-info"></i> Note:</strong> Please email proof of payment to <u>info@sowiseafrica.org</u> so we can acknowledge your gift.
            </div>
        </div>
    </section>

</main>

<script>
    function copyText(text) {
        navigator.clipboard.writeText(text);
        alert("Copied: " + text);
    }
</script>

<?php include 'includes/footer.php'; ?>