@extends($themes)
@section('title', 'Details')    
@section('style')

.navbar.is-white {
  background: #F0F2F4;
}
.navbar-brand .brand-text {
  font-size: 1.11rem;
  font-weight: bold;
}
.hero-body{
  background-image: url({{ url('assets/cluster/compressed/'.$main->img_src) }});
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  height: 350px;
}
.articles {
  margin: 5rem 0;
  margin-top: -200px;
}
.articles .content p {
    line-height: 1.9;
    margin: 15px 0;
}
.author-image {
    position: absolute;
    top: -30px;
    left: 50%;
    width: 60px;
    height: 60px;
    margin-left: -30px;
    border: 3px solid #ccc;
    border-radius: 50%;
}
.media-center {
  display: block;
  margin-bottom: 1rem;
}
.media-content {
  margin-top: 3rem;
}
.article, .promo-block {
  margin-top: 6rem;
}
div.column.is-8:first-child {
  padding-top: 0;
  margin-top: 0;
}
.article-title {
  font-size: 2rem;
  font-weight: lighter;
  line-height: 2;
}
.article-subtitle {
  color: #909AA0;
  margin-bottom: 3rem;
}
.article-body {
  line-height: 1.4;
  margin: 0 6rem;
}
.promo-block .container {
  margin: 1rem 5rem;
}
.content figure {
    margin-left : 0px !important;
    margin-right : 0px !important;
}

/* Style the Image Used to Trigger the Modal */
.myImg {
  cursor: zoom-in;
  transition: 0.3s;
}

.myImg:hover {opacity: 0.9;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  z-index: 1; /* Sit on top */
  position: fixed; /* Stay in place */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
img.modal-content {
  margin: auto;
  display: block;
  max-width: 100%;
  max-height: 100%;
  position: relative;
  top: 50%;
  transform: translateY(-50%);
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}

@stop
@section('content')
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <div class="navbar-item">
        <div class="buttons">
          <a href="{{ route('main.view', ['themes' => $themes , 'name' => Str::lower($main->name)]); }}" class="navbar-item button is-danger"><i class="fa-solid fa-angle-left"></i></a>
        </div>
      </div>
    </div>
  </div>
</nav>  
<section class="hero is-info is-medium is-bold">
    <div class="hero-body">
    </div>
</section>


<div class="container">
    <!-- START ARTICLE FEED -->
    <section class="articles">
        <div class="column is-8 is-offset-2">
            <!-- START ARTICLE -->
            <div class="card article">
                <div class="card-content">
                    <div class="media">
                        <div class="media-content has-text-centered">
                            <p class="title article-title">{{ $main->name }}</p>
                            <div class="tags has-addons level-item">
                                <span class="tag is-rounded is-info">{{ $attribute->jalan }}</span>
                                <span class="tag is-rounded">NO {{ $attribute->no }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="content article-body" style="padding-bottom:80px;">
                       <p> Type: 
                            <pre>{{ $attribute->type_kavling }}</pre>
                        </p>
                        <p> Jalan: 
                            <pre>{{ $attribute->jalan }}</pre>
                        </p>
                        <p> No: 
                            <pre>{{ $attribute->no }}</pre>
                        </p>
                    </div>
                </div>
            </div>
            <!-- END ARTICLE -->
            <!-- START ARTICLE -->
            @foreach($details AS $rows)
            <div class="card article" id="{{ $rows->header }}">
                <div class="card-content">
                    <div class="content article-body">
                        <figure class="image is-fullwidth">
                                <img class="myImg" src="{{ url('assets/cluster/details/'.$main->name.'/'.$rows->img_src) }}">
                 
                        </figure>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- END ARTICLE -->
          </div>

    </section>
    <!-- END ARTICLE FEED -->
</div>
<!-- Modal yang akan digunakan oleh gambar di atas -->
<div class="modal">
  <img class="modal-content">
</div>
@stop
     
@section('script')
<script>
// Get the modal
var modal = document.querySelector(".modal");
var modalImg = document.querySelector(".modal-content");
Array.from(document.querySelectorAll(".myImg")).forEach(item => {
  item.addEventListener("click", event => {
    modal.style.display = "block";
    modalImg.src = event.target.src;
  });
});

// When the user clicks image or modal, close the modal
document.querySelector(".modal").addEventListener("click", () => {
  modal.style.display = "none";
});
</script>
@stop