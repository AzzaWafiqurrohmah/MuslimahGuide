<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="/assetsLandingPage/img/logo.svg" type="image/x-icon">

    <!--=============== REMIX ICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="/assetsLandingPage/css/styles.css">

    <link href="/assetsWeb/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <title>zenfemina</title>
</head>
<body>
<!--==================== HEADER ====================-->
<header class="header" id="header">
    <nav class="nav container">
<!--        <a href="#" class="nav__logo">-->
<!--            <i class="nav__logo-icon"></i> zenfmina-->
<!--        </a>-->
        <a href="#" class="nav__logo">
            <img src="/assetsWeb/img/logo (1).png" style="width: 40px; height: 40px" alt="Logo Zenfemina" class="nav__logo-icon">
            zenfmina
        </a>


        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#home" class="nav__link active-link">Home</a>
                </li>
                <li class="nav__item">
                    <a href="#products" class="nav__link">App Features</a>
                </li>
                <li class="nav__item">
                    <a href="#faqs" class="nav__link">FAQs</a>
                </li>
                <li class="nav__item">
                    <a href="#contact" class="nav__link">Contact Us</a>
                </li>
                <li class=" getstarted" style="padding: 0.4rem 1rem">
                    <a href="/login" class="nav__link" style="color: white; font-size: 14px;">Sign In</a>
                </li>
<!--                <li class="nav__item">-->
<!--                    <a href="#contact" class="nav__link">Sign in</a>-->
<!--                </li>-->
            </ul>

            <div class="nav__close" id="nav-close">
                <i class="ri-close-line"></i>
            </div>
        </div>

        <div class="nav__btns">
            <!-- Theme change button -->
            <i class="ri-moon-line change-theme" id="theme-button"></i>

            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </nav>
</header>

<main class="main">
    <!--==================== HOME ====================-->
    <section class="home" id="home">
        <div class="home__container container grid">
            <img src="/assetsLandingPage/img/hijab2.png" alt="" class="home__img">

            <div class="home__data">
                <h1 class="home__title">
                    Track Your cycles,
                    <br>and manage prayers effortlessly
                </h1>
                <p class="home__description">
                    Elevate your well-being with our women's calendar app,
                    seamlessly integrating menstrual cycle tracking and qodho' prayer management,
                    providing a comprehensive approach to women's health and spirituality
                </p>
                <a href="https://github.com/khairunnisaalallah/zenFeminaMobile" target="_blank" class="button button--flex" style="padding: 0rem 1rem">
                    <i class="ri-github-fill" style="color: white; font-size: 32px;"></i>
                    GitHub
                </a>
            </div>

        </div>
    </section>

    <!--==================== PRODUCTS ====================-->
    <section class="product section container" id="products">
        <h2 class="section__title-center">
            APP Features
        </h2>

        <p class="product__description">
            Efficiently manage your menstrual cycle and
            schedule prayer replacements for Muslim women facing constraints.
            Stay informed and in control with our convenient and effective features.
        </p>

        <div class="product__container grid">
            <article class="product__card">
                <i class="bi bi-calendar-range calendar-icon" style="font-size: 4rem; color: #DA4256; text-align: center"></i> <!-- Menggunakan ikon Calendar Range dari Bootstrap -->
                <h3 class="product__title" style="text-align: center">Tracking cycle</h3>
            </article>

            <article class="product__card">
                <i class="bi bi-bell-fill calendar-icon" style="font-size: 4rem; color: #DA4256; text-align: center"></i> <!-- Menggunakan ikon Calendar Range dari Bootstrap -->
                <h3 class="product__title" style="text-align: center">Prayer Notification</h3>
            </article>

            <article class="product__card">
                <i class="bi bi-journals calendar-icon" style="font-size: 4rem; color: #DA4256; text-align: center"></i> <!-- Menggunakan ikon Calendar Range dari Bootstrap -->
                <h3 class="product__title" style="text-align: center">Education Article</h3>
            </article>

            <article class="product__card">
                <i class="bi bi-moon-stars-fill calendar-icon" style="font-size: 4rem; color: #DA4256; text-align: center"></i> <!-- Menggunakan ikon Calendar Range dari Bootstrap -->
                <h3 class="product__title" style="text-align: center">Prayer Schedule </h3>
            </article>
        </div>
    </section>




    <!--==================== QUESTIONS ====================-->
    <section class="questions section" id="faqs">
        <h2 class="section__title-center questions__title container" >
            Some common questions <br> were often asked
        </h2>

        <div class="questions__container container grid" >
            <div class="questions__group">
                <div class="questions__item">
                    <header class="questions__header">
                        <i class="ri-add-line questions__icon"></i>
                        <h3 class="questions__item-title">
                            What is zenfemina application?
                        </h3>
                    </header>

                    <div class="questions__content">
                        <p class="questions__description">
                            Zenfemina is an integrated app encompassing a Menstrual Calendar
                            for reproductive health tracking and a Missed Prayer Reminder
                            to prompt users for unfulfilled religious duties. With a
                            user-friendly design, Zenfemina provides a streamlined solution,
                            seamlessly merging these features into a single, accessible
                            platform.
                        </p>
                    </div>
                </div>

                <div class="questions__item">
                    <header class="questions__header">
                        <i class="ri-add-line questions__icon"></i>
                        <h3 class="questions__item-title">
                            Can This App Be Used Anonymously?
                        </h3>
                    </header>

                    <div class="questions__content">
                        <p class="questions__description">
                            This application is designed with a high regard for privacy.
                            All features of the application can only be accessed after logging
                            in, ensuring the security and confidentiality of user data.
                            Therefore, users can feel confident that their personal information
                            is protected and can only be accessed by those who have access
                            to the associated account.
                        </p>
                    </div>
                </div>

                <div class="questions__item">
                    <header class="questions__header">
                        <i class="ri-add-line questions__icon"></i>
                        <h3 class="questions__item-title">
                            Is This App Only Intended for Muslim Women?
                        </h3>
                    </header>

                    <div class="questions__content">
                        <p class="questions__description">
                            Yes, this application is specifically designed for Muslim women.
                            Key features of the app, such as prayer replacement reminders,
                            are tailored to support the religious practices and reproductive
                            health of Muslim women.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--==================== CONTACT ====================-->
    <section class="contact section container" id="contact">
        <div class="contact__container grid">
            <div class="contact__box">
                <h2 class="section__title">
                    Reach out to us today <br> via any of the given <br> information
                </h2>

                <div class="contact__data">
                    <div class="contact__information">
                        <h3 class="contact__subtitle">Call us for instant support</h3>
                        <span class="contact__description">
                                    <i class="ri-phone-line contact__icon"></i>
                                    +6281358301632
                                </span>
                    </div>

                    <div class="contact__information">
                        <h3 class="contact__subtitle">Write us by mail</h3>
                        <span class="contact__description">
                                    <i class="ri-mail-line contact__icon"></i>
                                    contact@zenfemina.com
                                </span>
                    </div>
                </div>
            </div>

            <form action="/" method="post" class="contact__form">
                <div class="contact__inputs">
                    <div class="contact__content">
                        <input type="email" placeholder=" " class="contact__input" id="email" name="email">
                        <label for="" class="contact__label">Email</label>
                    </div>

                    <div class="contact__content">
                        <input type="text" placeholder=" " class="contact__input" id="subject" name="subject">
                        <label for="" class="contact__label">Subject</label>
                    </div>

                    <div class="contact__content contact__area">
                        <textarea name="message" placeholder=" " class="contact__input" id="message"></textarea>
                        <label for="" class="contact__label">Message</label>
                    </div>
                </div>

                <button class="button button--flex">
                    Send Message
                    <i class="ri-arrow-right-up-line button__icon"></i>
                </button>
            </form>
        </div>
    </section>
