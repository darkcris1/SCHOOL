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

    <title>Cris Fandino - Services</title>
</head>

<body>
    <!-- Website Layout -->
    <div class="website_container">

        @include('components.global-menu')

        <!-- content -->
        <div class="content_container">
            <!-- Services Page -->
            <div class="services_page">
                <h2 class="title">My <span>Services</span></h2>
                <hr class="line">
                <!-- Services Row -->
                <div class="services_container">
                    <div class="services_box">
                        <i class="fas fa-tablet-alt"></i>
                        <h3 class="services_title">App Development</h3>
                        <p class="services_text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur,
                            nobis. Lorem ipsum dolor sit amet. </p>
                    </div>
                    <div class="services_box">
                        <i class="fas fa-globe"></i>
                        <h3 class="services_title">Website Development</h3>
                        <p class="services_text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur,
                            nobis. Lorem ipsum dolor sit amet. </p>
                    </div>
                </div>
                <div class="services_container">
                    <div class="services_box">
                        <i class="fas fa-globe"></i>
                        <h3 class="services_title">Backend Development</h3>
                        <p class="services_text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur,
                            nobis. Lorem ipsum dolor sit amet. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
</body>

</html>