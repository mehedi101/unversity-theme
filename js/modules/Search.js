import $ from 'jquery';
class Search {
  //describe & initiate / create our opbject
  constructor(){
  this.searchHTML();
  this.searchResultDiv = $("#search-overlay__results")
  this.openButton = $('.js-search-trigger');
  this.closeButton = $('.search-overlay__close');
  this.searchOVerlay = $('.search-overlay');
  this.searchField = $('#search-term');
  this.isOverlayOpen = false;
  this.isSpinnerVisible = false;
  this.searchTimer;
  this.previousSearchVal;
  this.events();
  }


  // events
  events(){
    this.openButton.on('click', this.openOverlay.bind(this));
    this.closeButton.on('click', this.closeOverlay.bind(this));
    $(document).on("keydown", this.keypressDispatcher.bind(this));
    this.searchField.on('keyup', this.searchLogic.bind(this));
  }


  searchLogic(){
    if(this.searchField.val() != this.previousSearchVal){

      clearTimeout(this.searchTimer);

      if(this.searchField.val()){
        if( !this.isSpinnerVisible){
          this.searchResultDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.searchTimer = setTimeout(this.getResults.bind(this), 750);
      }else {
        this.searchResultDiv.html("");
        this.isSpinnerVisible = false;
      }



    }
    this.previousSearchVal = this.searchField.val();
  }

  getResults(){
     let query = this.searchField.val();
      let postsAPI = universityData.root_url + '/wp-json/wp/v2/posts?search=' + query;
      let pagesAPI = universityData.root_url + '/wp-json/wp/v2/pages?search=' + query;

    $.when($.getJSON(postsAPI), $.getJSON(pagesAPI)).then( (posts, pages) =>{
       let combinedResults = posts[0].concat(pages[0]);
      let result = '<h2 class="search-overlay__section-title">General Information</h2>'
      if( combinedResults.length){
        result += `
         <ul class="link-list min-list">
              ${combinedResults.map(item => `<li><a href="${item.link}">${item.title.rendered}</a> </li>`).join('')}
          </ul>
       `}else {
        result += `<p>No Geneneral information that matches search.</p>`
      }
      this.searchResultDiv.html(result);
    }, () => this.searchResultDiv("<p>Unexpected error, Try agian later!</p>"));

       this.isSpinnerVisible = false;
  }


  keypressDispatcher(e){
    if( e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(":focus")){
      this.openOverlay();
   //   console.log('Times of key event calling')
    }
    if(e.keyCode == 27  && this.isOverlayOpen){
      this.closeOverlay();
    }

  //  console.log(e.keyCode);
  }
  //methods
   openOverlay(){
      this.searchOVerlay.addClass('search-overlay--active');
      $('body').addClass('body-no-scroll');
      this.searchField.val('');
      setTimeout(() => this.searchField.focus(), 301);
      this.isOverlayOpen = true
  }

  closeOverlay(){

    this.searchOVerlay.removeClass('search-overlay--active');
    this.isOverlayOpen = false;
    $('body').removeClass('body-no-scroll');
  }


  searchHTML(){
    $('body').append(`
    <div class="search-overlay">
    <div class="search-overlay__top">
        <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>

        </div>
        <div class="container">
            <div id="search-overlay__results"></div>
        </div>
    </div>

</div>
    `)
  }

}

export default Search;