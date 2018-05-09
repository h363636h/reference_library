<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Reference Library</title>
    <link rel="stylesheet" href="css/custom.css" />
    <link rel="stylesheet" href="css/prism.css" />
    <link rel="stylesheet" href="css/flatnav.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="css/jqueryFileTree.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />    
    <link rel="stylesheet" type="text/css" href="css/tag.css" />   
    <link rel="stylesheet" type="text/css" href="css/button.css" />
    <link rel="stylesheet" type="text/css" href="css/img.css" />     
    <link rel="stylesheet" type="text/css" href="css/tag_tree.css" /> 
    <link rel="stylesheet" type="text/css" href="css/glyphicon.css" />
    <link rel="stylesheet" type="text/css" href="css/video_detail.css" />    
    
    <link rel="stylesheet" type="text/css" href="css/jquery.treeview.css" />   
    <link rel="stylesheet" type="text/css" href="css/screen.css" />   
    
    <link rel="stylesheet" type="text/css" href="css/interval.css" />   
    
    <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
    <script src='js/drag.js' type='text/javascript'></script>
    <script src="js/modernizr.custom.js"></script>

    <script src='js/clipboard.js' type='text/javascript'></script>
    <script src='js/clipboard.min.js' type='text/javascript'></script>

    <script src="js/jqueryFileTree.js" type='text/javascript'></script>
