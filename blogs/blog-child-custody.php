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
            <img class="blog-inner" src="<?php echo $basePath; ?>assets/images/child-custody.webp" alt="Child Custody">
        </div>
        <div class="blog-content">
            <h1>Child Custody & Parenting Plans</h1>
            <p>Child custody disputes are often among the most sensitive issues in divorce or separation. Courts focus on the best interests of the child rather than simply the wishes of either parent.</p>
            <h3>Why parenting plans matter</h3>
            <p>A parenting plan helps parents agree on daily care, schooling, healthcare, travel, and visitation schedules. In many cases, a clear written arrangement can avoid future conflict and reduce stress for the child.</p>
            <ul>
                <li>Schedules should be realistic and child-focused.</li>
                <li>Parents should address communication and decision-making.</li>
                <li>Courts may review plans for fairness and stability.</li>
            </ul>
            <a href="<?php echo $basePath; ?>blog.php" class="btn btn-accent mt-3">Back to Blogs</a>
        </div>
    </div>
</section>

<?php
    include('../commonFiles/footer.php');
?>