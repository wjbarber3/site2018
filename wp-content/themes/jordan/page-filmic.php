<?php ?>

<head>
   <link href="/wp-content/themes/jordan/font-awesome/font-awesome.min.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,900,900i" rel="stylesheet">
   <link href="/wp-content/themes/jordan/filmic/compiled_css/main.style.css" rel="stylesheet">
</head>

<body>

<div class="notification">
   <div class="main-wrap">
      <p>I’ve been wanting to play aroud with Google Firebase.  I’ve also been wanting to combine my passion for web dev with my passion for auteur cinema. Below is the combination of those two. Choose a director and then see which actors they have collaborated with among other things. This is a work in progress, directors will be added weekly. Poster images courtesy of <a target="blank" href="http://www.imdb.com">IMDB</a>.</p>
   </div>
</div>

<div class="filmic-page active">
   <div class="filmic-sidebar"></div>
   <div class="filmic-content">
      <div class="filmic-heading">
         <h1 class="large">Choose an <a target="blank" href="https://en.wikipedia.org/wiki/Auteur">auteur<sup><i class="fa fa-question-circle"></i></sup></a></h1>
      </div>
      <div class="filmic-data">
         <ul id="director-list">
         </ul>
      </div>
   </div>
</div>

<div class="filmic-page">

   <div class="filmic-sidebar">
      
      <h2>Filter Films</h2>
      
      <!-- <a class="back" href="/filmic"><i class="fa fa-arrow-circle-o-left"></i>Back to director list</a> -->

      <label for="title"><i class="fa fa-edit"></i>Title</label>
      <input id="title" name="title" type="text" onkeyup="titleSearch()" placeholder="start typing...">

      <img src="/wp-content/themes/jordan/filmic/img/or.png" alt="">

      <form id="actor-search">
         <label for="actor-input"><i class="fa fa-user"></i>Pick 1+ Actor(s)</label>
         <input id="actor-input" name="actor-input" type="text" onkeyup="narrowActors()" placeholder="type to narrow results...">
         <div id="actor-container"></div>
         <input type="submit" onclick="actorSearch(event)" value="Update">
      </form>

      <img src="/wp-content/themes/jordan/filmic/img/or.png" alt="">

      <form id="year-search" action="">
         <label for="year"><i class="fa fa-calendar"></i>Choose a decade</label>
         <select id="year" name="year">
            <option selected="selected" value="00">all decades...</option>
            <option value="20">1920's</option>
            <option value="30">1930's</option>
            <option value="40">1940's</option>
            <option value="50">1950's</option>
            <option value="60">1960's</option>
            <option value="70">1970's</option>
         </select>
         <input type="submit" onclick="yearSearch(event)" value="Update">
      </form>

      <form id="clear-search">
         <input class="secondary" type="submit" onclick="clearSearch(event)" value="Clear Search">
      </form>

   </div>

   <div class="filmic-content">
      <div class="filmic-heading">
         <h1 id="director-name" class="large"></h1>
         <div id="loader"></div>
      </div>
      <div class="filmic-data">
         <div id="film-grid"></div>
      </div>
   </div>

</div>

</body>

<script src="https://www.gstatic.com/firebasejs/3.6.6/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="/wp-content/themes/jordan/filmic/js/filmic.min.js"></script>