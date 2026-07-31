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
            <img class="blog-inner" src="<?php echo $basePath; ?>assets/images/patent-protection.png" alt="Patent Protection">
        </div>
        <div class="blog-content">
            <h1>Patents: Protecting Your Inventions</h1>
            <p>If you've invented a new product or a novel way of doing something, a patent might be the right form of protection for you. Patents are designed to protect inventions and technical solutions.</p>
            <h3>What a Patent Protects</h3>
            <p>A patent grants exclusive rights to an inventor, preventing others from making, using, or selling their invention for a limited time, usually 20 years. To be patentable, an invention must be new, useful, and non-obvious.</p>
            <h3>Key things to know about patents</h3>
            <ul>
                <li><strong>Examples:</strong> This includes everything from the design of a new smartphone to a new pharmaceutical drug.</li>
                <li><strong>The Filing Process:</strong> Obtaining a patent requires a formal application process with a detailed description of the invention.</li>
                <li><strong>Who Should Consider This:</strong> Patents are especially important for tech-driven businesses and startups with new products or processes.</li>
            </ul>
            <a href="<?php echo $basePath; ?>blog" class="btn btn-accent mt-3">Back to Blogs</a>
        </div>
    </div>
</section>

<?php
    include('../commonFiles/footer.php');
?>