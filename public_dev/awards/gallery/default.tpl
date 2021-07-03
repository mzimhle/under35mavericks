<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Under 35 Maverick Awards</title>
<meta name="description" content="The Maverick Awards for South African Youth Entrepreneurship Excellence represented South Africa’s first award ceremony held to honour the excellence of young entrepreneurs across the country">
<link rel="stylesheet" href="/library/javascript/jquery-ui.css" />
{include_php file='awards/includes/css.php'}
<link rel="stylesheet" href="/awards/css/lightbox.css">
</head>
<body>
<div class="mp-pusher" id="mp-pusher">
{include_php file='awards/includes/menu.php'}
    <section class="bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="txt-black">Gallery</h1>
                </div>
                <div class="col-sm-12">
                    <p class="txt-black">Gallery images to be uploaded soon.</p>
                </div>				
            </div>
        </div>
		<!-- 
        <div class="container-fliud">
            <div class="row no-pad">
                <div class="col-md-4 col-lg-3">
                    <div class="grid">
                        <figure class="effect-sarah">
						<a href="/awards/images/gal_img_01.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="Image Title" data-footer="Short Image description">
                            <img src="/awards/images/gal_img_01.jpg" alt=""/>
						<figcaption>
							<h2>Image Title</h2>
							<p>Short Image description</p>
						</figcaption>
                        </a>
					   </figure>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="grid">
                        <figure class="effect-sarah">
						<a href="/awards/images/gal_img_02.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="Image Title" data-footer="Short Image description">
                            <img src="/awards/images/gal_img_02.jpg" alt=""/>
						<figcaption>
							<h2>Image Title</h2>
							<p>Short Image description</p>
						</figcaption>
                        </a>
					   </figure>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="grid">
                        <figure class="effect-sarah">
						<a href="/awards/images/gal_img_03.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="Image Title" data-footer="Short Image description">
                            <img src="/awards/images/gal_img_03.jpg" alt=""/>
						<figcaption>
							<h2>Image Title</h2>
							<p>Short Image description</p>
						</figcaption>
                        </a>
					   </figure>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="grid">
                        <figure class="effect-sarah">
						<a href="/awards/images/gal_img_03.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="Image Title" data-footer="Short Image description">
                            <img src="/awards/images/gal_img_03.jpg" alt=""/>
						<figcaption>
							<h2>Image Title</h2>
							<p>Short Image description</p>
						</figcaption>
                        </a>
					   </figure>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="grid">
                        <figure class="effect-sarah">
						<a href="/awards/images/gal_img_01.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="Image Title" data-footer="Short Image description">
                            <img src="/awards/images/gal_img_01.jpg" alt=""/>
						<figcaption>
							<h2>Image Title</h2>
							<p>Short Image description</p>
						</figcaption>
                        </a>
					   </figure>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="grid">
                        <figure class="effect-sarah">
						<a href="/awards/images/gal_img_03.jpg" data-toggle="lightbox" data-gallery="multiimages" data-title="Image Title" data-footer="Short Image description">
                            <img src="/awards/images/gal_img_03.jpg" alt=""/>
						<figcaption>
							<h2>Image Title</h2>
							<p>Short Image description</p>
						</figcaption>
                        </a>
					   </figure>
                    </div>
                </div>
            </div>
        </div>
		-->
    </section>
{include_php file='awards/includes/footer.php'}
</div>
{literal}
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>-->
<script src="/library/javascript/jquery-2.1.0.min.js"></script>
<!--<script src="/library/javascript/bootstrap.min.js"></script>-->
<script src="/library/javascript/bootstrap.js"></script>
<script src="/library/javascript/velocity.min.js"></script>
<script src="/library/javascript/classie.min.js"></script>
<script src="/library/javascript/mlpushmenu.min.js"></script>
<script src="/library/javascript/lightbox.min.js"></script>
{literal}
<script>
    $(document).ready(function(){
            
        new mlPushMenu( document.getElementById('mp-menu'), document.getElementById('trigger'), {
            type: 'cover'
        });
        /*
        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox({
						always_show_close: true
					});
				});
				*/
    });
</script>
{/literal}
</body>
</html>