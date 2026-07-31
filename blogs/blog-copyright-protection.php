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
            <img class="blog-inner" src="<?php echo $basePath; ?>assets/images/copyright-protection.png" alt="Copyright Protection">
        </div>
        <div class="blog-content">
            <h1>How Copyright Protects Your Creative Work</h1>
            <p>Copyright is a crucial protection for anyone who creates original work, whether you're a writer, artist, musician, or even a blogger. It's an automatic right that protects your creative expression.</p>
            <h3>What Copyright Covers</h3>
            <p>Copyright protects original works of authorship, including books, music, films, software code, and website content. As a blogger, you should know that your original blog posts are automatically protected by copyright the moment you write them.</p>
            <h3>Key things to know about copyright</h3>
            <ul>
                <li><strong>Rights of the Owner:</strong> The copyright owner has exclusive rights to copy, distribute, and create new works based on the original.</li>
                <li><strong>Duration:</strong> Protection typically lasts for the creator's lifetime plus 70 years.</li>
                <li><strong>Fair Use:</strong> There are limits to copyright, such as "fair use," which allows limited use of copyrighted material for purposes like criticism, comment, or news reporting. However, this is decided on a case-by-case basis.</li>
            </ul>
            <a href="<?php echo $basePath; ?>blog" class="btn btn-accent mt-3">Back to Blogs</a>
        </div>
    </div>
</section>

<?php
    include('../commonFiles/footer.php');
?>