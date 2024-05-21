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

    <title>Cris Fandino - Resume</title>
</head>

<body>
    <!-- Website Layout -->
    <div class="website_container">

        @include('components.global-menu')

        <!-- content -->
        <div class="content_container">
            <!-- Resume Page -->
            <div class="resume_page">
                <h2 class="title">My <span>Resume</span></h2>
                <hr class="line">
                <div class="resume_container">
                    <!-- Experience container -->
                    <div class="left_resume">
                        <h2 class="resume_title"><i class="fa fa-suitcase"></i> Experience</h2>
                        <div class="resume_box">
                            <span class="resume_date">2021-Present</span>
                            <p class="resume_box_title">Full Stack Developer</p>
                            <p class="resume_conpany">TactivStudios</p>
                            <p class="resume_text">Working as a full time developer and a part time student</p>
                        </div>
                    </div>

                    <!-- Education Container -->
                    <div class="right_resume">
                        <h2 class="resume_title"><i class="fas fa-book-open"></i> Education</h2>
                        <div class="resume_box">
                            <span class="resume_date">2021-Present</span>
                            <p class="resume_box_title">Information Technology</p>
                            <p class="resume_conpany">Assumption College Davao</p>
                            <p class="resume_text">Currently Studying</p>
                        </div>

                        <div class="resume_box">
                            <span class="resume_date">2018-2020</span>
                            <p class="resume_box_title">ICT</p>
                            <p class="resume_conpany">Davao Wisdom Academy</p>
                            <p class="resume_text">Senior high school graduate</p>
                        </div>

                    </div>

                </div>

                <h2 class="title">My <span>Skills</span></h2>
                <hr class="line">
                <!-- Skill Container -->
                <div class="resume_container">
                    <div class="left_resume">
                        <h2 class="resume_title"><i class="fas fa-pencil-ruler"></i> Design</h2>
                        <div class="skill_box">
                            <h2 class="skill_title">HTML</h2>
                            <div class="skill_line_container">
                                <div class="skill_line" style="width: 80%;"></div>
                            </div>
                        </div>

                        <div class="skill_box">
                            <h2 class="skill_title">CSS</h2>
                            <div class="skill_line_container">
                                <div class="skill_line" style="width: 70%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="right_resume">
                        <h2 class="resume_title"><i class="fas fa-code"></i> Programming</h2>
                        <div class="skill_box">
                            <h2 class="skill_title">JavaScript</h2>
                            <div class="skill_line_container">
                                <div class="skill_line" style="width: 80%;"></div>
                            </div>
                        </div>

                        <div class="skill_box">
                            <h2 class="skill_title">Python</h2>
                            <div class="skill_line_container">
                                <div class="skill_line" style="width: 80%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
</body>

</html>