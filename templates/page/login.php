<?php
/** @var  $errorMessages */
/** @var $oldData */
/** @var $renderHelper */
?>

<main class="main">

    <section class="section login">
        <div class="login-content__container">
            <h1 class="main-header">Войти / зарегистрироваться</h1>
            <div class="login__body">
                <div class="login__item">
                    <h2 class="login__form-title">Войти</h2>
                    <form class="login__form form-login" name="login_form">
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-login">
                                    Логин <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-login" class="form-input" type="text" name="login" placeholder="Введите логин" <?= $renderHelper->renderOldData('login', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('login', $errorMessages) ?>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-password">
                                    Пароль <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-password" class="form-input" type="password" name="password" placeholder="Введите пароль" <?= $renderHelper->renderOldData('password', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('password', $errorMessages) ?>
                        </div>
                        <div class="input-block">

                            <input type="submit" name="login-submit-btn" class="btn primary" value="Войти">

                        </div>
                    </form>
                </div>
                <div class="login__item">
                    <h2 class="login__form-title">Зарегистрироваться</h2>
                    <form class="login__form form-register" name="registration_form">
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-login">
                                    Логин <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-login" class="form-input" type="text" name="registerLogin" placeholder="Введите логин" <?= $renderHelper->renderOldData('registerLogin', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('registerLogin', $errorMessages) ?>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-email">
                                    Email <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <!-- In case when input has email type it enables HTML5 validation -->
                                <input id="user-email" class="form-input" type="text" name="registerEmail" placeholder="Введите email" <?= $renderHelper->renderOldData('registerEmail', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('registerEmail', $errorMessages) ?>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-name">
                                    Имя <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-name" class="form-input" type="text" name="registerName" placeholder="Введите имя" <?= $renderHelper->renderOldData('registerName', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('registerName', $errorMessages) ?>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-password">
                                    Пароль <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-password" class="form-input" type="password" name="registerPassword" placeholder="Введите пароль" <?= $renderHelper->renderOldData('registerPassword', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('registerPassword', $errorMessages) ?>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-rep-password">
                                    Повтор пароля <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-rep-password" class="form-input" type="password" name="registerPasswordRepeat" placeholder="Повторите пароль" <?= $renderHelper->renderOldData('registerPasswordRepeat', $oldData) ?>>
                            </div>
                            <?= $renderHelper->renderErrorMessage('registerPasswordRepeat', $errorMessages) ?>
                        </div>
                        <div class="input-block submit">
                            <input type="submit" name="register-submit-button" class="btn primary" value="Регистрация">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>