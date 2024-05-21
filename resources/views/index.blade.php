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

    <title>Cris Fandino - Home</title>
</head>

<body>
    <!-- Website Layout -->
    <ul class="website_container">

        @include('components.global-menu')
        <!-- content -->
        <div class="content_container">
            <!-- About Page -->
            <div class="about_page">
                <h2 class="title">About <span>Me</span></h2>
                <hr class="line">
                <div class="about_content">
                    <p class="about_text">I am 22 years old from the Philippines a self taught web developer . I build websites according to web standards guidelines. I have experience few of the languages and frameworks such as HTML, CSS ,Javascript, Nodejs, Bootstrap, TailwindCSS, Sass, React/Next.js and Svelte.</p>
                </div>
                <div class="about_profile">
                    <ul class="left_profile">
                        <li><span class="profile_title">Date of Birth</span><span>March 1, 2002</span></li>
                        <li><span class="profile_title">Gender</span><span>Male</span></li>
                        <li><span class="profile_title">Age</span><span>22 Years Old</span></li>
                        <li><span class="profile_title">Maritial Status</span><span>Unmarried</span></li>
                        <li><span class="profile_title">Nationality</span><span>Filipino</span></li>
                        <li><span class="profile_title">Religion</span><span>Catholic</span></li>
                    </ul>

                    <ul class="right_profile">
                        <li><span class="profile_title">Profession</span><span>Web Developer</span></li>
                        <li><span class="profile_title">Address</span><span>Davao City, Philippines</span></li>
                        <li><span class="profile_title">Contact</span><span>09123456789</span></li>
                        <li><span class="profile_title">Email</span><span>crisfandino01@gmail.com</span></li>
                        <li><span class="profile_title">Website</span><span><a href="https://crisfandino.vercel.app">crisfandino.vercel.app</a></span></li>
                        <li><span class="profile_title">Freelance</span><span>Available</span></li>
                    </ul>
                </div>

            </div>
        </div>


        <script src="js/script.js"></script>
</body>

</html>