<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:contents.php');
}

if(isset($_POST['delete_video'])){

   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_video_thumb = $conn->prepare("SELECT thumb FROM `content` WHERE id = ? LIMIT 1");
   $delete_video_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_video = $conn->prepare("SELECT video FROM `content` WHERE id = ? LIMIT 1");
   $delete_video->execute([$delete_id]);
   $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
   //unlink('../uploaded_files/'.$fetch_video['video']);

   $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
   $delete_likes->execute([$delete_id]);
   $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
   $delete_comments->execute([$delete_id]);

   $delete_content = $conn->prepare("DELETE FROM `content` WHERE id = ?");
   $delete_content->execute([$delete_id]);
   header('location:contents.php');
    
}

if(isset($_POST['delete_comment'])){

   $delete_id = $_POST['comment_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE id = ?");
   $verify_comment->execute([$delete_id]);

   if($verify_comment->rowCount() > 0){
      $delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
      $delete_comment->execute([$delete_id]);
      $message[] = 'comment deleted successfully!';
   }else{
      $message[] = 'comment already deleted!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>HRMBSi | View Content</title>
   <link rel="icon" href="../images/hrmbsi icon.png">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600&display=swap');

:root{
   --main-color:#d6b43b;
   --red:#e74c3c;
   --oragen:#265828;
   --white:#fff;
   --black:#2c3e50;
   --light-color:#888;
   --light-bg:#eee;
   --border:.1rem solid rgba(0,0,0,.2);
}

*{
   font-family: 'Nunito', sans-serif;
   margin: 0; padding: 0;
   box-sizing: border-box;
   outline: none; border: none;
   text-decoration: none;
}

*::selection{
   background-color: var(--main-color);
   color: #fff;
}

*::-webkit-scrollbar{
   height: .5rem;
   width: 1rem;
}

*::-webkit-scrollbar-track{
   background-color: transparent;
}

*::-webkit-scrollbar-thumb{
   background-color: var(--main-color);
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

body{
   background-color: var(--light-bg);
   padding-left: 30rem;
   /* padding-bottom: 7rem; */
}

body.dark{
   --white:#222;
   --black:#fff;
   --light-color:#aaa;
   --light-bg:#333;
   --border:.1rem solid rgba(255,255,255,.2);
}

body.active{
   padding-left: 0;
}

section{
   padding:2rem;
   max-width: 1200px;
   margin: 0 auto;
}

.btn,
.option-btn,
.delete-btn,
.inline-btn,
.inline-option-btn,
.inline-delete-btn{
   border-radius: .5rem;
   padding: 1rem 3rem;
   font-size: 1.8rem;
   color: #fff;
   margin-top: 1rem;
   text-transform: capitalize;
   cursor: pointer;
   text-align: center;
}

.btn,
.option-btn,
.delete-btn{
   display: block;
   width: 100%;
}

.inline-btn,
.inline-option-btn,
.inline-delete-btn{
   display: inline-block;
}

.btn,
.inline-btn{
   background-color: var(--main-color);
}

.option-btn,
.inline-option-btn{
   background-color: var(--oragen);
}

.delete-btn,
.inline-delete-btn{
   background-color: var(--red);
}

.btn:hover,
.option-btn:hover,
.delete-btn:hover,
.inline-btn:hover,
.inline-option-btn:hover,
.inline-delete-btn:hover{
   background-color: var(--black);
   color: var(--white);
}

.flex-btn{
   display:flex;
   gap: 1rem;
}

.message{
   position: sticky;
   top:0;
   background-color: var(--light-bg);
   padding:2rem;
   display: flex;
   align-items: center;
   gap:1rem;
   justify-content: space-between;
}

.message.form{
   max-width: 1200px;
   margin: 0 auto;
   background-color: var(--white);
   top: 2rem;
   border-radius: .5rem;
}

.message span{
   font-size: 2rem;
   color:var(--black);
}

.message i{
   font-size: 2.5rem;
   color:var(--red);
   cursor: pointer;
   transition: .2s linear;
}

.message i:hover{
   transform: rotate(90deg);
}

.empty{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 1.5rem;
   text-align: center;
   width: 100%;
   font-size: 2rem;
   color: var(--red);
}

.heading{
   padding-bottom: 1.8rem;
   border-bottom: var(--border);
   font-size: 2.5rem;
   color: var(--black);
   text-transform: capitalize;
   margin-bottom: 2rem;
}

.header{
   background-color: var(--white);
   border-bottom: var(--border);
   position: sticky;
   top: 0; left: 0; right: 0;
   z-index: 1000;
}

.header .flex{
   padding: 1.5rem 2rem;
   position: relative;
   display: flex;
   align-items: center;
   justify-content: space-between;
}

.header .flex .logo{
   font-size: 2.5rem;
   color: var(--black);
   font-weight: bolder;
}

.header .flex .search-form{
   width: 50rem;
   border-radius: .5rem;
   display: flex;
   align-items: center;
   gap: 2rem;
   padding: 1.5rem 2rem;
   background-color: var(--light-bg);
}

.header .flex .search-form input{
   width: 100%;
   background:none;
   font-size: 2rem;
   color: var(--black);
}

.header .flex .search-form button{
   font-size: 2rem;
   color: var(--black);
   cursor: pointer;
   background: none;
}

.header .flex .search-form button:hover{
   color: var(--main-color);
}

.header .flex .icons div{
   font-size: 2rem;
   color: var(--black);
   border-radius: .5rem;
   height: 4.5rem;
   cursor: pointer;
   width: 4.5rem;
   line-height: 4.4rem;
   background-color: var(--light-bg);
   text-align: center;
   margin-left: .5rem;
}

.header .flex .icons div:hover{
   background-color: var(--black);
   color:var(--white);
}

#search-btn{
   display: none;
}

.header .flex .profile{
   position: absolute;
   top: 120%; right: 2rem;
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   text-align: center;
   width: 30rem;
   transform: scale(0);
   transform-origin: top right;
}

.header .flex .profile.active{
   transform: scale(1);
   transition: .2s linear;
}

.header .flex .profile img{
   height: 10rem;
   width: 10rem;
   border-radius: 50%;
   object-fit: cover;
   margin-bottom: .5rem;
}

.header .flex .profile h3{
   font-size: 2rem;
   color: var(--black);
}

.header .flex .profile span{
   color: var(--light-color);
   font-size: 1.6rem;
}

.header .flex .profile .flex-btn{
   margin-top: .5rem;
}

.side-bar{
   position: fixed;
   top: 0; left: 0;
   height: 100vh;
   width: 30rem;
   background-color: var(--white);
   border-right: var(--border);
   z-index: 1200;
}

.side-bar .close-side-bar{
   text-align: right;
   padding: 2rem;
   padding-bottom: 0;
   display: none;
}

.side-bar .close-side-bar i{
   height: 4.5rem;
   width: 4.5rem;
   line-height: 4.4rem;
   font-size: 2.5rem;
   color: #fff;
   cursor: pointer;
   background-color: var(--red);
   text-align: center;
   border-radius: .5rem;
}

.side-bar .close-side-bar i:hover{
   background-color: var(--black);
}

.side-bar .profile{
   padding:3rem 2rem;
   text-align: center;
}

.side-bar .profile img{
   height: 10rem;
   width: 10rem;
   border-radius: 50%;
   object-fit: cover;
   margin-bottom: .5rem;
}

.side-bar .profile h3{
   font-size: 2rem;
   color: var(--black);
}

.side-bar .profile span{
   color: var(--light-color);
   font-size: 1.6rem;
}

.side-bar .profile .flex-btn{
   margin-top: .5rem;
}

.side-bar .navbar a{
   display:block;
   padding: 2rem;
   margin: .5rem 0;
   font-size: 1.8rem;
}

.side-bar .navbar a i{
   color: var(--main-color);
   margin-right: 1.5rem;
   transition: .2s linear;
}

.side-bar .navbar a span{
   color: var(--light-color);
}

.side-bar .navbar a:hover{
   background-color: var(--light-bg);
}

.side-bar .navbar a:hover i{
   margin-right: 2.5rem;
}

.side-bar.active{
   left: -31rem;
}

.form-container{
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
}

.form-container form{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
}

.form-container .login{
   width: 50rem;
}

.form-container .register{
   width: 80rem;
}

.form-container form h3{
   text-align: center;
   font-size: 2.5rem;
   margin-bottom: 1rem;
   color: var(--black);
   text-transform: capitalize;
}

.form-container form p{
   padding-top: 1rem;
   font-size: 1.7rem;
   color: var(--light-color);
}

.form-container form p span{
   color: var(--red);
}

.form-container .link{
   padding-bottom: 1rem;
   text-align: center;
   font-size: 2rem;
}

.form-container .link a{
   color: var(--main-color);
}

.form-container .link a:hover{
   color: var(--black);
   text-decoration: underline;
}

.form-container form .box{
   width: 100%;
   border-radius: .5rem;
   margin: 1rem 0;
   font-size: 1.8rem;
   color: var(--black);
   padding: 1.4rem;
   background-color: var(--light-bg);
}

.form-container .flex{
   display: flex;
   gap: 2rem;
}

.form-container .flex .col{
   flex: 1 1 25rem;
}

.dashboard .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
   align-items: flex-start;
   justify-content: center;
   gap: 1.5rem;
}

.dashboard .box-container .box{
   padding: 2rem;
   border-radius: .5rem;
   background-color: var(--white);
   text-align: center;
}

.dashboard .box-container .box h3{
   margin-bottom: .5rem;
   font-size: 2.5rem;
   color: var(--black);
   margin-bottom: 1.5rem;
}

.dashboard .box-container .box p{
   font-size: 2rem;
   color: var(--light-color);
   padding: 1rem 1.5rem;
   border-radius: .5rem;
   background-color: var(--light-bg);
   margin: 1rem 0;
}

.tutor-profile .details{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   text-align: center;
}

.tutor-profile .details .tutor{
   margin-bottom: 2rem;
}

.tutor-profile .details .tutor img{
   height: 10rem;
   width: 10rem;
   border-radius: 50%;
   object-fit: cover;
   margin-bottom: .5rem;
}

.tutor-profile .details .tutor h3{
   font-size: 2.5rem;
   color: var(--black);
   margin: .5rem 0;
}

.tutor-profile .details .tutor span{
   font-size: 1.8rem;
   color: var(--light-color);
   display: block;
}

.tutor-profile .details .flex{
   display: flex;
   gap: 1.5rem;
   align-items: center;
   flex-wrap: wrap;
}

.tutor-profile .details .flex .box{
   flex: 1 1 26rem;
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding: 2rem;
}

.tutor-profile .details .flex span{
   color: var(--main-color);
   display: block;
   margin-bottom: .5rem;
   font-size: 2.5rem;
}

.tutor-profile .details .flex .box p{
   font-size: 2rem;
   color: var(--black);
   padding: .5rem 0;
}

.playlist-form form{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   padding-top: 1rem;
   max-width: 50rem;
   margin: 0 auto;
}

.playlist-form form p{
   font-size: 1.7rem;
   color: var(--light-color);
   padding-top: 1rem;
}

.playlist-form form p span{
   color: var(--red);
}

.playlist-form form .box{
   margin: 1rem 0;
   border-radius: .5rem;
   padding: 1.4rem;
   font-size: 1.8rem;
   color: var(--black);
   background: var(--light-bg);
   width: 100%;
}

.playlist-form form textarea{
   height: 20rem;
   resize: none;
}

.playlist-form form .thumb{
   height: 22rem;
   margin-top: 1rem;
   position: relative;
}

.playlist-form form .thumb img{
   height: 100%;
   width: 100%;
   object-fit: cover;
   border-radius: .5rem;
}

.playlist-form form .thumb span{
   background-color: rgba(0,0,0,.3);
   color: #fff;
   border-radius: .5rem;
   position: absolute;
   top: 1rem; left: 1rem;
   padding: .5rem 1.5rem;
   font-size: 2rem;
}

.playlists .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 35rem);
   align-items: flex-start;
   justify-content: center;
   gap: 1.5rem;
}

