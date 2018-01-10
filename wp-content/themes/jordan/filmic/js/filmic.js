// Firebase Configuration
   var config = {
      apiKey: "AIzaSyCZ5caTddl4zYkKhCCvzxwuoH7FQ0u2HIk",
      authDomain: "filmic2-e7af3.firebaseapp.com",
      databaseURL: "https://filmic2-e7af3.firebaseio.com",
      storageBucket: "filmic2-e7af3.appspot.com",
      messagingSenderId: "254290584375"
   };

   // Initialize FireBase Database
   firebase.initializeApp(config);

   // Build Director List
   var directorQuery = firebase.database().ref("Directors");
   directorQuery.once("value")
   .then(function(snapshot) {
      var directors = snapshot.val();
      directors.forEach(function(directorName) {
         $("#director-list").append("<li class='col-sm-3'><a href='#' onclick='chooseDirector(event)'>" + directorName + "</a></li>" );
      });
      PageRoute.init();
   });

   // Choose Director
   function chooseDirector(e) {
      e.preventDefault();
      $("#film-grid").empty();
      $("#actor-container").empty();
      $("#loader").show();
      var chosenDirector = $(e.target).text();
      $("h1#director-name").text(chosenDirector);
      // Query fireBase based on selection
      var query = firebase.database().ref("Films/" + chosenDirector );
      // Get a snapshot of all of the data
      query.once("value")
      .then(function(snapshot) {
         var data = snapshot.val();
         setTimeout(function() {
            buildFilms(data);
            buildActorInput(data);
            $("#loader").hide();
         }, 500)
      });
      // window.location.hash = chosenDirector;
   }

   // $(window).on("popstate", function() {
   //    if ( !window.location.hash ) {
   //       location.reload();
   //    } else {
   //       $("#film-grid").empty();
   //       $("#actor-container").empty();
   //       $("#loader").show();
   //       $(".filmic-page.active").removeClass("active").next().addClass("active");
   //       var chosenDirector = window.location.hash.substr(1),
   //           query = firebase.database().ref("Films/" + chosenDirector );
   //           $("h1#director-name").text(chosenDirector);
   //       query.once("value")
   //       .then(function(snapshot) {
   //          var data = snapshot.val();
   //          setTimeout(function() {
   //             buildFilms(data);
   //             buildActorInput(data);
   //             $("#loader").hide();
   //          }, 500)
   //       });
   //    }
   // })

   // Build out the films
   function buildFilms(films) {
      for ( i = 0; i < films.length; i ++ ) {
         var numOfActors = films[i].Actors.length,
             numOfWriters = films[i].Writer.length,
             filmDiv = $("<div id='film" + i + "' class='film film-card col-sm-6 col-md-4'><div class='film-heading'><a target='blank' href='' class='film-link'></a></div><div class='film-info'><img class='film-poster' /><div class='film-details'><div class='film-actors'><span><h2>Starring:</h2><div class='sep'></div></span></div><div class='film-writers'><span><h2>Written By:</h2><div class='sep'></div></span></div><div class='film-year'><span><h2>Year: </h2></span></div></div></div></div>"),
             filmTitle = $("<h1></h1>");
         filmTitle.text(films[i].Title);
         $("#film-grid").append(filmDiv);
         $("#film" + i).children('.film-heading').append(filmTitle);
         listActors(films, numOfActors);
         listWriters(films, numOfWriters);
         showYear(films);
         appendLink(films);
         showImage(films);
      }
   }

   // List out Actors per film
   function listActors(films, numOfActors) {
      for ( subindex = 0; subindex < numOfActors; subindex ++ ) {
         var actorTitle = $("<h2 class='actor'></h2>");
         actorTitle.text(films[i].Actors[subindex]);
         $("#film" + i).find('.film-actors').append(actorTitle);
      }
   }

   // List out Actors per film
   function listWriters(films, numOfWriters) {
      for ( subindex = 0; subindex < numOfWriters; subindex ++ ) {
         var writerTitle = $("<h2 class='actor'></h2>");
         writerTitle.text(films[i].Writer[subindex]);
         $("#film" + i).find('.film-writers').append(writerTitle);
      }
   }

   // List years per film
   function showYear(films) {
      var yearSpan = $("<h4></h4>");
      yearSpan.text(films[i].Year);
      $("#film" + i).find('.film-year').append(yearSpan);
   }

   // Append the links
   function appendLink(films) {
      var filmLink = $('a.film-link');
      filmLink.prop("href", "http://www.imdb.com/title/" + films[i].id);
   }

   // Add poster images
   function showImage(films) {
      var filmTitle = films[i].Title,
          cleanTitle = filmTitle.replace(/\s+/g, '-').toLowerCase();
       $("#film" + i).find('img.film-poster').prop("src", "/wp-content/themes/jordan/filmic/img/posters/" + cleanTitle + ".jpg");
   }

   // Build the actor checkboxes
   function buildActorInput(films) {
      var actorArray = [];
      for ( i = 0; i < films.length; i ++ ) {
         var numOfActors = films[i].Actors.length;
         for ( subindex = 0; subindex < numOfActors; subindex ++ ) {
            actorArray.push(films[i].Actors[subindex]);
         }
      }
      var uniqueActorArray = [];
      $.each(actorArray, function(x, el){
         if($.inArray(el, uniqueActorArray) === -1) uniqueActorArray.push(el);
      })
      uniqueActorArray.forEach(function(actorName, index){
         var cleanName = actorName.replace(/\s+/g, '-').toLowerCase();
         $("#actor-container").append("<div class='checkbox'><input id='actor" + index + "' type='checkbox' value='" + cleanName + "'><label for='actor" + index + "'>" + actorName + "</label></div>");
      })
   }

   // Run the Year Search
   function yearSearch(e) {
      e.preventDefault();
      $(".film").hide();
      $("#loader").fadeIn();
      resetTitle();
      resetActors();
      var searchSelect = $('#year').val(),
          searchDecade = searchSelect[0],
          filmYears = $('.film h4');
      setTimeout(function() {
         filmYears.each(function() {
            var yearValue = $(this).text(),
                filmDecade = yearValue[2];
            if ( filmDecade === searchDecade) {
               $(this).closest(".film").show();
            } else if ( searchDecade === "0" ) {
               $('.film').show();
            }
          });
         $("#loader").hide();
      }, 500)
   }

   // Run the Actor Search
   function actorSearch(e) {
      $('.film').hide();
      $("#loader").fadeIn();
      e.preventDefault();
      resetYear();
      resetTitle();
      var film = $('.film'),
          selectedActors = $("#actor-search input:checked").map(function(){
            return $(this).val();
         }).get();
      film.each(function(){
         var actorName = $(this).find('h2');
         actorName.each(function(){
            var cleanName = $(this).text().replace(/\s+/g, '-').toLowerCase(),
                that = this;
            setTimeout(function(){
               if ( selectedActors.includes(cleanName) ) {
                  $(that).closest(".film").show();
               } else if ( selectedActors.length < 1 ) {
                  $('.film').show();
               }
               $("#loader").hide();
            }, 500);
          });
      });
   }

   // Narrow Actor Results
   function narrowActors() {
      var actorInput = $('#actor-input').val().toLowerCase();
      $("#actor-container").find(".checkbox").hide()
      .filter(function() {
      return this.innerText.toLowerCase().indexOf(actorInput) > -1;
      }).show();
   }

   // Title Search
   function titleSearch() {
      $('.film').hide();
      $("#loader").fadeIn();
      resetYear();
      resetActors();
      var titleInput = $('#title').val().toLowerCase(),
          filmTitles = $('.film h1');
      setTimeout(function() {
         filmTitles.each(function() {
            var titleValue = $(this).text().toLowerCase();
            if ( titleValue.includes(titleInput) ) {
               $(this).closest(".film").show();
            }
         });
         $("#loader").hide();
      }, 500)
   }

   // Removed Year Selections
   function resetYear() {
      var selectedYear = $('#year option:selected');
      selectedYear.prop("selected", false);
   }

   // Reset Title Search
   function resetTitle() {
      var titleSearch = $("#title");
      titleSearch.val('');
   }

   // Reset Actors
   function resetActors() {
      var actorCheckbox = $("#actor-search input");
      actorCheckbox.prop("checked", false);
      $("#actor-input").val('').trigger('keyup');
   }

   // Clear Search
   function clearSearch(e) {
      e.preventDefault();
      resetActors();
      resetTitle();
      resetYear();
      $('.film').show();
   }

   // Page Routing Object
   PageRoute = {
        currentPage: '.filmic-page.active',
        directorLink: '#director-list li a',
        init: function() {
            $(this.directorLink).click(this.updatePage.bind(this));
        },
        updatePage: function() {
            $(this.currentPage).removeClass("active").next().addClass("active");
        }
   }