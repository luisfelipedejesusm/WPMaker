<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
          
	<style type="text/css">
		button{
			padding: 30px;
			background-color: rgba(52, 152, 219,1.0);
			border: 3px solid #2980b9;
			color: white;
			margin: 10px;
		}
		.draggable{
			position: absolute !important;
		}
		.fab-button{
			z-index: 99999;
			width: 50px; 
			height: 50px;
			border-radius: 45px; 
			background-color: red; 
			color: white; 
			border: none; 
			padding: 0; 
			box-shadow: 1px 1px 1px gray; 
			line-height: 50px; 
			text-align: center; 
			font-size: 25px; 
			font-weight: 900;
			cursor: pointer;
			transition: all 0.2s ease;
		}
		.fab-button:hover{
			box-shadow: 2px 1px 3px gray;
			width: 60px; 
			height: 60px;
			line-height: 60px;
			cursor: pointer; 
		}
		.fab-bottom-right{
			position: fixed; 
			bottom: 0; 
			right: 0; 
			margin: 20px;
		}
		.menu{
			overflow-y: scroll;
			overflow-x: hidden;
			width: 25%;
			position: fixed;
			right: 0;
			margin-top: -10px;
			box-shadow: 1px 0px 5px black;
			z-index: 99999;
			display: none;
			background-color: rgba(189, 195, 199,0.5);

		}
		.menu #objects button, 
		.menu .propiedades button,
		.menu .propiedades input[type=text]{
			box-shadow: -1px 1px 10px #2c3e50;
		}
	</style>
</head>
<body>
	<a class="fab-button fab-bottom-right" id="show_menu">+</a>
	<div class="menu" id="menu">
		<div id="objects">
			<button onclick="addSomething()" class="">Add Something</button>
			<button onclick="save()" class="">Save</button>
		</div>
		<div class="propiedades">
			<div id="buttons">
				<input type="text" id="txtNompreP" style="margin: 10px; padding: 10px;">
				<input type="text" id="txtValue" style="margin: 10px; padding: 10px;">
				<button id="apply">Apply</button>
			</div>			
		</div>		
	</div>
	
	<div class="body">
		{!! $page !!}
	</div>
	<script type="text/javascript">

		var selectedObject;

		$('#show_menu').click(function(){
			$('#menu').toggle('fast');
		})
		$('.draggable').click(function(){
			selectedObject = this;
		})
		$('#apply').click(function(){
			$(selectedObject).css($('#txtNompreP').val(),$('#txtValue').val());
		})
		$('#so').click(function(){
			console.log(selectedObject);
		})

		$(document).ready(function(){
			$('.draggable').draggable({
				cancel:false,
				stop: function( event, ui ) {
				   var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) )+ "%" ;
				    var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) )+ "%" ;
				    $(this).css("left" , l);
				    $(this).css("top" , t);
				  }
			});
			$(".draggable").click(function(event){
    event.preventDefault();
});
		});
		function addSomething(){
			var newButton = $('<button style="position:absolute;" class="draggable">').html('asdasd');
			$('.body').append(newButton);
			newButton.draggable({
				cancel:false,
				stop: function( event, ui ) {
				   var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) )+ "%" ;
				    var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) )+ "%" ;
				    $(this).css("left" , l);
				    $(this).css("top" , t);
				  }
			});
			$('.draggable').click(function(){
				selectedObject = this;
			})
		}
		function save(){
			console.log($('html').html());
			$.ajax({
		      type : 'Post',
		      data: {
		        _token: '{{csrf_token()}}',
		        page: $('.body').html()
		      },
		      url : '{{url("/save")}}',
		      dataType: 'Json',
		      success : function(data){
		        if(data.message == 'success'){
		          alert('guardado');
		        }else{
		          alert('error');
		        }            
		      },
		      error: function (jqXHR, exception) {
		          console.log(jqXHR.responseText);
		        }
		    })
		}
	</script>
</body>
</html>