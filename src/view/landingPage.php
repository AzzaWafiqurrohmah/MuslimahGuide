<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="/assetsLandingPage/img/favicon.png" type="image/x-icon">

    <!--=============== REMIX ICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="/assetsLandingPage/css/styles.css">

    <title>zenfemina</title>
</head>
<body>
<!--==================== HEADER ====================-->
<header class="header" id="header">
    <nav class="nav container">
        <a href="#" class="nav__logo">
            <i class="ri-leaf-line nav__logo-icon"></i> zenfmina
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
                    <a href="#contact" class="nav__link" style="color: white; font-size: 14px;">Sign In</a>
                </li>
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
            <img src="/assetsLandingPage/img/home.png" alt="" class="home__img">

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
                <a href="#about" class="button button--flex" style="padding: 0.7rem 1rem">
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

                <img src="/assetsLandingPage/img/product1.png" alt="" class="product__img">

                <h3 class="product__title">Cacti Plant</h3>
                <span class="product__price">$19.99</span>

            </article>

            <article class="product__card">

                <img src="/assetsLandingPage/img/product2.png" alt="" class="product__img">

                <h3 class="product__title">Cactus Plant</h3>
                <span class="product__price">$11.99</span>
            </article>

            <article class="product__card">

                <img src="/assetsLandingPage/img/product3.png" alt="" class="product__img">

                <h3 class="product__title">Aloe Vera Plant</h3>
                <span class="product__price">$7.99</span>
            </article>

            <article class="product__card">

                <img src="/assetsLandingPage/img/product4.png" alt="" class="product__img">

                <h3 class="product__title">Succulent Plant</h3>
                <span class="product__price">$5.99</span>
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
                            My flowers are falling off or dying?
                        </h3>
                    </header>

                    <div class="questions__content">
                        <p class="questions__description">
                            Plants are easy way to add color energy and transform your
                            space but which planet is for you. Choosing the right plant.
                        </p>
                    </div>
                </div>

                <div class="questions__item">
                    <header class="questions__header">
                        <i class="ri-add-line questions__icon"></i>
                        <h3 class="questions__item-title">
                            What causes leaves to become pale?
                        </h3>
                    </header>

                    <div class="questions__content">
                        <p class="questions__description">
                            Plants are easy way to add color energy and transform your
                            space but which planet is for you. Choosing the right plant.
                        </p>
                    </div>
                </div>

                <div class="questions__item">
                    <header class="questions__header">
                        <i class="ri-add-line questions__icon"></i>
                        <h3 class="questions__item-title">
                            What causes brown crispy leaves?
                        </h3>
                    </header>

                    <div class="questions__content">
                        <p class="questions__description">
                            Plants are easy way to add color energy and transform your
                            space but which planet is for you. Choosing the right plant.
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

            <form action="" class="contact__form">
                <div class="contact__inputs">
                    <div class="contact__content">
                        <input type="email" placeholder=" " class="contact__input">
                        <label for="" class="contact__label">Email</label>
                    </div>

                    <div class="contact__content">
                        <input type="text" placeholder=" " class="contact__input">
                        <label for="" class="contact__label">Subject</label>
                    </div>

                    <div class="contact__content contact__area">
                        <textarea name="message" placeholder=" " class="contact__input"></textarea>
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
            <h3 class="footer__title">Contact Us</h3>

            <ul class="footer__data" style="padding-left: 0rem">
                <li class="footer__information">
                    +6281358301632
                </li>
                <li class="footer__information">contact@zenfemina.com</li>
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
</body>
</html>
