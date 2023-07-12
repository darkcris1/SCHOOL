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
    <script src="https://unpkg.com/share-api-polyfill/dist/share-min.js"></script>
</head>

<body x-data="Post()">
    <nav class="navbar navbar-expand-lg bg-primary fixed-top" data-bs-theme="dark" id='navbar'>
        <div class="container-fluid">
            <a class="navbar-brand" href="/newsfeed.php">SocialMedyas</a>
            <div class="flex-grow-1 d-flex align-center justify-content-center">
             
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
                            <a class="dropdown-item" href="/contact.php">Contact</a>
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="col-md-6 mx-auto mt-3 py-5">
            <div 
                class="pb-2 d-flex gap-3 justify-content-between align-items-center">
                <div>
                    <select 
                        @change="filterChange"
                        class="form-select">
                        <option value="" selected>All</option>
                        <option value="1">Promotion</option>
                        <option value="2">Entertainment</option>
                    </select>
                </div>
                <div>
                    <button data-bs-toggle="modal" data-bs-target="#postModal" class="btn btn-primary mx-auto">
                        Post
                        <i class="far fa-edit ms-2"></i> 
                    </button>
                </div>
            </div>
            <template x-for="post in data">  
                <div 
                    :id="'post-' + post.id"
                    class="social-feed-box">
                    <template x-if="user == post.user.id">
                        <div class="social-action dropdown">
                            <button data-bs-toggle="dropdown" class="btn-white btn">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <button 
                                    data-bs-target="#editPostModal"
                                    data-bs-toggle="modal" 
                                    @click="selectedPost = post"
                                    class="dropdown-item">Edit</button>
                            </ul>
                        </div>
                    </template>
                    <div class="social-avatar">
                        <a href="" class="pull-left">
                            <img 
                                alt="image" :src="'uploads/' + post.user.photo">
                        </a>
                        <div class="media-body">
                            <a :href="'profile.php?user=' + post.user.id">
                                <span x-text="post.user.first_name"></span>
                                <span x-text="post.user.last_name"></span>
                            </a>
                            <small class="text-muted" x-text="post.created_at">Today 4:21 pm - 12.06.2014</small>
                            <template x-if="post.type == 1">
                                <div class="badge bg-primary d-inline-block">
                                    Promotion
                                </div>
                            </template>
                            <template x-if="post.type == 2">
                                <div class="badge bg-primary d-inline-block">
                                    Entertainment
                                </div>
                            </template>
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
                            <button 
                                @click="sharePost(post)"
                                class="btn btn-white btn-xs"><i class="far fa-share me-1"></i></button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
        <!-- Edit post -->
    <div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <template x-if="selectedPost">
                        <form 
                            @submit.prevent="editPost">
                            <div x-data="imageViewer()" class="mb-3">
                                <label for="recipient-name" class="col-form-label">Image:</label>
                                <template x-if="imageUrl || selectedPost.image">
                                    <div>
                                        <img :src="imageUrl || 'uploads/' +selectedPost.image" class="object-cover rounded border"
                                            style="width: 100px; height: 100px;">
                                    </div>
                                </template>
                                <input type="file" name="image" class="mt-3 form-control" accept="image/*"
                                    @change="fileChosen" id="recipient-name">
                            </div>
                            <input 
                                required 
                                type="hidden"
                                :value="selectedPost.id"
                                name="post_id" class="form-control" id="message-text"></input>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Caption:</label>
                                <textarea 
                                    :value="selectedPost.caption"
                                    required name="caption" class="form-control" id="message-text"></textarea>
                            </div>
                            <div class="mb-3 d-flex gap-3">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" required type="radio" name="type" id="flexRadioDefault1" value="1" :checked="selectedPost.type == 1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Promotion
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" required type="radio" name="type" value="2" id="flexRadioDefault2" :checked="selectedPost.type == 2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Entertainment
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button 
                                    x-ref="cancelUpdate"
                                    type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button 
                                    x-bind:disabled="isPosting"
                                    type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- Create post -->
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
                        <div class="mb-3 d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" required type="radio" name="type" value="1" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Promotion
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" required type="radio" name="type" value="2" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Entertainment
                                </label>
                            </div>
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
                type: '',
                selectedPost: null,
                sharePost(post){
                    navigator.share({
                        title: 'Share post',
                        text: `${post.caption}`,
                        url: location.origin + location.pathname + `#${post.id}`
                    })
                    .then( _ => console.log('Yay, you shared it :)'))
                    .catch( error => console.log('Oh noh! You couldn\'t share it! :\'(\n', error));
                },
                editPost(e){
                    const data = new FormData(e.target)
                    const image = data.get('image')
                    if (image.size === 0) {
                        data.delete('image')
                    }
                    axios.post('update_post.php', data).then((res) => {
                        Object.assign(this.selectedPost, res)                        
                        this.init(false)
                        this.$refs.cancelUpdate.click()
                    }).catch(()=>{
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error upon posting',
                            icon: 'error',
                        })
                    }).finally(()=>{
                        this.isPosting = false;
                    })
                },
                filterChange(e){
                    this.type = e.target.value
                    this.fetchPost()
                },
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
                init(isInitial=true) {
                    this.fetchPost().then(()=>{
                        if (isInitial) {
                            setTimeout(() => {
                                const el = document.querySelector(location.hash.replace('#','#post-'))
                                el?.scrollIntoView()
                            }, 200);
                        }
                    });

                },
                fetchPost(){
                    return axios.get(`post.php?type=${this.type}`).then((res) => {
                        this.data = res.data.data 
                        this.$refs.cancel.click()
                    })
                },
                submitForm(e) {
                    this.isPosting = true;
                    const data = new FormData(e.target)
                    axios.post('post.php', data).then((res) => {
                        this.init(false)
                    }).catch(()=>{
                        Swal.fire({
                            title: 'Error!',
                            text: 'Error upon posting',
                            icon: 'error',
                        })
                    })
                    .finally(()=>{
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