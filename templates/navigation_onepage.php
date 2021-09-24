<?php
$dao = rex_sql::factory();

$pathToOnepageArticle = '/';
$artId = rex_article::getCurrent()->getValue('art_onepage_main');

if (!isset($artId) || empty($artId)) {
    $artId = rex_article::getCurrent()->getId();
}
$pathToOnepageArticle = rex_getUrl($artId);

$dao->setQuery("SELECT * FROM rex_article WHERE parent_id = 0 AND id = " . $artId . ". OR parent_id = " . $artId);
$result = $dao->getDBArray();
$navigation = '';

$navigation .= '<ul class="navbar-nav ml-auto">';
foreach ($result as $key => $value) {
    $art = rex_article::get($value['id']);
    $name = 'artikel';
    if ($art !== null) {
        $name = str_replace(' ', '-', $art->getName());
    }
    $navigation .=  '<li class="nav-item">
                        <a id="nav-' . $name . '-' . $value['id'] . '" class="nav-link" href="' . $pathToOnepageArticle . '#' . $name . '-' . $value['id'] . '">' . $value['name'] . '</a>
                    </li>';
}
$navigation .=  '</ul>';

?>
<div class="fixed-top my-navbar">
    <nav class="navbar navbar-expand-lg navbar-expand-md navbar-expand-sm">
        <div class="container">
            <a href="/">
                <div id="header-logo"></div>
            </a>
            <button class="navbar-toggler first-button" type="button" data-toggle="collapse" data-target="#mobil-nav" aria-controls="mobil-nav" aria-expanded="false" aria-label="Toggle navigation">
                <div class="animated-icon1"><span></span><span></span><span></span></div>
            </button>

            <div class="collapse navbar-collapse" id="mobil-nav">
                <?php
                echo $navigation;
                ?>
            </div>
        </div>
    </nav>
</div>