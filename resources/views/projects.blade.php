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
                        <h2 class="blog_title">Calert</h2>
                        <p class="blog_text">calert stands for custom-alert and it's a lighweight alternative for sweetalert and native dialogs with less than 9kb size</p>
                        <img src="img/projects/calert.png" alt="Blog 1" class="blog_image">
                    </div>

                    <!-- Single Blog -->
                    <div class="blog_box">
                        <h2 class="blog_title">Json-Msg-React</h2>
                        <p class="blog_text">JSON-MSG is a lightweight alternative for Joi or Yup or any json validator. Unlike Joi, json-msg focused only on error messages and validations</p>
                        <img src="img/projects/json-msg-react.png" alt="Blog 1" class="blog_image">
                    </div>

                    <!-- Single Blog -->
                    <div class="blog_box">
                        <h2 class="blog_title">E-SUDOKU</h2>
                        <p class="blog_text">An online sudoku game with accessible buttons and helpers for hints and errors detection.</p>
                        <img src="img/projects/esudoku.png" alt="Blog 1" class="blog_image">
              
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
</body>

</html>