<!--    <script src="js/jquery.cookie.js" type='text/javascript'></script>
    <script src="js/jquery.treeview.js" type="text/javascript"></script> -->

  <link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript">

        $(document).ready (function() {
                    $('.filetree').fileTree({
                        root : '/DATA/reference/',
//                         root: '//reference/',
                        script: 'connectors/jqueryFileTree.php',
                        multiFolder : false
                        
                    }, function (file) {
                        var path = file;
						$.ajax({
							url : 'main.php?path='+path,
							dataType : 'html'
						})
						.done(function(data){
							$('#gallery').html(data);
						});
                    });	

        });

        function delete_tag_popup(idx,path,tag){
            var popUrl = "delete_tag_form.php?idx=" + idx + "&path=" + path + "&tag=" +tag;
            var popOption = "width=370,  height=150, top=500, left=700, resizable=no, scrollbars=no, status=no";
            window.open(popUrl,"",popOption);
        }

        function delete_img_popup(idx,tag,path){
            var popUrl = "delete_img_form.php?idx=" + idx + "&tag=" + tag + "&path=" + path;
            var popOption = "width=370, height=140,resizable=no, scrollbars=no, status=no;";
            window.open(popUrl,"",popOption);
        }

        var window_name;
        function detail(img_id,img_name,img_path,path,word){
            // console.log(img_name);
            // var img_name = img_name;
            var rep_img_name = img_name.replace("&","00000");
            
            var popUrl = "detail.php?img_id=" + img_id + "&img_name=" +rep_img_name +"&img_path="+img_path+"&path="+path+"&word="+word;
			var auto_height = parseInt(window.innerWidth)*0.3
            var popOption = "width=1500, height=900, resizable=yes, scrollbars=yes, status=no";
            window_name = window.open(popUrl,"detail_pop",popOption);

            // alert(window_name.name);

            }

        function tag_search(path,tag){
            var path = path;
            var tag = tag;
            
			$.ajax({
				url : 'main.php?path='+ path + '&tag_name=' + tag,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
			
        }
                
        function reloadDiv(path) {
            var path = path;
			$.ajax({
				url : 'main.php?path='+ path,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }
        
        function reloadDiv_interval(start_sum,end_sum,path,img_name){
			$.ajax({
				url : "main.php?start_sum="+ start_sum + "&end_sum=" + end_sum + "&path="+path + "&img_name="+img_name,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        } 
                
        $(document).ready(function(){
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) {
                    $('.scrollToTop').fadeIn();
                } else {
                    $('.scrollToTop').fadeOut();
                }
            });

            $('.scrollToTop').click(function(){
                $('html, body').animate({scrollTop : 0},800);
                return false;
            });

        });
            
        function sel(path,type){
	            $.ajax({
	                url : 'main.php?path=' + path + '&type='+type,
	                dataType : 'html'
	            })
	            .done(function(data){
	                $('#gallery').html(data);
	            });
            }
        
        function sel2(word,task,type){
            $.ajax({
                url : 'main.php?word=' + word +'&task='+task+ '&type='+type,
                dataType : 'html'
            })
            .done(function(data){
                $('#gallery').html(data);
            });
        }

        function tag_drop(ev,target,path,tag) {
            ev.preventDefault();
            var data= ev.dataTransfer.getData("text");
            var path = path;
            var update_depth = target.id;

            ev.target.appendChild(document.getElementById(data));
			$.ajax({
				url : 'update_depth.php?tag='+ data + '&path='+path + '&update_depth=' + update_depth,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }

        function tag_root_drop(ev,target,path,tag,root_) {

            ev.preventDefault();
            var data= ev.dataTransfer.getData("text");
            var path = path;
            var update_depth = target.id;

            ev.target.appendChild(document.getElementById(data));
            // alert(data);
            $.ajax({
                url : 'update_depth.php?tag='+ data + '&path='+path + '&update_depth=' + update_depth+"&root="+root_,
                dataType : 'html'
            })
            .done(function(data){
                $('#gallery').html(data);
            });
        }

        $(document).ready(function(){
        	$('.list > li a').click(function() {
        	    $(this).parent().find('.sub').slideToggle();
        	});
        });

        function divClicked() {
            var divHtml = $(this).html();
            var editableText = $("<input type='text' />");
            editableText.val(divHtml);
            $(this).replaceWith(editableText);
            editableText.focus();
            editableText.blur(editableTextBlurred);
        }

        function editableTextBlurred() {
            var html = $(this).val();
            var viewableText = $("<div>");
            viewableText.html(html);
            $(this).replaceWith(viewableText);
            viewableText.click(divClicked);
        }      

        function add_cate_tag(position,path){
            var popUrl = "insert_tag_form.php?position=" + position +  "&path=" + path;
            var popOption = "width=370, height=280,resizable=no, scrollbars=no, status=no;";
            window.open(popUrl,"",popOption);
        }

        function get_path(path,full_path){

            full_path = full_path.replace("'","\'");

            $.ajax({
                type : "post",
                url : "main.php",
                data : {path:path,full_path:full_path},
                dataType : "html"
            })
            .done(function(data){
                $('#gallery').html(data);
                window.scrollTo(0,0);
            });
        }        
        
        function word_get_path(full_path,task,word){
			$.ajax({
				url : 'main.php?full_path=' + full_path + '&task='+task+'&word='+word,
				dataType : 'html'
			}).done(function(data){
				$('#gallery').html(data);
                window.scrollTo(0,0);
			});
        }      

        function form_submit(path){
            var path = path;
            $('#tag_search_form2').submit(function(){

                var tag_name = $('#tag_search_text').val();

    			$.ajax({
				url : 'main.php?path='+ path + '&tag_name=' + tag_name,
				dataType : 'html'
				}).done(function(data){
				    $('#gallery').html(data);
			    });                          
            });
          }

        function get_interval(start_frame,end_frame,full_path,path){
            start_sum = start_frame/24;
            end_sum = end_frame/24;
            $.ajax({
                url : 'main.php?path=' + path + '&start_sum='+start_sum+'&interval_full_path='+full_path+'&end_sum='+end_sum,
                dataType : 'html'
            })
            .done(function(data){
                $('#gallery').html(data);
            });
        }       
	</script>
</head>
<body>
    <ul class="nav">
       <b style="color:white; margin-left:3%; float:left; margin-top:0.5%; font-size:22px;"> Reference Library</b>
            <form name="search" method="get" action="index.php" style="width:400px;margin-left:70%;margin-top:10px;border:2px solid white; border-radius : 20px;">
			    <select name="task" style="background: none;color:white;font-size:15px; border-left:none; border-top:none; border-bottom:none; border-right : 2px solid white; padding-left : 2%;font-weight : bold;" >
			    	<option value="all" style="color : #2A5FA3; important!">All</option>
			    	<option value="tag"  style="color : #2A5FA3; important!">Tag</option>
			    	<option value="filename"  style="color : #2A5FA3; important!">File</option>
                    <option value="description"  style="color : #2A5FA3; important!">Description</option>
			    </select>
                <input type="text" name="word" id="tag_search" style="width:230px; height:30px; font-size: 15px; background:none; border:none; color:white;"/>
                <input type="image" src="images/search.png" alt="submit" style="padding-top: 2%;">
            </form>
    </ul>

<div class="line2">
	<div class="col1">

	    <div class="menu">
	        <div class="filetree"></div>
	        <br/>
	    </div>
	    
    </div> 

    <div class="col2">
    	<div id="gallery">
    	   <?php include "main.php";?>
		</div>
    </div>

 </div>

 <div class="clear"></div>

</body>
</html>
