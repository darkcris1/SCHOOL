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

    <title>Cris Fandino - Contact</title>
</head>

<body>
    <!-- Website Layout -->
    <div class="website_container">

        @include('components.global-menu')
        <!-- content -->
        <div class="content_container">
            <!-- Contact Page -->
            <div class="contact_page">
                <h2 class="title">Contact <span>Me</span></h2>
                <hr class="line">
                <div class="contact_container">
                    <form action="post">
                        <label>Namme</label>
                        <input type="email" name="name" id="" required placeholder="Enter Email">
                        <label>Email</label>
                        <input type="email" name="email" id="" required placeholder="Enter Email">
                        <label>Subject</label>
                        <input type="text" name="subject" id="" required placeholder="Enter Subject">
                        <label>Message</label>
                        <textarea name="message" id="" cols="30" rows="10" required placeholder="Enter Message"></textarea>
                        <input type="submit" value="Send" id="send_button">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="js/script.js"></script>
</body>

</html>