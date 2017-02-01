jQuery(document).ready(function($){
//custom ganesh theme script
var carousel = '.ganesh-carousel-thumb';
	
	ganesh_get_bs_thumbs(carousel);

	$(carousel).on('slid.bs.carousel', function(){		ganesh_get_bs_thumbs(carousel); 	});
	
	function ganesh_get_bs_thumbs( carousel ){
		$(carousel).each(function(){
				var nextThumb = $(this).find('.item.active').find('.next-image-preview').data('image');
				var prevThumb = $(this).find('.item.active').find('.prev-image-preview').data('image');
				$(carousel).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image' : 'url('+nextThumb+')' });
				$(carousel).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image' : 'url('+prevThumb+')' });
		});
	}

//Scroll to top script
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > $(this).height()) { 
            $('#scroll').fadeIn(); 
        } else { 
            $('#scroll').fadeOut(); 
        } 
    }); 
    $('#scroll').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 

//Load More script
var btnloadmore = document.getElementById("btnloadmore");
var loadmorecontainer = document.getElementById("moreposts");

$("#btnloadmore").on("click", function(){
	var  xhttp = new XMLHttpRequest();
 	xhttp.open("GET", magicaldata.siteurl+"/wp-json/wp/v2/posts");
 	xhttp.onload=function(){
	 		if(xhttp.status>=200 && xhttp.status < 400){
	 			var data = JSON.parse(xhttp.responseText);
	 			createHTML(data);
	 			btnloadmore.remove();
	 		}else{
	 			console.log("we connect to server, but it returned an error");
	 		}
	 	};
 	xhttp.error = function(){
 		console.log("connection error");
 	};
 	xhttp.send();
});

function createHTML(postsData){
	var ourhtmlstring = '';
	for(i=0; i<postsData.length; i++){
		ourhtmlstring += '<article id="post-'+ postsData[i].id +'"><header class="entry-header text-center"><h1 class="entry-title">';
		ourhtmlstring += '<a href="'+ postsData[i].link +'">'+ postsData[i].title.rendered +'</a></h1></header>';
		ourhtmlstring += '<div class="entry-content">'+postsData[i].content.rendered + '</div>';
		ourhtmlstring += '<div class="button-container"><a class="btn btn-default" href="'+ postsData[i].link +'">Read More</a></div></article>';		
	}
	loadmorecontainer.innerHTML += ourhtmlstring;
}


//Quick add post ajax
var quickaddbutton = document.getElementById("quick-add-button");
if(quickaddbutton){
	$("#quick-add-button").on("click", function(){
			var newpostdata = {
				"title" : document.querySelector('.admin-quick-add [name="title"]').value,
				"content" : document.querySelector('.admin-quick-add [name="content"]').value,
				"status" : "publish"
			}

			var createpost = new XMLHttpRequest();
			createpost.open('POST', magicaldata.siteurl+'/wp-json/wp/v2/posts');
			createpost.setRequestHeader("X-WP-Nonce", magicaldata.nonce);
			createpost.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
			createpost.send(JSON.stringify(newpostdata));
			createpost.onreadystatechange = function(){
				if(createpost.readyState == 4){
					if(createpost.status == 201){
						document.querySelector('.admin-quick-add [name="title"]').value = '';
						document.querySelector('.admin-quick-add [name="content"]').value = '';
					}else{
						alert("Error - try again");
					}
				}
			}
	});
}
});