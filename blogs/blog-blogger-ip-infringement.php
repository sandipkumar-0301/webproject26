<?php
    include('../commonFiles/header.php');
?>

<?php
$reqPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
$segments = array_values(array_filter(explode('/', $reqPath), 'strlen'));
if (!empty($segments) && $segments[0] === 'mysite') {
    array_shift($segments);
}
$depth = count($segments) > 1 ? count($segments) - 1 : 0;
$basePath = $depth > 0 ? str_repeat('../', $depth) : '';
?>

<section class="blog-section">
    <div class="container">
        <div class="blog-banner">
            <img class="blog-inner" src="<?php echo $basePath; ?>assets/images/blogger-ip-infringement.png" alt="Blogger IP Infringement">
        </div>
        <div class="blog-content">
            <h1>How to Avoid Infringement When You're a Blogger</h1>
            <p>Running a blog is a great way to share your expertise, but it also comes with legal responsibilities, especially when it comes to intellectual property. Using someone else's work without permission can land you in hot water.</p>
            <h3>What You Need to Know</h3>
            <p>The most important area of IP law for bloggers is copyright. Here are some key points to keep in mind:</p>
            <ul>
                <li><strong>Your Own Work:</strong> Your blog posts are your copyright the moment you write them. You can also consider using a Creative Commons license if you want to allow others to use your work in specific ways.</li>
                <li><strong>Using Others' Work:</strong> When quoting or using someone else's work, your use is limited by the concept of "fair use."</li>
                <li><strong>Best Practices:</strong> A quick Google search or a search in databases like the U.S. Copyright Office can help determine if a work is protected. The best practice is to "take caution, slow down and don't forget your due diligence."</li>
            </ul>
            <a href="<?php echo $basePath; ?>blog" class="btn btn-accent mt-3">Back to Blogs</a>
        </div>
    </div>
</section>

<?php
    include('../commonFiles/footer.php');
?>