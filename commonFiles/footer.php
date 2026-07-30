<?php
$reqPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
$segments = array_values(array_filter(explode('/', $reqPath), 'strlen'));
if (!empty($segments) && $segments[0] === 'mysite') {
    array_shift($segments);
}
$depth = count($segments) > 1 ? count($segments) - 1 : 0;
$basePath = $depth > 0 ? str_repeat('../', $depth) : '';
?>
<!-- footer with copyright -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4 class="fw-bold text-white">Saifi Trust & Associates</h4>
                <p><b>Saifi Trust & Associates</b> is a trusted law firm providing professional legal and consultancy services. We are committed to delivering practical, reliable, and client-focused legal solutions while protecting our clients' rights and interests with integrity and excellence.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h4 class="fw-bold text-white">Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="<?php echo $basePath; ?>index">Home</a></li>
                    <li><a href="<?php echo $basePath; ?>services/services.php">Services</a>
                        <ul class="list-unstyled" style="margin-left: 20px;">
                            <li><a href="<?php echo $basePath; ?>services/ipr.php">IPR</a></li>
                            <li><a href="<?php echo $basePath; ?>family-matters">Family Matters</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $basePath; ?>about">About</a></li>
                    <li><a href="<?php echo $basePath; ?>blog.php">Blog</a></li>
                    <li><a href="<?php echo $basePath; ?>our-team.php">Our Team</a></li>
                    <li><a href="<?php echo $basePath; ?>contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h4 class="fw-bold text-white">Reach Out</h4>
                <p class="small mb-1"><i class="fas fa-phone-alt me-2"></i> +91 96507 32435</p>
                <p class="small"><i class="fas fa-envelope me-2"></i> <a href="mailto:support@saifitrustandassociates.com">support@saifitrustandassociates.com</a></p>
                <p class="small"><i class="fas fa-map-pin me-2"></i> Greater Noida, UP – 201310</p>
            </div>
        </div>
        <hr class="bg-white-50 opacity-25">
        <div class="text-center small pt-2">
            ©2026 Saifi Trust & Associates. All rights reserved. | Legal Expertise with Compassion
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>