<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/profile.png" type="image/x-icon">

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Cris Fandino - Projects</title>
</head>

<body>
    <!-- Website Layout -->
    <div class="website_container">

        @include('components.global-menu')

        <!-- content -->
        <div class="content_container">
            <!-- Blogs Page -->
            <div class="blogs_page">
                <h2 class="title">My <span>Projects</span></h2>
                <hr class="line">
                <div class="blogs_container">
                    <!-- Single Blog -->
                    <div class="blog_box">
                        <h2 class="blog_title">This is the Title of my first blog</h2>
                        <p class="blog_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus explicabo
                            consequuntur esse? Soluta molestias vitae, obcaecati libero ullam cupiditate amet temporibus
                            repudiandae voluptatem delectus vero dicta ducimus dolor similique nisi.</p>
                        <img src="img/blog1.jpg" alt="Blog 1" class="blog_image">
                        <p class="blog_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus explicabo
                            consequuntur esse? Soluta molestias vitae, obcaecati libero ullam cupiditate amet temporibus
                            repudiandae voluptatem delectus vero dicta ducimus dolor similique nisi.</p>
                    </div>

                    <!-- Single Blog -->
                    <div class="blog_box">
                        <h2 class="blog_title">This is the Title of my second blog</h2>
                        <p class="blog_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus explicabo
                            consequuntur esse? Soluta molestias vitae, obcaecati libero ullam cupiditate amet temporibus
                            repudiandae voluptatem delectus vero dicta ducimus dolor similique nisi.</p>
                        <img src="img/blog2.jpg" alt="Blog 2" class="blog_image">
                        <p class="blog_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus explicabo
                            consequuntur esse? Soluta molestias vitae, obcaecati libero ullam cupiditate amet temporibus
                            repudiandae voluptatem delectus vero dicta ducimus dolor similique nisi.</p>
                    </div>

                    <!-- Single Blog -->
                    <div class="blog_box">
                        <h2 class="blog_title">This is the Title of my third blog</h2>
                        <p class="blog_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus explicabo
                            consequuntur esse? Soluta molestias vitae, obcaecati libero ullam cupiditate amet temporibus
                            repudiandae voluptatem delectus vero dicta ducimus dolor similique nisi.</p>
                        <img src="img/blog3.jpg" alt="Blog 3" class="blog_image">
                        <p class="blog_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus explicabo
                            consequuntur esse? Soluta molestias vitae, obcaecati libero ullam cupiditate amet temporibus
                            repudiandae voluptatem delectus vero dicta ducimus dolor similique nisi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
</body>

</html>