.playlists .box-container .box{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   overflow-x:hidden;
}

.playlists .box-container .box .thumb{
   height: 20rem;
   position: relative;
   margin: 1.5rem 0;
}

.playlists .box-container .box .flex{
   display: flex;
   align-items: center;
   gap: 1.5rem;
   justify-content: space-between;
}

.playlists .box-container .box .flex i{
   font-size: 1.5rem;
   color: var(--main-color);
   margin-right:.7rem;
}

.playlists .box-container .box .flex span{
   color: var(--light-color);
   font-size: 1.7rem;
}

.playlists .box-container .box .thumb img{
   height: 100%;
   width: 100%;
   object-fit: cover;
   border-radius: .5rem;
}

.playlists .box-container .box .thumb span{
   background-color: rgba(0,0,0,.3);
   color: #fff;
   border-radius: .5rem;
   position: absolute;
   top: 1rem; left: 1rem;
   padding: .5rem 1.5rem;
   font-size: 2rem;
}

.playlists .box-container .box .title{
   font-size: 2rem;
   color: var(--black);
   margin-bottom: 1rem;
   text-overflow: ellipsis;
   white-space: nowrap;
   overflow-x:hidden;
}

.playlists .box-container .box .description{
   line-height: 2;
   font-size: 1.7rem;
   color: var(--light-color);
}

