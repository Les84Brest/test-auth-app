<?php

/** @var $title */
/** @var $isLogined */
/** @var $userName */
/** @var $content */

?>

<!DOCTYPE html>
<html lang="ru-RU">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/css/style.min.css">
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="header__container">
                <div class="header__logo logo-ibg">
                    <img src="./img/some-logo.svg" alt="Логотип сайта">
                </div>
                <div class="header__menu">
                    <nav>
                        <ul class="header__menu menu-header">
                            <li class="menu-header__item">
                                <a class="menu-header__link" href="/">Главная</a>
                            </li>
                            <li class="menu-header__item">
                                <a class="menu-header__link" href="/about">О нас</a>
                            </li>
                            <li class="menu-header__item">
                                <a class="menu-header__link" href="/blog">Блог</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="header-auth auth-header">
                        <?php if ($isLogined) :  ?>
                            <i class="_icon-user"></i> Hello, <span class="auth-header__greating"><?= $userName ?></span>
                            <button class="btn primary" data-button-type="signOut">Выйти</button>
                        <?php else : ?>
                            <a href="/login" class="btn primary">Войти</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
            <?= $content ?>
        <footer class="footer">
            <div class="footer__body">Тестовое задание Семенюк Алексей Николаевич &copy; 2024</div>
        </footer>
    </div>
    <script src="./js/app.js"></script>
</body>

</html>