</main>

<!--==================== FOOTER ====================-->
<footer class="footer section">
    <div class="footer__container container grid">
        <div class="footer__content">

            <h3 class="footer__title">ZENFEMINA</h3>

            <ul class="footer__data" style="padding-left: 0rem">
                <li class="footer__information">Jl. Mastrip Po. Box 164, Kec. Sumbersari, <br> Kab. Jember Jawa Timur, Indonesia 68121</li>
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Useful Links</h3>

            <ul class="custom-nav">
                <li class="custom-nav__item">
                    <a href="#home" class="custom-nav__link">
                        <i class="ri-arrow-right-s-line" style="color: #DA4256; margin-right: 7px;"></i>
                        Home
                    </a>
                </li>
                <li class="custom-nav__item">
                    <a href="#home" class="custom-nav__link">
                        <i class="ri-arrow-right-s-line" style="color: #DA4256; margin-right: 7px;"></i>
                        App Features
                    </a>
                </li>
                <li class="custom-nav__item">
                    <a href="#home" class="custom-nav__link">
                        <i class="ri-arrow-right-s-line" style="color: #DA4256; margin-right: 7px;"></i>
                        FAQs
                    </a>
                </li>
                <li class="custom-nav__item">
                    <a href="#home" class="custom-nav__link">
                        <i class="ri-arrow-right-s-line" style="color: #DA4256; margin-right: 7px;"></i>
                        Contact Us
                    </a>
                </li>
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">On Github</h3>

            <ul class="custom-nav" style="padding-left: 0rem">
                <li class="custom-nav__item">
                    <a href="https://github.com/AzzaWafiqurrohmah/ZenFeminaWeb" target="_blank" class="custom-nav__link">
                        <i class="ri-arrow-right-s-line" style="color: #DA4256; margin-right: 7px;"></i>
                        Our website
                    </a>
                </li >

                <li class="custom-nav__item">
                    <a href="https://github.com/khairunnisaalallah/zenFeminaMobile" target="_blank" class="custom-nav__link">
                        <i class="ri-arrow-right-s-line" style="color: #DA4256; margin-right: 7px;"></i>
                        Our mobile App
                    </a>
                </li >
            </ul>
        </div>
    </div>

    <p class="footer__copy">&#169; zenfemina. All rigths reserved</p>
</footer>

<!--=============== SCROLL UP ===============-->
<a href="#" class="scrollup" id="scroll-up">
    <i class="ri-arrow-up-fill scrollup__icon"></i>
</a>

<!--=============== SCROLL REVEAL ===============-->
<script src="/assetsLandingPage/js/scrollreveal.min.js"></script>

<!--=============== MAIN JS ===============-->
<script src="/assetsLandingPage/js/main.js"></script>
<script src="/assetsWeb/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
