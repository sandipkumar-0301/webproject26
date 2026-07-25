<?php
    include('commonFiles/header.php');
?>

<!-- Subscribe Newsletter + Contact combined section (similar to original layout) -->
<section id="contact" class="py-5">
    <div class="container">
        <h1 class="text-center">Contact</h1>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6 pe-md-5">
                <p>We welcome you to connect with <strong>Saifi Trust & Associates</strong> for expert guidance on your intellectual property needs.</p>
                <p>Our team is ready to provide personalised, strategic counsel to protect and enhance your innovations and creative assets. Whether you have a question, require consultation, or want to explore collaboration, please reach out to us.</p>
                <p><b>Office Address:</b><br/>XXXXX, House No XXX, XXXXXXX, Sector-16, Greater Noida-201009</p>
                <p><strong>Phone:</strong><br/>+91 96507 32435</p>
                <p><strong>Email:</strong><br/>support@saifitrustandassociates.com</p>
                <p><strong>Business Hours:</strong><br/>Monday – Friday: 9:00 AM – 6:00 PM</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name*</label>
                    <input type="text" class="form-control" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address*</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
                
            </div>
        </div>
    </div>
</section>

<?php
    include('commonFiles/footer.php');
?>