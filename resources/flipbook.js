var iTotalPages=0;
var book;
// var file=String(window.location).slice(-15);
// file="26001";
// load_ImageFlip('26001');
function load_ImageFlip(file){

	$.ajax({
	type:"POST",
	url:"ImageLoader.php",
	data:{filename:file}
	})
	.done(function(TotalPages){
	$('#flipbook').turn({
			width: 1400,
			height: 900,
			acceleration: !isChrome(),
			elevation: 50,
			gradients: true,
			autoCenter: true,
			pages: TotalPages,

			when: {
			
				turned: function(event, page, view)
						{
							book=$(this);
							if (page==1)
							{
								addPage(page, book,file);
								addPage(page+1, book,file);
							}
							else
							{
								addPage(page+1, book,file);
								addPage(page+2, book,file);
							}
						},
				},
		});
	});
	
}
	
$(window).bind('keydown', function(e)
{	
	if (e.keyCode==37)
		$('#flipbook').turn('previous');
	else if (e.keyCode==39)
		$('#flipbook').turn('next');
});
	
function isChrome()
{
	return navigator.userAgent.indexOf('Chrome/19')!=-1 || navigator.userAgent.indexOf('Chrome/20')!=-1;
}

function addPage(page, book,file)
{
	var id, pages = book.turn('pages');
	var element = $('<div />',
		{'class': 'page',
			css: {width: 600, height: 900}
		});
		book.prepend(element);
	if (book.turn('addPage', element, page))
	{
		loadPage(page, element,file);
	}
}

function loadPage(page, element,file)
{
	var img = $('<img />');
	img.attr("class","loader");
	element.prepend(img);
	$(".even").css("box-shadow","");
	Send(page, element, img,file);
}

function Send(page, element, loader,file)
{
	$.ajax({
	type:"POST",
	url:"ImageGenerator.php",
	data:{filename:file, current:page}
	})
	.done(function(path){
	loader.remove(".loader");
	element.css('background-image','url('+path+')');
	});
}

