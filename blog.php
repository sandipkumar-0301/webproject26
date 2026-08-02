<?php
    include('commonFiles/header.php');
?>

<section class="blog-section">
    <div class="container">
        <h1 class="text-center">Legal Blogs & Insights</h1>
        <div class="row">
            <div class="col-12">
                <div class="ipr-and-family-law-blogs text-center">
                    <ul class="nav nav-pills justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#ipr-blogs">IPR Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#family-law-blogs">Family Law Blog</a>
                        </li>
                    </ul>
                </div>                
            </div>            
        </div>

        <p class="text-center mb-5">Practical guidance on family law, divorce, maintenance, child custody, domestic violence, and property disputes.</p>

        <!-- TAB CONTENT - FIXED FOR BOOTSTRAP 4 -->
        <div class="tab-content">
            <!-- IPR BLOGS TAB - ACTIVE BY DEFAULT -->
            <div id="ipr-blogs" class="tab-pane fade show active">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/trademark-guide.png" class="card-img-top" alt="Trademark Guide">
                            <div class="card-body">
                                <h3 class="card-title">Protecting Your Brand: A Guide to Trademarks</h3>
                                <p class="card-text">Learn how trademarks protect your brand name, logo, and identity. A simple guide for entrepreneurs and business owners.</p>
                                <a href="blogs/blog-trademark-guide.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/copyright-protection.png" class="card-img-top" alt="Copyright Protection">
                            <div class="card-body">
                                <h3 class="card-title">How Copyright Protects Your Creative Work</h3>
                                <p class="card-text">Understand copyright protection for writers, artists, musicians, and bloggers. Learn about fair use and owner rights.</p>
                                <a href="blogs/blog-copyright-protection.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/patent-protection.png" class="card-img-top" alt="Patent Protection">
                            <div class="card-body">
                                <h3 class="card-title">Patents: Protecting Your Inventions</h3>
                                <p class="card-text">A guide to patents for innovators and startups. Learn what can be patented and the filing process.</p>
                                <a href="blogs/blog-patent-protection.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/blogger-ip-infringement.png" class="card-img-top" alt="Blogger IP Infringement">
                            <div class="card-body">
                                <h3 class="card-title">Avoiding Infringement as a Blogger</h3>
                                <p class="card-text">Essential copyright tips for bloggers. Learn how to protect your own work and avoid using others' work without permission.</p>
                                <a href="blogs/blog-blogger-ip-infringement.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAMILY LAW BLOGS TAB -->
            <div id="family-law-blogs" class="tab-pane fade">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/live-in-relation.webp" class="card-img-top" alt="Live-in relationship">
                            <div class="card-body">
                                <h3 class="card-title">Live-In Relationship & Legal Rights</h3>
                                <p class="card-text">Learn how courts view cohabitation, maintenance claims, domestic violence protection, and the rights of children in a live-in setup.</p>
                                <a href="blogs/blog-live-in-relationship.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/divorce.webp" class="card-img-top" alt="Divorce">
                            <div class="card-body">
                                <h3 class="card-title">Divorce Procedure & Important Considerations</h3>
                                <p class="card-text">Understand the legal steps, timelines, and practical issues that arise before filing a divorce petition.</p>
                                <a href="blogs/blog-divorce-procedure.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/child-custody.webp" class="card-img-top" alt="Child custody">
                            <div class="card-body">
                                <h3 class="card-title">Child Custody & Parenting Plans</h3>
                                <p class="card-text">Find out how courts decide custody, parenting time, and the best interests of the child after separation.</p>
                                <a href="blogs/blog-child-custody.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/maintainence.webp" class="card-img-top" alt="Spousal maintenance">
                            <div class="card-body">
                                <h3 class="card-title">Spousal Maintenance & Financial Support</h3>
                                <p class="card-text">A practical overview of alimony, interim support, and how maintenance claims are assessed in family court.</p>
                                <a href="blogs/blog-spousal-maintenance.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/domestic-violence.webp" class="card-img-top" alt="Domestic violence">
                            <div class="card-body">
                                <h3 class="card-title">Domestic Violence Protection Orders</h3>
                                <p class="card-text">Learn about legal remedies, emergency protection, residence rights, and the importance of urgent legal help.</p>
                                <a href="blogs/blog-domestic-violence.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 blog-card">
                            <img src="assets/images/property-disputes.png" class="card-img-top" alt="Property disputes">
                            <div class="card-body">
                                <h3 class="card-title">Property Disputes After Separation</h3>
                                <p class="card-text">An overview of how marital assets, shared property, and financial contributions are handled in dispute resolution.</p>
                                <a href="blogs/blog-property-disputes.php" class="btn btn-accent">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap 4 JS (already included, but keep as is) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<?php
    include('commonFiles/footer.php');
?>