.playlists .box-container .box .description::after{
   content: '...';
}

.video-form form{
   max-width: 50rem;
   margin: 0 auto;
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   padding-top: 1rem;
}

.video-form form p{
   padding-top: 1rem;
   font-size: 1.7rem;
   color: var(--light-color);
}

.video-form form p span{
   color:var(--red);
}

.video-form form .box{
   width: 100%;
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding: 1.4rem;
   font-size: 1.8rem;
   color: var(--black);
   margin: 1rem 0;
}

.video-form form textarea{
   height: 20rem;
   resize: none;
}

.video-form form img{
   width: 100%;
   height: 20rem;
   border-radius: .5rem;
   object-fit: contain;
   margin: .5rem 0;
}

.video-form form video{
   background-color: #000;
   width: 100%;
   height: 20rem;
   border-radius: .5rem;
   margin: .5rem 0;
}

.playlist-details .row{
   display: flex;
   gap: 2.5rem;
   flex-wrap: wrap;
   align-items: flex-start;
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
}

.playlist-details .row .thumb{
   flex: 1 1 40rem;
   height: 30rem;
   position: relative;
}

.playlist-details .row .thumb img{
   height: 100%;
   width: 100%;
   border-radius: .5rem;
   object-fit: cover;
}

.playlist-details .row .thumb span{
   background-color: rgba(0,0,0,.3);
   color: #fff;
   border-radius: .5rem;
   position: absolute;
   top: 1rem; left: 1rem;
   padding: .5rem 1.5rem;
   font-size: 2rem;
}

