<html lang="en">
<head>
<title>Simplest jQuery Slideshow</title>
 
<style>
body {font-family:Arial, Helvetica, sans-serif; font-size:12px;}
 
.fadein { 
position:relative; 
height:450px; 
width:100%; 
margin:0 auto;
padding: ;
 }

.fadein img{
	position:absolute;
	width: 100%;
    height: 100%;
    object-fit: cover;
	border-radius: 0.5%;
}
</style>
 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>
$(function(){
	$('.fadein img:gt(0)').hide();
	setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 3000);
});
</script>
 
</head>
<body>
<div class="fadein">
<?php 
// display images from directory
// directory path
$dir = "./slider/";
 
$scan_dir = scandir($dir);
foreach($scan_dir as $img):
	if(in_array($img,array('.','..')))
	continue;
?>
<img src="<?php echo $dir.$img ?>" alt="<?php echo $img ?>">
<?php endforeach; ?>
</div>
</body>
</html>