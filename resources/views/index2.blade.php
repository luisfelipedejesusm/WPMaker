<!DOCTYPE html>
<html>
<head>
	<title>WPMaker v2.0</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://use.fontawesome.com/bf536de81b.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
	<script src="{{asset('public/jscolor.js')}}"></script>
    <style type="text/css">
    	html{
    		font-family: sans-serif !important;
    	}
    	.add-button{
    		margin: 20px;
    		position: fixed;
    		right: 0;
    		bottom: 0;
    	}
    	.menu{
			overflow-x: hidden;
			width: 90%;
			height: 90%;
			margin: 5%;
			padding: 15px;
			z-index: 101;
		}
		.menu input[type=text]{
			width: 85%;
		}
		.menu-wrapper{
			box-shadow: 1px 0px 5px black;
			position: fixed;			
			overflow-y: scroll;
			width: 30%;
			background-color: rgba(189, 195, 199,0.5);
			right: 0;
			z-index: 101;
			max-height: 100%;
		}
		.propiedades{
			padding: 25px;
    		box-shadow: 0px 2px 4px grey;
    		margin-top: 50px;
		}
		.propiedades-texto{
			margin-top: -39px;
		    font-size: 1rem;
		    color: white;
		    /* text-shadow: 0.5px 0.5px 1px black; */
		    background-color: #26a69a;
		    padding: 7px !important;
		    border-radius: 5px;
		}
		.jscolor{
			color: transparent !important;
			cursor: pointer;
		}
		.focusObject{
			border-radius: 5px;
			box-shadow: 0px 0px 10px 3px #26a69a;
			/*border: 3px solid #2980b9;
			border-collapse: separate;
			border-spacing: 30px;*/
			animation-name: example;
		    animation-duration: 1.5s;
		    animation-iteration-count: infinite;
		}
		p:hover{
			cursor: default;
		}
		.body p{
			display: inline-block;
			max-width: 50%;
		}
		@keyframes example {
		    0%   {box-shadow: 0px 0px 10px 3px #26a69a;}
		    50%  {box-shadow: 0px 0px 10px 3px transparent;}
		    100%  {box-shadow: 0px 0px 10px 3px #26a69a;}
		}
		.label-active{
			font-size: 0.8rem !important;
		    -webkit-transform: translateY(-140%);
		    transform: translateY(-140%);
		}
		fieldset{
			border-radius: 5px;
			box-shadow: 1px 1px 2px gray;	
		}
		fieldset input{
			font-size: 0.8rem !important;
		}
		fieldset input::-webkit-outer-spin-button,
		fieldset input::-webkit-inner-spin-button {
		    /* display: none; <- Crashes Chrome on hover */
		    -webkit-appearance: none;
		    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
		}
		fieldset legend{
			background-color: #26a69a; 
			color: white;
			padding: 1px 10px;
			border-radius: 5px;
		}
		fieldset legend [type="checkbox"].filled-in:not(:checked)+label:after{
			border: 2px solid #fff !important;
		}
		fieldset legend label{
			color: white;
		}
    </style>      
</head>
<body>
	<div class="add-button">
		<a class="btn-floating btn-large waves-effect waves-light red" id="show_menu"><i class="material-icons">add</i></a>
	</div>
	<div id="colorpickerdiv" style="position: fixed; bottom: 0;"></div>
	<div class="menu-wrapper">
		<div class="menu row" id="menu">
			<div id="objects" class="row">
				<div class="col s8" style="padding-left: 0;">
					<a href="#components" class="btn waves-effect waves-light" style="height: 80px; width: 100%; line-height: 80px;"><i class="fa fa-plus-square" aria-hidden="true"></i></a>		
				</div>
				<div class="col s4" style="padding-right: 0;">
					<a class="btn waves-effect waves-light" id="deleteComponent" style="height: 80px; width: 100%; line-height: 80px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
				</div>
				<div class="col s12" style="margin-top: 10px; padding-left: 0; padding-right: 0;">
					<button onclick="save()" class="btn waves-effect waves-light" style="height: 80px; width: 100%;"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
				</div>
			</div>
			<div class="propiedades row">
			<div class="propiedades-texto col s6"><center>Propiedades</center></div>
				<div id="buttons">
					
				</div>
				<div id="textProperties" style="display: none;">
					<div class="input-field col s12">
			          <textarea id="textCaption" class="materialize-textarea" style="max-height: 130px;"></textarea>
			          <label for="textCaption" class="label-active">Texto</label>
			        </div>
			        <div class="col s4">
			        	<label for="textSize">Tamaño</label>
			        	<input type="number" id="textSize">
			        </div>
			        <div class="col s4">
			        	<label for="textColor">Color</label>
			        	<input id="textColor" class="jscolor" style="height: 50px; color: transparent !important; border-radius: 50px; width: 80%;" spellcheck="false" >
			        </div>
			        <div class="col s2">
			        	<label for="textBold"><i class="fa fa-bold" aria-hidden="true"></i></label>			        
				        <p>
					      <input type="checkbox" class="filled-in" id="textBold"/>
					      <label for="textBold"></label>
					    </p>			        	
			        </div>
			        <div class="col s2">
			        	<label for="textItalic"><i class="fa fa-italic" aria-hidden="true"></i></label>			        
				        <p>
					      <input type="checkbox" class="filled-in" id="textItalic"/>
					      <label for="textItalic"></label>
					    </p>
			        </div>
			        <div class="input-field col s12">
			        	<select id="textDropdown">
			        		<option value="sans-serif">Sans-Serif</option>
			        		<option value="serif">Serif</option>
			        		<option value="cursive">Comic Sans</option>
			        		<option value="fantasy">Fantasy</option>
			        		<option value="monospace">Monospace</option>
			        	</select>
			        	<label>Estilo de Fuente</label>
			        </div>
			        <div class="col s12">
			        	<label for="tamanioContenedor">Tamaño del contenedor (%)</label>
			        	<p class="range-field">
						    <input type="range" id="tamanioContenedor" min="1" max="90" />
						</p>
			        </div>
			        <div class="col s12">
			        	<label for="zindex">Posicion Z (z-index)</label>
			        	<p class="range-field">
						    <input type="range" id="zindex" min="1" max="99" />
						</p>
			        </div>
			        <div class="col s12">
			        	<fieldset>
			        		<legend>
			        			<p>
							      <input type="checkbox" class="filled-in" id="textShadowCheck"/>
							      <label for="textShadowCheck">Sombra de Texto</label>
							    </p>
			        		</legend>
			        		<div style="display:none;" id="textShadowProps">
				        		<div class="col s3">
						        	<label for="textSize">X</label>
						        	<input type="number" id="textShadowPropX" value="1">
						        </div>
						        <div class="col s3">
						        	<label for="textSize">Y</label>
						        	<input type="number" id="textShadowPropY" value="1">
						        </div>
						        <div class="col s3">
						        	<label for="textSize">Z</label>
						        	<input type="number" id="textShadowPropZ" value="1">
						        </div>
						        <div class="col s3">
						        	<label for="textShadowColor">Color</label>
						        	<input id="textShadowColor" class="jscolor" style="height: 50px; color: transparent !important; border-radius: 50px; width: 80%; background-color: white;" spellcheck="false" >
						        </div>
					        </div>
			        	</fieldset>
			        </div>
				</div>	
				<div id="imgProperties" class="row" style="display: none;">
					<div class="valign-wrapper">
						<div class="col s9" style="padding-right: 0; margin-left: 0;">
							<label for="imgUrl">url</label>
				        	<input type="text" id="imgUrl">
						</div>
						<div class="col s3" style="padding-left: 0; margin-left: 0;">
							<a href="#modalImgSrc" class="btn waves-effect waves-light"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</div>
					</div>					
				</div>		
			</div>		
		</div>
	</div>

	<div class="body">
		{!! $page !!}
	</div>

	<div id="modalImgSrc" class="modal bottom-sheet">
		<div class="modal-content">
			<h4>Modal Header</h4>
			<p>A bunch of text</p>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
		</div>
	</div>

	<div id="components" class="modal">
		<div class="modal-content">
			<h4>Componentes</h4>
			<br>
			<ul class="collapsible popout" data-collapsible="accordion">
				<li>
					<div class="collapsible-header"><i class="fa fa-font" aria-hidden="true"></i>Textos e Imagenes</div>
					<div class="collapsible-body row">
						<div class="col s12"><a href="#!" id="newTexto"><i class="fa fa-font" aria-hidden="true"></i>   Texto</a></div>
					</div>
					<div class="collapsible-body row">
						<div class="col s12"><a href="#!" id="newImage"><i class="fa fa-picture-o" aria-hidden="true"></i>   Imagen</a></div>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="fa fa-object-ungroup" aria-hidden="true"></i>Cuadros de texto y Botones</div>
					<div class="collapsible-body row">
						<div class="col s12"><a href="#!"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>   Textbox</a></div>
					</div>
					<div class="collapsible-body row">
						<div class="col s12"><a href="#!"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i>   Boton</a></div>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="fa fa-bars" aria-hidden="true"></i>Otras Cosas</div>
					<div class="collapsible-body row">
						<div class="col s12"><a href="#!"><i class="fa fa-square-o" aria-hidden="true"></i>   Cuadro Vacio</a></div>
					</div>
				</li>
			</ul>
		</div>
	</div>
		
	<script type="text/javascript">
		var selectedObject;	
		function save(){
			if (selectedObject) {
				$(selectedObject).removeClass('focusObject');
			}
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
		          $(selectedObject).addClass('focusObject');
		        }else{
		          alert('error');
		          $(selectedObject).addClass('focusObject');
		        }            
		      },
		      error: function (jqXHR, exception) {
		          console.log(jqXHR.responseText);
		          $(selectedObject).addClass('focusObject');
		        }
		    })
		}
		$('select').material_select();	
		$('#newTexto').click(function(){
			addSomething('p');
		});
		$('#deleteComponent').click(function(){
			if (selectedObject) {
				$(selectedObject).remove();
				toggleProperties(false);
				selectedObject = null;
			}else{
				alert("No hay ningun componente seleccionado");
			}
		});
		$('#newImage').click(function(){
			addSomething('img');
		});
		$('.modal').modal();
		$('.menu-wrapper').draggable({
			cancel:"div.menu",
			stop: function( event, ui ) {
			   var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) )+ "%" ;
			    var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) )+ "%" ;
			    $(this).css("left" , l);
			    $(this).css("top" , t);
			  }
		});
		function addSomething(componente){
			if (componente=='img') {
				var componente = $('<'+componente+' src="http://www.nikconferences.com/Images/no-image.png" style="position:absolute;" class="draggable">').html('Nuevo '+componente);
			}else{				
				var componente = $('<'+componente+' style="position:absolute;" class="draggable">').html('Nuevo '+componente);
			}
			$('.body').append(componente);
			componente.draggable({
				cancel:false,
				stop: function( event, ui ) {
				   var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) )+ "%" ;
				    var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) )+ "%" ;
				    $(this).css("left" , l);
				    $(this).css("top" , t);
				  }
			});
			$('.draggable').mouseup(function(){
				looseFocus();
				selectedObject = this;
				setFocus();				
			});
			$('#components').modal('close');
		}
		$('.draggable').mouseup(function(){	
				looseFocus();
				selectedObject = this;
				setFocus();	
		});	
		$('.draggable').draggable({
				cancel:false,
				stop: function( event, ui ) {
				   var l = ( 100 * parseFloat($(this).css("left")) / parseFloat($(this).parent().css("width")) )+ "%" ;
				    var t = ( 100 * parseFloat($(this).css("top")) / parseFloat($(this).parent().css("height")) )+ "%" ;
				    $(this).css("left" , l);
				    $(this).css("top" , t);
				  }
			});

		function fillProperties(tag){
			switch(tag){
				case "p":
					$('#textCaption').val($(selectedObject).html().replace(/<br>/g,"\n"));
					$('#textSize').val($(selectedObject).css('font-size').substring(0,$(selectedObject).css('font-size').length-2));
					$('#textColor').css('background-color',$(selectedObject).css('color'));
					$(selectedObject).css('font-weight')=='bold'? $('#textBold').prop('checked',true) : $('#textBold').prop('checked',false);
					$(selectedObject).css('font-style')=='italic'? $('#textItalic').prop('checked',true) : $('#textItalic').prop('checked',false);
					$('#textDropdown').val($(selectedObject).css('font-family'));
					$('#textDropdown').material_select();					
					if ($(selectedObject).css('text-shadow')!='none') {
						$('#textShadowCheck').prop('checked',true);
						$('#textShadowProps').show();
						var arr = $(selectedObject).css('text-shadow').split(") ");
						var px = arr[1].split(" ");
						$('#textShadowPropX').val(px[0].substring(0,px[0].length-2));
						$('#textShadowPropY').val(px[1].substring(0,px[1].length-2));
						$('#textShadowPropZ').val(px[2].substring(0,px[2].length-2));
						$('#textShadowColor').css('background-color',arr[0]+')');
					}else{
						$('#textShadowCheck').prop('checked',false);
						$('#textShadowProps').hide();
					}
					$('#tamanioContenedor').val(Math.round(($(selectedObject).width() / $(window).width())*100));
					$('#zindex').val($(selectedObject).css('z-index') == 'auto' ? 0 : $(selectedObject).css('z-index'));

					console.log($(selectedObject).css('z-index') == 'auto' ? 0 : $(selectedObject).css('z-index'));
					
			}
		}

		function toggleProperties(inOut){
			if (selectedObject) {
				var elementType = selectedObject.tagName;
					if (inOut) {
						switch(elementType){
							case "P":
								fillProperties("p");
								$('#textProperties').show();
								$('#imgProperties').hide();
								break;
							case "IMG":
								$('#imgProperties').show();
								$('#textProperties').hide();
								break;
							default:
								break;
						}
					}else{
						switch(elementType){
							case "P":
								$('#textProperties').hide();
								break;
							case "IMG":
								$('#imgProperties').hide();
								break;
							default:
								break;
						}
					}
					
			}
		}

		function resetShadowValues(){
			$('#textShadowColor').css('background-color', 'white');
			$('#textShadowPropX,#textShadowPropY,#textShadowPropZ').val('1');
		}

		function colorToHex(color) {
		    if (color.substr(0, 1) === '#') {
		        return color;
		    }
		    var digits = /(.*?)rgb\((\d+), (\d+), (\d+)\)/.exec(color);
		    
		    var red = parseInt(digits[2]);
		    var green = parseInt(digits[3]);
		    var blue = parseInt(digits[4]);
		    
		    var rgb = blue | (green << 8) | (red << 16);
		    return digits[1] + '#' + rgb.toString(16);
		};

		/*************************************** Focus events ************************************************/
		function looseFocus(){			
			if (selectedObject!=null) {
				toggleProperties(false);
				$(selectedObject).removeClass('focusObject');
			}
		}
		function setFocus(){
			toggleProperties(true);
			$(selectedObject).addClass('focusObject');
		}
		$(window).click(function(event) {
			
			if(!$(event.target).is($(selectedObject)) && !$(event.target).is($('.menu-wrapper *')) && !$(event.target).is($('#components *')) && !$(event.target).is($('#colorpickerdiv *')) && !$(event.target).is($('#modalImgSrc *')))
			{
				toggleProperties(false);
			    $(selectedObject).removeClass('focusObject');
			    selectedObject=null;

			}
		});
		/*$(selectedObject).focus(function(){
			$(selectedObject).addClass('focusObject');
		});
		$(selectedObject).focusout(function(){
			$(selectedObject).removeClass('focusObject');
		});*/


		/****************************** TEXT PROPERTIES ***************************************************/

		$('#textCaption').keyup(function(){
			selectedObject.innerHTML = $('#textCaption').val().replace(/\n/g,"<br />");
		});
		$('#textCaption').keydown(function(e){
		    var that = this;
		    setTimeout(function(){
		        $(selectedObject).html(that.value.replace(/\n/g,"<br />"));
		    },10);
		});
		$('#textSize').bind('input',function(){
			$(selectedObject).css('font-size',$('#textSize').val()+'px');
		});
		$('#textColor').change(function(){
			$(selectedObject).css('color','#'+$('#textColor').val());
		});
		$("#textBold").click(function() {  
	        if($("#textBold").is(':checked')) {  
	             $(selectedObject).css('font-weight','bold');
	        } else {  
	             $(selectedObject).css('font-weight','normal');	            
	        }  
	    });
	    $("#textItalic").click(function() {  
	        if($("#textItalic").is(':checked')) {  
	             $(selectedObject).css('font-style','italic');
	        } else {  
	             $(selectedObject).css('font-style','normal');	            
	        }  
	    });
	    $('#textDropdown').change(function(){
			$(selectedObject).css('font-family',$('#textDropdown').val());
		});
		$("#textShadowCheck").click(function() {  
	        if($("#textShadowCheck").is(':checked')) {  
	             $('#textShadowProps').show();
	             resetShadowValues();
	             $(selectedObject).css('text-shadow',$('#textShadowColor').css('background-color') + ' ' + $("#textShadowPropX").val()+'px '+$("#textShadowPropY").val()+'px '+$("#textShadowPropZ").val()+'px');
	        } else {  
	             $('#textShadowProps').hide();
	             $(selectedObject).css('text-shadow', 'none');           
	        }  
	    });
	    $('#textShadowColor, #textShadowPropX, #textShadowPropY, #textShadowPropZ').change(function(){
			$(selectedObject).css('text-shadow',$('#textShadowColor').css('background-color') + ' ' + $("#textShadowPropX").val()+'px '+$("#textShadowPropY").val()+'px '+$("#textShadowPropZ").val()+'px');
		});
		$('#tamanioContenedor').on('change input', function(){
			$(selectedObject).css('max-width', $('#tamanioContenedor').val()+'%');
			$(selectedObject).css('width', $('#tamanioContenedor').val()+'%');
		});
		$('#zindex').on('change input', function(){
			$(selectedObject).css('z-index', $('#zindex').val());
		});


	</script>
</body>
</html>