.playlist-details .row .details{
   flex: 1 1 40rem;
}

.playlist-details .row .details .date{
   font-size: 1.5rem;
   margin: 1rem 0;
}

.playlist-details .row .details .date i{
   color: var(--main-color);
   margin-right: 1rem;
}

.playlist-details .row .details .date span{
   color: var(--light-color);
}

.playlist-details .row .details .title{
   font-size: 2rem;
   color: var(--black);
   padding-bottom: .5rem;
}

.playlist-details .row .details .description{
   padding: .5rem 0;
   font-size: 1.7rem;
   color: var(--light-color);
   line-height: 2;
   white-space: pre-line;
}

.contents .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 35rem);
   align-items: flex-start;
   justify-content: center;
   gap: 1.5rem;
}

.contents .box-container .box{
   border-radius: .5rem;
   background-color: var(--white);
   padding: 2rem;
   overflow-x: hidden;
}

.contents .box-container .box .thumb{
   height: 20rem;
   width: 100%;
   border-radius: .5rem;
   object-fit: cover;
   margin: 1rem 0;
}

.contents .box-container .box .flex{
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap: 1.5rem;
   margin-bottom: .5rem;
}

.contents .box-container .box .flex i{
   font-size: 1.5rem;
   color: var(--main-color);
   margin-right: 1rem;
}

.contents .box-container .box .flex span{
   color: var(--light-color);
   font-size: 1.7rem;
}

.contents .box-container .box .title{
   font-size: 2rem;
   color: var(--black);
   line-height: 1.5;
   text-overflow: ellipsis;
   overflow-x: hidden;
}

.view-content .container{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
}

.view-content .container .video{
   width: 100%;
   object-fit: contain;
   margin-bottom: 1rem;
   background: #000;
   height: 50rem;
}

.view-content .container .date{
   padding:1rem 0;
   font-size: 1.7rem;
}

.view-content .container .date i{
   margin-right: 1rem;
   color: var(--main-color);
}

.view-content .container .date span{
   color: var(--light-color);
}

.view-content .container .title{
   font-size: 2rem;
   color: var(--black);
   padding: .5rem 0;
}

.view-content .container .flex{
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap: 1.5rem;
   font-size: 1.8rem;
   border-top: var(--border);
   padding-top: 1.5rem;
   padding-bottom: 1rem;
   margin-top: 1rem;
}

