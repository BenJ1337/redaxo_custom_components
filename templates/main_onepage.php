<?php
include("base.php");
// All slices of one article
$dao = rex_sql::factory();

$dao->setQuery("SELECT * FROM rex_article WHERE parent_id = 0 AND id = " . rex_article::getCurrent()->getId() . ". OR parent_id = " . rex_article::getCurrent()->getId());
$result = $dao->getDBArray();
$content = '';
foreach ($result as $key => $value) {
    $arr = rex_article_slice::getSlicesForArticle($value['id']);

    $art = rex_article::get($value['id']);
    $name = 'artikel';
    if ($art !== null) {
        $name = str_replace(' ', '-', $art->getName());
    }

    $content .= '<div id="' . $name . '-' . $value['id'] . '" class="content-section">';
    $content .= ContentBuilder::buildContent($arr);
    $content .= '</div>';
}

?>

<!DOCTYPE html>
<html lang="de">

<head>
    <?php include("header.php"); ?>
</head>

<body class="frontend">
    <?php include("navigation_onepage.php"); ?>
    <main>
        <?php
        echo $content;
        ?>
    </main>
    <?php include("footer.php"); ?>
    <?php include("footer_scripts.php"); ?>
</body>

</html>