<?php require_once __DIR__ . '/' . '../base/header.php'; ?>

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
                                <input id="user-login" class="form-input" type="text" name="login" placeholder="Введите логин">
                            </div>
                            <span class="input-block__error">Неверный логин</span>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-password">
                                    Пароль <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-password" class="form-input" type="password" name="password" placeholder="Введите пароль">
                            </div>
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
                                <input id="user-login" class="form-input" type="text" name="login" placeholder="Введите логин">
                            </div>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-email">
                                    Email <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <!-- In case when input has email type it enables HTML5 validation -->
                                <input id="user-email" class="form-input" type="text" name="email" placeholder="Введите email">
                            </div>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-name">
                                    Имя <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-name" class="form-input" type="text" name="name" placeholder="Введите имя">
                            </div>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-password">
                                    Пароль <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-password" class="form-input" type="password" name="password" placeholder="Введите пароль">
                            </div>
                        </div>
                        <div class="input-block">
                            <div class="input-block__label">
                                <label for="user-rep-password">
                                    Повтор пароля <span class="req">*</span>
                                </label>
                            </div>
                            <div class="input-block__input">
                                <input id="user-rep-password" class="form-input" type="password" name="password-repeat" placeholder="Повторите пароль">
                            </div>
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

<?php require_once __DIR__ . '/' . '../base/footer.php'; ?>