.view-content .container .flex div{
   background-color: var(--light-bg);
   border-radius: .5rem;
   padding: .5rem 1rem;
}

.view-content .container .flex i{
   margin-right: 1rem;
   color: var(--main-color);
}

.view-content .container .flex span{
   color: var(--light-color);
}

.view-content .container .description{
   padding: .5rem 0;
   line-height: 1.7;
   font-size: 1.7rem;
   color: var(--light-color);
}

.comments .show-comments{
   background-color: var(--white);
   border-radius: .5rem;
   padding: 2rem;
   display: grid;
   gap: 2.5rem;
}

.comments .show-comments .user{
   display: flex;
   align-items: center;
   gap: 1.5rem;
   margin-bottom: 2rem;
}

.comments .show-comments .user img{
   height: 5rem;
   width: 5rem;
   border-radius: 50%;
   object-fit: cover;
}

.comments .show-comments .user h3{
   font-size: 2rem;
   color: var(--black);
   margin-bottom: .2rem;
}

.comments .show-comments .user span{
   color: var(--light-color);
   font-size: 1.5rem;
}

.comments .show-comments .content{
   margin-bottom: 2rem;
}

.comments .show-comments .content p{
   font-size: 2rem;
   color: var(--black);
   padding: 0 1rem;
   display: inline-block;
}

.comments .show-comments .content span{
   font-size: 1.7rem;
   color: var(--light-color);
}

.comments .show-comments .content a{
   color: var(--main-color);
   font-size: 1.8rem;
}

.comments .show-comments .content a:hover{
   text-decoration: underline;
}

.comments .show-comments .text{
   border-radius: .5rem;
   background-color: var(--light-bg);
   padding: 1rem 1.5rem;
   color: var(--black);
   margin: .5rem 0;
   position: relative;
   z-index: 0;
   white-space: pre-line;
   font-size: 1.8rem;
}

.comments .show-comments .text::before{
   content: '';
   position: absolute;
   top: -1rem; left: 1.5rem;
   height: 1.2rem;
   width: 2rem;
   background-color: var(--light-bg);
   clip-path: polygon(50% 0%, 0% 100%, 100% 100%); 
}














.footer{
   position: sticky;
   bottom: 0; right: 0; left: 0;
   background-color: var(--white);
   border-top: var(--border);
   padding:2.5rem 2rem;
   text-align: center;
   color: var(--black);
   font-size: 2rem;
   margin-top: 2rem;
   z-index: 1000;
}

.footer span{
   color: var(--main-color);
}

/*#overlay {
   position: absolute;
    top: 81%;
    left: 0;
    height: 2%;
    width: 100%;
    background-color: black;
    z-index: 1;
    opacity: 0.9;
}*/


@media (max-width:1200px){

   body{
      padding-left: 0;
   }

   .side-bar{
      transition: .2s linear;
      left: -30rem;
   }

   .side-bar.active{
      left: 0;
      box-shadow: 0 0 0 100vw rgba(0,0,0,.7);
   }

   .side-bar .close-side-bar{
      display: block;
   }

}

@media (max-width:991px){
   
   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   #search-btn{
      display: inline-block;
   }

   .header .flex .search-form{
      position: absolute;
      top:99%; left: 0; right: 0;
      width: auto;
      border-top: var(--border);     
      border-bottom: var(--border);
      background-color: var(--white);
      clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
      transition: .2s linear;
   }

   .header .flex .search-form.active{
      clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
   }

   .form-container .flex{
      display: flex;
      gap: 0;
      flex-flow: column;
   }

   .view-content .container .video{
      height: 30rem;
   }

}

@media (max-width:450px){
   
   html{
      font-size: 50%;
   }

   .heading{
      font-size: 2rem;
   }

   .flex-btn{
      flex-flow: column;
      gap: 0;
   }

   .playlists .box-container{
      grid-template-columns: 1fr;
   }

   .view-content .container .video{
      height: auto;
   }

}
</style>


</head>
<body>

<?php include '../components/admin_header.php'; ?>


