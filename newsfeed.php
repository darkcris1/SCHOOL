<?php
include 'commons/required_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'components/default-head.php' ?>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/newsfeed.css">
    <title>Newsfeed</title>
</head>

<body x-data="Post()">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark" id='navbar'>
        <div class="container-fluid">
            <a class="navbar-brand" href="/newsfeed.php">SocialMedyas</a>
            <div class="flex-grow-1 d-flex align-center justify-content-center">
                <button data-bs-toggle="modal" data-bs-target="#postModal" class="btn btn-secondary mx-auto">
                    Create post
                </button>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </button>
            <div class="collapse navbar-collapse flex-grow-0" id="navbarColor01">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <?= $_SESSION['displayName'] ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/profile.php?user=<?= $_SESSION['id'] ?>">Profile</a>
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="col-md-6 mx-auto mt-3 py-5">
            <template x-for="post in data">  
                <div 
                    class="social-feed-box">
                    <template x-if="user == post.user.id">
                        <div class="social-action dropdown">
                            <button data-bs-toggle="dropdown" class="btn-white btn">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <button class="dropdown-item">Edit</button>
                            </ul>
                        </div>
                    </template>
                    <div class="social-avatar">
                        <a href="" class="pull-left">
                            <img 
                                alt="image" :src="'uploads/profile/' + post.user.photo">
                        </a>
                        <div class="media-body">
                            <a :href="'profile.php?user=' + post.user.id">
                                <span x-text="post.user.first_name"></span>
                                <span x-text="post.user.last_name"></span>
                            </a>
                            <small class="text-muted" x-text="post.created_at">Today 4:21 pm - 12.06.2014</small>
                        </div>
                    </div>
                    <div class="social-body">
                        <p x-text="post.caption">
                        </p>
                        <img 
                            :src="'/uploads/' + post.image" 
                            class="img-responsive">
                        <div class="btn-group">
                            <button 
                                @click="likePost(post)"
                                class="btn btn-white btn-xs">
                                <i 
                                    :class="{ 
                                        'far': !post.is_liked, 
                                        'fas text-danger': post.is_liked 
                                    }"
                                    class="fa-heart me-1"></i> 
                                <span x-text="post.likes_count"></span>
                            </button>
                            <button class="btn btn-white btn-xs"><i class="far fa-share me-1"></i></button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>

    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitForm">
                        <div x-data="imageViewer()" class="mb-3">
                            <label for="recipient-name" class="col-form-label">Image:</label>
                            <template x-if="imageUrl">
                                <div>
                                    <img :src="imageUrl" class="object-cover rounded border"
                                        style="width: 100px; height: 100px;">
                                </div>
                            </template>
                            <input required type="file" name="image" class="mt-3 form-control" accept="image/*"
                                @change="fileChosen" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Caption:</label>
                            <textarea required name="caption" class="form-control" id="message-text"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button 
                                x-ref="cancel"
                                type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button 
                                x-bind:disabled="isPosting"
                                type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function Post() {
            return {
                user: <?= $_SESSION['id'] ?>,
                data: [],
                isPosting: false,
                likePost(post){
                    axios.get(`like_post.php?post=${post.id}`).then((res) => {
                        if (res.data.isLiked) {
                            post.is_liked = true
                            post.likes_count += 1 
                        } else {
                            post.is_liked = false
                            post.likes_count -= 1 
                        }
                    })
                },
                init() {
                    this.fetchPost()
                },
                fetchPost(){
                    axios.get('post.php').then((res) => {
                        this.data = res.data.data 
                        this.$refs.cancel.click()
                    })
                },
                submitForm(e) {
                    this.isPosting = true;
                    const data = new FormData(e.target)
                    axios.post('post.php', data).then((res) => {
                        this.init()
                    }).finally(()=>{
                        this.isPosting = false;
                    })
                },
            }
        }

        function imageViewer() {
            return {
                imageUrl: '',
                fileChosen(event) {
                    this.fileToDataUrl(event, src => this.imageUrl = src)
                },
                fileToDataUrl(event, callback) {
                    if (!event.target.files.length) return

                    let file = event.target.files[0],
                        reader = new FileReader()
                    reader.readAsDataURL(file)
                    reader.onload = e => callback(e.target.result)
                },
            }
        }
    </script>
</body>

</html>