<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Under 35 Maverick Awards</title>
<meta name="keywords" content="maverick awards gallery, 2014 / 2015 images, maverick awards people, view gallery" />
<meta name="description" content="These are the maverick awards image gallery for the previous years, see what we get up to at the awards and hopefully join us" />
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="21 days">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta property="og:title" content="Under 35 Mavericks"> 
<meta property="og:image" content="http://www.under35mavericks.com/awards/images/35_logo.png"> 
<meta property="og:url" content="http://www.under35mavericks.com">
<meta property="og:site_name" content="Under 35 Mavericks">
<meta property="og:type" content="website">
<meta property="og:description" content="These are the maverick awards image gallery for the previous years, see what we get up to at the awards and hopefully join us">
<link rel="icon" type="image/x-icon" href="http://www.under35mavericks.com/favicon.ico" />
<link rel="icon" href="http://www.under35mavericks.com/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/library/javascript/jquery-ui.css" />
{include_php file='awards/includes/css.php'}
<link rel="stylesheet" href="/awards/css/lightbox.css">
</head>
<body>
<div class="mp-pusher" id="mp-pusher">
{include_php file='awards/includes/menu.php'}
    <section class="bg-grey">
        <div class="container-fluid no-pad">
            <div class="row no-pad">
				{foreach from=$galleryimageData item=gallery}
                <div class="col-sm-6 col-md-4 col-lg-2">
                    <div class="grid"> 
                        <figure class="effect-sarah">
				            <a href="{$gallery.galleryimage_path}/big_{$gallery.galleryimage_code}{$gallery.galleryimage_ext}" data-toggle="lightbox" data-gallery="multiimages" data-title="2014 Album" data-footer="...">
                            <img src="{$gallery.galleryimage_path}/tmb_{$gallery.galleryimage_code}{$gallery.galleryimage_ext}" alt="" class="img-responsive" />
                            <figcaption>
                                <h2>&nbsp;</h2>
                                <p>&nbsp;</p>
                            </figcaption>
                            </a>
					   </figure>
                    </div>
                </div>
				{/foreach}
            </div>
        </div>
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
<script>
    $(document).ready(function(){
            
        new mlPushMenu( document.getElementById('mp-menu'), document.getElementById('trigger'), {
            type: 'cover'
        });

        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
            event.preventDefault();
            return $(this).ekkoLightbox({
                always_show_close: true
            });
        });
    });
</script>
{/literal}
</body>
</html>