<section class="view-content">

   <?php
      $select_content = $conn->prepare("SELECT * FROM `content` WHERE id = ? AND tutor_id = ?");
      $select_content->execute([$get_id, $tutor_id]);
      if($select_content->rowCount() > 0){
         while($fetch_content = $select_content->fetch(PDO::FETCH_ASSOC)){
            $video_id = $fetch_content['id'];

            $count_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ? AND content_id = ?");
            $count_likes->execute([$tutor_id, $video_id]);
            $total_likes = $count_likes->rowCount();

            $count_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ? AND content_id = ?");
            $count_comments->execute([$tutor_id, $video_id]);
            $total_comments = $count_comments->rowCount();
   ?>
   <div class="container">
      <iframe src="<?= $fetch_content['link']; ?>" autoplay controls poster="../uploaded_files/<?= $fetch_content['thumb']; ?>" class="video"></iframe>
      <!--<div id="overlay"></div>-->
      <form action="" method="post">
      <button onclick = "stopVideo(body)" class="inline-delete-btn"> Stop Video </button>
      </form>
      <div class="date"><i class="fas fa-calendar"></i><span><?= $fetch_content['date']; ?></span></div>
      <h3 class="title"><?= $fetch_content['title']; ?></h3>
      <div class="flex">
         <div><i class="fas fa-heart"></i><span><?= $total_likes; ?></span></div>
         <div><i class="fas fa-comment"></i><span><?= $total_comments; ?></span></div>
      </div>
      <div class="description"><?= $fetch_content['description']; ?></div>
      <form action="" method="post">
         <div class="flex-btn">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <a href="update_content.php?get_id=<?= $video_id; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('Delete this video?');" name="delete_video">
         </div>
      </form>
   </div>
   <?php
    }
   }else{
      echo '<p class="empty">No contents added yet! <a href="add_content.php" class="btn" style="margin-top: 1.5rem;">Add videos</a></p>';
   }
      
   ?>

</section>

<section class="comments">

   <h1 class="heading">User comments</h1>

   
   <div class="show-comments">
      <?php
         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE content_id = ?");
         $select_comments->execute([$get_id]);
         if($select_comments->rowCount() > 0){
            while($fetch_comment = $select_comments->fetch(PDO::FETCH_ASSOC)){   
               $select_commentor = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_commentor->execute([$fetch_comment['user_id']]);
               $fetch_commentor = $select_commentor->fetch(PDO::FETCH_ASSOC);
      ?>
      <div class="box">
         <div class="user">
            <img src="../uploaded_files/<?= $fetch_commentor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_commentor['name']; ?></h3>
               <span><?= $fetch_comment['date']; ?></span>
            </div>
         </div>
         <p class="text"><?= $fetch_comment['comment']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="comment_id" value="<?= $fetch_comment['id']; ?>">
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Delete this comment?');">Delete Comment</button>
         </form>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">No comments added yet!</p>';
      }
      ?>
      </div>
   
</section>

<section class="comments">

   <h1 class="heading">Users Completed the Module</h1>

   
   <div class="show-comments">
      <?php
         $select_completed = $conn->prepare("SELECT c.*, cc.*, u.* FROM `content` AS C JOIN `content_completion` AS cc ON c.id = cc.content_id JOIN `users` AS u ON cc.user_id = u.id WHERE cc.content_id = ?");
         $select_completed->execute([$get_id]);
         if($select_completed->rowCount() > 0){
            while($fetch_completed = $select_completed->fetch(PDO::FETCH_ASSOC)){   
      ?>
      <div class="box">
         <div class="user">
            <img src="../uploaded_files/<?= $fetch_completed['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_completed['name']; ?></h3>
               <span>Date Completed: <?= $fetch_completed['date']; ?></span>
            </div>
         </div>
         <!--<p class="text"><?= $fetch_completed['date']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="comment_id" value="<?= $fetch_completed['date']; ?>">
            <button type="submit" name="delete_comment" class="inline-delete-btn" onclick="return confirm('Delete this comment?');">Delete Comment</button>
         </form>-->
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">No users completed the module yet!</p>';
      }
      ?>
      </div>
   
</section>










<script>
      // to stop the video
      function stopVideo(element) {
         // getting every iframe from the body
         var iframes = element.querySelectorAll('iframe');
         // reinitializing the values of the src attribute of every iframe to stop the YouTube video.
         for (let i = 0; i < iframes.length; i++) {
            if (iframes[i] !== null) {
               var temp = iframes[i].src;
               iframes[i].src = temp;
            }
         }
      };
</script>


<?php //include '../components/footer.php'; //?>

<script src="../js/admin_script.js"></script>

</body>
</html>
