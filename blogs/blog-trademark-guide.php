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
            <img class="blog-inner" src="<?php echo $basePath; ?>assets/images/trademark-guide.png" alt="Trademark Guide">
        </div>
        <div class="blog-content">
            <h1>Protecting Your Brand: A Simple Guide to Trademarks</h1>
            <p>When you're building a business, your brand is one of your most valuable assets. But how do you legally protect a name, logo, or slogan so that others can't use it? That's where trademarks come in.</p>
            <p>A trademark is a symbol, word, or phrase that identifies and distinguishes your goods or services from those of other businesses. It helps consumers recognize your brand, like the Nike "swoosh" or the golden arches of McDonald's.</p>
            <h3>Key things to know about trademarks</h3>
            <ul>
                <li><strong>What it Protects:</strong> Brand names, logos, slogans, and other identifiers.</li>
                <li><strong>How Long it Lasts:</strong> A trademark can potentially last indefinitely as long as it's actively used and renewed periodically.</li>
                <li><strong>Why it Matters:</strong> Registering a trademark gives you stronger control over your brand and can prevent costly confusion in the marketplace. It's a key part of a smart business strategy.</li>
            </ul>
            <a href="<?php echo $basePath; ?>blog" class="btn btn-accent mt-3">Back to Blogs</a>
        </div>
    </div>
</section>

<?php
    include('../commonFiles/footer.php');
?>