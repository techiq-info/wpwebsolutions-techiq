	function peuple_canvas(canvas,element,ispetit) {
			//console.log(element);
			
			if (canvas==CraPacrAxx) {
				desactivate();
				save();
			}
			canvas.clear();
			var w,h;		
			w = canvas.getWidth();
			h = canvas.getHeight();
			
			if (ispetit) create_magnetic_grille(false);
			
			var lst_objet = element.split('-')
			
			for (var z=0;z<lst_objet.length;z++) {	
			
				var lst_elemt = lst_objet[z].split(',');				
				var w_i,h_i,t_i,l_i,m_i;				
				if (lst_elemt[5]!='dft') {
					m_i=lst_elemt[5];
					if (w >h) w_i = h_i = (lst_elemt[3]*w)/100;
					else w_i = h_i = (lst_elemt[2]*h)/100;
				} else {
					m_i = '';
					w_i = ((lst_elemt[2]*w)/100)+1;
					h_i = ((lst_elemt[3]*h)/100)+1;					
				}	
				if (lst_elemt[4]==1) {
					l_i = (lst_elemt[0]*w)/100-(w_i/2);
					t_i = (lst_elemt[1]*h)/100-(h_i/2);				
				}	else {
					l_i = (lst_elemt[0]*w)/100;
					t_i = (lst_elemt[1]*h)/100;
					
				}
				if (canvas==CraPacrAxx) {
					
					var id = liste_id_img[Math.floor(Math.random() * liste_id_img.length)];
					
					load_img(canvas,id,w_i,h_i,l_i,t_i,m_i) ;
					
				}else {
					img =  new fabric.Imagepattern(null,{width:w_i,height:h_i,left:l_i,top:t_i,masque:m_i});
					img.stroke='#dedede';
					img.borderSize=0.5;
					canvas.add(	img);	
				}
				
			}		
				
			canvas.renderAll();
			
		}
		
		function load_img(canvas,id,w_i,h_i,l_i,t_i,m_i) {
		
			fabric.Imagepattern.fromURL(document.getElementById(id).src, function (img) {
					img.imageId = id;
					img.widthImg = img.getWidth();
					img.heightImg = img.getHeight();
					img.transparentCorners= false;
					img.borderScaleFactor = 2;
					img.borderColor='#8C7272';
					img.cornerColor='#8C7272';
					img.left = l_i;
					img.width = w_i;
					img.top = t_i;
					img.height = h_i;
					img.masque=m_i;
					img.stroke="#"+color_base;
					img._changeAndAnimateObject('init');
				});
		
		}
		function chargeimage(id){
			desactivate();	
			save();
			var imgElement = document.getElementById(id);
		
		fabric.Imagepattern.fromURL(document.getElementById(id).src, function (img) {
			
			var item = CraPacrAxx.getObjects('imagepattern');
			
			img.imageId = id;
			img.widthImg = img.getWidth();
			img.heightImg = img.getHeight();
			img.transparentCorners= false;
			img.borderScaleFactor = 2;
			img.borderColor='#8C7272';
			img.cornerColor='#8C7272';
			img.stroke="#"+color_base;
			
			if (jQuery.isEmptyObject(item)) {
				
				//console.log(CraPacrAxx.getWidth()+'-'+CraPacrAxx.getHeight());
				
				img.left = 0;
				img.top = 0;
				
				img.width = CraPacrAxx.getWidth();
				img.height = CraPacrAxx.getHeight();
			} else {
				
				
				var i = Math.floor((Math.random() * item.length) );	
				img.borderSize = 0;
				img.stroke = "#"+color_base;
				if  (item[i].getWidth()>item[i].getHeight()){
					var w = Math.round(item[i].getWidth()/2);
					img.left = (item[i].getLeft()+w);
					img.top = item[i].getTop();
					img.width = w;
					img.height =  item[i].getHeight();					
					item[i]._changeAndAnimateObject('w',w);
					
				} else {
					var h = Math.round(item[i].getHeight()/2);
					
					img.left = item[i].getLeft();
					img.top = (item[i].getTop()+h);
					img.width = item[i].getWidth();
					img.height =  h;					
					item[i]._changeAndAnimateObject('h',h);
				}	
				
			} 
			
			img._changeAndAnimateObject('init');
			
		});
	}
	
	function dropimage(idsrc,iddest,place){
		save();
		var item = CraPacrAxx.getObjects();		
		fabric.Imagepattern.fromURL(document.getElementById(idsrc).src, function (img) {
			img.imageId = idsrc;
			img.widthImg = img.getWidth();
			img.heightImg = img.getHeight();
			img.transparentCorners= false;
			img.borderScaleFactor = 2;
			img.borderColor='#8C7272';
			img.cornerColor='#8C7272';
			img.borderSize = 0;
			img.stroke="#"+color_base;
			if (place=='dm'){				
				img.left = item[iddest].getLeft();
				img.top = item[iddest].getTop();
				img.width = item[iddest].getWidth();
				img.height = item[iddest].getHeight();	
				item[iddest].remove();
				img._changeAndAnimateObject('init');
			}
			if (place=='dl'){		
				var w = Math.round(item[iddest].getWidth()/2);
				img.left = item[iddest].getLeft();
				img.top = item[iddest].getTop();
				img.width = w;
				img.height = item[iddest].getHeight();
				item[iddest].left = item[iddest].left +w;				
				item[iddest]._changeAndAnimateObject('w',w);
				img._changeAndAnimateObject('init');
			}
			if (place=='dr'){				
				var w = Math.round(item[iddest].getWidth()/2);
				img.left = item[iddest].getLeft()+w;
				img.top = item[iddest].getTop();
				img.width = w;
				img.height = item[iddest].getHeight();
				item[iddest]._changeAndAnimateObject('w',w);
				img._changeAndAnimateObject('init');
			}
			if (place=='dt'){				
				var h = Math.round(item[iddest].getHeight()/2);
				img.left = item[iddest].getLeft();
				img.top = item[iddest].getTop();
				img.width = item[iddest].getWidth();
				img.height = h;
				item[iddest].top = item[iddest].top +h;	
				item[iddest]._changeAndAnimateObject('h',h);
				img._changeAndAnimateObject('init');
			}
			if (place=='db'){				
				var h = Math.round(item[iddest].getHeight()/2);
				img.left = item[iddest].getLeft();
				img.top = item[iddest].getTop()+h;
				img.width = item[iddest].getWidth();
				img.height = h;
					
				item[iddest]._changeAndAnimateObject('h',h);
				img._changeAndAnimateObject('init');
			}

				
		});
	}
	
	
	function handleDrop(e) {
			// this / e.target is current target element.
			//	console.log('grand');
			if (e.stopPropagation) {
				e.stopPropagation(); // stops the browser from redirecting.
			}
			//console.log(images_list);
			save();
			
			var pointer  = CraPacrAxx.getPointer(e);
		 
			w = CraPacrAxx.getWidth()/4;
			h = CraPacrAxx.getHeight()/4;	
			l = pointer.x-(w/2);
			if (l<0) l=0;
			else if ((l+w)>CraPacrAxx.getWidth()) l = CraPacrAxx.getWidth()-w;
			t = pointer.y-(h/2);
			if (t<0) t=0;
			else if ((t+h)>CraPacrAxx.getHeight()) t = CraPacrAxx.getHeight()-h;
			
			fabric.Imagepattern.fromURL($('#div_lightbox img.img_dragging').attr('src'), function (img) {
				img.imageId = $('#div_lightbox img.img_dragging').attr('id');
				img.widthImg = img.getWidth();
				img.heightImg = img.getHeight();
				img.transparentCorners= false;
				img.borderScaleFactor = 2;
				img.borderColor='#8C7272';
				img.cornerColor='#8C7272';
				img.stroke="#"+color_base;
				img.left=l;		
				img.top=t;
				img.ismove=true;
				img.width = w;
				img.height = h;					
				img._changeAndAnimateObject('init');
			});
			
			$('#par_drop_zone').remove();
			return false;
	}
	
	function check_nbe(){
		var total =0;
		var item = CraPacrAxx.getObjects();	
		var lst_nbe={};
		
		if (item) {			
			for(t=0;t<item.length;t++){
				
				if (item[t]["type"] == "imagepattern" ) {				
					
					if (lst_nbe!=undefined && lst_nbe['"'+item[t]["imageId"]+'"'] != undefined ) lst_nbe['"'+item[t]["imageId"]+'"'] = lst_nbe['"'+item[t]["imageId"]+'"']+1;
					else lst_nbe['"'+item[t]["imageId"]+'"']=1;				
				} 
			}			
		}
	//	console.log(lst_nbe);	
		var lst_element = document.querySelectorAll('#div_lightbox img')
		
		if (lst_element != undefined ) {
			for(t=0;t<lst_element.length;t++){
				
			//	console.log(lst_element[t]["id"]);
				$('#mini_chiffre_'+lst_element[t]["id"]).empty();
				if (lst_nbe!=undefined && lst_nbe['"'+lst_element[t]["id"]+'"']!=undefined) {
						$('#mini_chiffre_'+lst_element[t]["id"]).append(lst_nbe['"'+lst_element[t]["id"]+'"']);
					total = total + lst_nbe['"'+lst_element[t]["id"]+'"'];
				}
				else $('#mini_chiffre_'+lst_element[t]["id"]).append('0');				
			}
		}
		if (total > 1) {
				
				if (is_mobile==1)$('#change_ss_menu').css('display','block');
				else $('#retour_pm').css('display','block');

				$('#canv_menu').css('display','block');
				$('#upload_menu').css('display','block');
				$('#img_menu').css('display','none');
				CraPacrAxx.deactivateAll().renderAll();
		}
		else {
			$('#canv_menu').css('display','none');
			$('#retour_pm').css('display','none');
			$('#upload_menu').css('display','block');
		}
	}
	
	
	function on_moving(){
		var obj = CraPacrAxx.getActiveObject();
		if (obj && !is_undo) {
			var objcenter = obj.getCenterPoint();
			var left_grid,top_grid='';
			for (i=0 ; i < left_magnetic.length; i++) {		
				if (objcenter.x < (left_magnetic[i] +val_magnetisme) && objcenter.x  > (left_magnetic[i] -val_magnetisme))  left_grid = i ;
				if (objcenter.y < (top_magnetic[i] +val_magnetisme) && objcenter.y > (top_magnetic[i] -val_magnetisme)) top_grid=i;
			}			
			cache_all_ligne(left_grid,top_grid);
		}
		is_undo = false;
	}
	
	
	function slide_object(sens){
		var max = objet_max-1;
		if (sens=='pos'){
			if (id_obj_sel == max) change_object(0);
			else change_object((id_obj_sel+1));
		} else {
			if (id_obj_sel==0) change_object(max);
			else change_object((id_obj_sel-1));	
		}
	
	}
	
	function change_object(value) {				
		if (value!=id_obj_sel){				
			id_obj_sel = value;				
			CraPacrAxx = array_canv[value];	
			
			$('#slider-spacing').val(CraPacrAxx.imageSpace).change();	
			
			if (CraPacrAxx.backgroundColor!='') change_color("colorbox-background",  CraPacrAxx.backgroundColor);
			else change_color("colorbox-background", '');
			id_obj_sel = value;
			create_magnetic_grille(true);					
			undo = [];
			redo = [];
			$('#undo').removeClass('on').addClass('off');
			$('#redo').removeClass('on').addClass('off');
			desactivate()
			rempli_canvas();
			
			if (is_first) {
				is_first = false;
				$('.disparition').css("display","none");
			} else 	$('.disparition').slideUp();
			$('#par_canv_'+value).slideDown();
			setTimeout(function(){CraPacrAxx.renderAll();;;},500);	
		
		}
	}	
	
	
	function cache_all_ligne(left_grid,top_grid){			
		var item = CraPacrAxx.getObjects('line');		
		if (item) {			
			for(t=0;t<item.length;t++){
				if (item[t].idLine=='w_'+left_grid || item[t].idLine=='h_'+top_grid) { item[t].visible=true; item[t].bringToFront(); }
				else item[t].visible=false;
			}
		}
	}
	
	function clear_canvas(){
		save();
		CraPacrAxx.backgroundColor='';;
		CraPacrAxx.clear();
		create_magnetic_grille(false);
		desactivate();
	}
	
	
		
	function handleDragStart(e) {
		[].forEach.call(images, function (img) {
			img.classList.remove('img_dragging');
		});
		this.classList.add('img_dragging');
		id_drag = $(this).attr('id');
		$('#par_drop_zone').remove();
		generate_grille_drag();
		
		var canvasContainer = document.getElementById('par_drop_zone');
		canvasContainer.addEventListener('drop', handleDrop, false);
		
	}
	function handleDragStop(e) {
		e.stopPropagation();		
		$('#par_drop_zone').remove();
	}	
	function woooooooooo(e) {
		e.stopPropagation();
		var id = $(this).attr('id').substring(2, $(this).attr('id').length);;
		var type = $(this).attr('id').substring(0, 2);
		dropimage(id_drag,id,type);
		$('#par_drop_zone').remove();
	}

	
	function generate_grille_drag(){
		
		var item = CraPacrAxx.getObjects();						
		
		var div_drop='<div onclick="$(\'#par_drop_zone\').remove()" style="position:absolute;width:'+CraPacrAxx.getWidth()+'px;height:'+CraPacrAxx.getHeight()+'px;z-index:1000000000000" id="par_drop_zone" >';	
		for (i in item) {						
			var left_objet = item[i].getLeft();
			var top_objet = item[i].getTop();							
			if (item[i]["type"] == "imagepattern" ) {
				div_drop += '<div style="position:absolute;width:'+item[i].getWidth()+'px;height:'+item[i].getHeight()+'px;left:'+item[i].getLeft()+'px;top:'+item[i].getTop()+'px;">';
				if (item[i].getWidth()>item[i].getHeight()) {
					s = item[i].getWidth()/6;
					t = (item[i].getHeight()/2) - s/2;
					div_drop += '<div style="width:'+s+'px;height:'+s+'px;position:absolute;top:'+t+'px;left:'+((item[i].getWidth()/4)- s/2)+'px" id="db'+i+'" class="dropzone droptop"></div>';
					div_drop += '<div style="width:'+s+'px;height:'+s+'px;position:absolute;top:'+t+'px;left:'+((item[i].getWidth()/2)- s/2)+'px" id="dm'+i+'" class="dropzone dropmiddle"></div>';
					div_drop += '<div style="width:'+s+'px;height:'+s+'px;position:absolute;top:'+t+'px;left:'+((3*(item[i].getWidth()/4))- s/2)+'px" id="dl'+i+'" class="dropzone dropleft"></div>';
	
				} else {
					s = item[i].getHeight()/6;
					t = (item[i].getWidth()/2) - s/2;
					div_drop += '<div style="width:'+s+'px;height:'+s+'px;position:absolute;top:'+((item[i].getHeight()/4)- s/2)+'px;left:'+t+'px" id="db'+i+'" class="dropzone droptop"></div>';
					div_drop += '<div style="width:'+s+'px;height:'+s+'px;position:absolute;top:'+((item[i].getHeight()/2)- s/2)+'px;left:'+t+'px" id="dm'+i+'" class="dropzone dropmiddle"></div>';
					div_drop += '<div style="width:'+s+'px;height:'+s+'px;position:absolute;top:'+((3*(item[i].getHeight()/4))- s/2)+'px;left:'+t+'px" id="dl'+i+'" class="dropzone dropleft"></div>';
		
									
				}
				div_drop += '</div>';
			}							
		}
		div_drop += '</div>';
		$( "#div_canv_0" ).prepend(div_drop);
		
		dropzone = document.querySelectorAll('.dropzone');
		[].forEach.call(dropzone, function (img) {
			img.addEventListener('drop', woooooooooo, false);			
		});	 
	}
	function resize_canv() {
		w_c = 0;
		h_c = 0;
		
		w = $('#cont_canvas').css("width").substr(0,($('#cont_canvas').css("width").length-2));
		h = $('#cont_canvas').css("height").substr(0,($('#cont_canvas').css("height").length-2));
		
		if (is_mobile!=1) {
			var h_option = $('#menu-tools').css("height").substr(0,($('#menu-tools').css("height").length-2));
			$(".menu-high").css("height",(h_option-(42*3)));
			$(".div_option_forme_2").css("height",(h_option-(42*3)-48));
		}
		$("#conteneur_total").css("width",w);
		$("#conteneur_total").css("height",h);
		
		
		
		
		for (var z=0;z<objet_max;z++) {						
			
			CraPacrAxx = array_canv[z];			
			
			width_min = $("#fond_"+z).attr("data-width");
			height_min = $("#fond_"+z).attr("data-height");
	
			if (width_min > height_min) {
				var ratio = width_min/height_min;				
				if (h>w) {
					w_c = w;
					h_c = w/ratio;
				} else {
					if ((w/ratio) > h) {
						w_c = h*ratio;
						h_c = h;
					} else {
						w_c = w;
						h_c = w/ratio;
					}					
				}				
			} else {
				var ratio = height_min/width_min;
				if (w>h) {
					w_c = h/ratio;
					h_c = h;
				} else {
					if ((h/ratio) > w) {
						w_c = w;
						h_c = w*ratio;
					} else {
						w_c = h/ratio;
						h_c = h;
					}
				}				
			}
			
			w_c = Math.round(w_c);
			h_c = Math.round(h_c);
									
			$("#par_canv_"+z).css("width",w);
			$("#par_canv_"+z).css("height",h);
			
			$("#fond_"+z).css("width",w_c);
			$("#fond_"+z).css("height",h_c);
			$("#fond_"+z).css("left",((w-w_c)/2));
			$("#fond_"+z).css("top",((h-h_c)/2));
			
			var new_ratio = w_c/width_min;	
			
			width_canv = $("#div_canv_"+z).attr("data-width")*new_ratio;
			height_canv = $("#div_canv_"+z).attr("data-height")*new_ratio;
			left_canv = $("#div_canv_"+z).attr("data-left")*new_ratio;
			top_canv = $("#div_canv_"+z).attr("data-top")*new_ratio;
			
			$("#div_canv_"+z).css("width",width_canv);
			$("#div_canv_"+z).css("height",height_canv);
			$("#div_canv_"+z).css("left",left_canv);
			$("#div_canv_"+z).css("top",top_canv);
								
			var item = CraPacrAxx.getObjects();
			var canv_with = CraPacrAxx.getWidth();
		
			CraPacrAxx.setDimensions({ width: width_canv, height: height_canv });					

			if (CraPacrAxx.overlayImage && CraPacrAxx.overlayImage != "") {		
				CraPacrAxx.overlayImage.setWidth(width_canv*1).setHeight(height_canv*1);
			}
			
			var new_ratio = canv_with/CraPacrAxx.getWidth();			
			CraPacrAxx.imageSpace = CraPacrAxx.imageSpace/new_ratio;					
			if (item.length > 0) {
				for (i in item) {							
					var left_objet = item[i].getLeft();
					var top_objet = item[i].getTop();							
					if (item[i]["type"] == "imagepattern") {	
						var borderSize = item[i].get("borderSize");						
						var size_object_x = item[i].get("width");
						var size_object_y = item[i].get("height");	
						item[i].setLeft(Math.round(left_objet/new_ratio)).set("borderSize",(borderSize/new_ratio)).setTop(Math.round(top_objet/new_ratio)).set("width",(size_object_x/new_ratio)).set("height",(size_object_y/new_ratio)).setCoords();
					} else {
						var size_object_x = item[i].get("scaleX");
						var size_object_y = item[i].get("scaleY");	
						item[i].setLeft(Math.round(left_objet/new_ratio)).setTop(Math.round(top_objet/new_ratio)).set("scaleX",(size_object_x/new_ratio)).set("scaleY",(size_object_y/new_ratio)).setCoords();
					}							
				}						
			}	

			array_canv[z] = CraPacrAxx;	
			
			
		}					
		CraPacrAxx = array_canv[id_obj_sel];	
		create_magnetic_grille(true);					
		CraPacrAxx.renderAll();
		
	}
	
	
	function resize_bef_save(){
		
		//var new_size = 590;
		
		for (var z=0;z<objet_max;z++) {						
			
			width_canv = $("#div_canv_"+z).attr("data-width")*1;
			height_canv = $("#div_canv_"+z).attr("data-height")*1;
				
			CraPacrAxx = array_canv[z];		
		
			var item = CraPacrAxx.getObjects();						
					
			var canv_width = CraPacrAxx.getWidth();
			var canv_height = CraPacrAxx.getHeight();
			
			
			var new_ratio = width_canv/canv_width;	
			
			CraPacrAxx.setDimensions({ width: width_canv, height: height_canv });					
			
			if (CraPacrAxx.overlayImage && CraPacrAxx.overlayImage != "") {		
				CraPacrAxx.overlayImage.setWidth(width_canv*1).setHeight(height_canv*1);
			}
			CraPacrAxx.imageSpace = CraPacrAxx.imageSpace*new_ratio;					
			if (item.length > 0) {
				for (i in item) {
					
					var left_objet = item[i].getLeft();
					var top_objet = item[i].getTop();
					var borderSize = item[i].get("borderSize");	
					if (item[i]["type"] == "imagepattern") {	
						var borderSize = item[i].get("borderSize");	
						var size_object_x = item[i].get("width");
						var size_object_y = item[i].get("height");	
						item[i].setLeft(Math.round(left_objet*new_ratio)).set("borderSize",(borderSize*new_ratio)).setTop(Math.round(top_objet*new_ratio)).set("width",(size_object_x*new_ratio)).set("height",(size_object_y*new_ratio));
					} else {
						var size_object_x = item[i].get("scaleX");
						var size_object_y = item[i].get("scaleY");	
						item[i].setLeft(Math.round(left_objet*new_ratio)).setTop(Math.round(top_objet*new_ratio)).set("scaleX",(size_object_x*new_ratio)).set("scaleY",(size_object_y*new_ratio));
					}							
				}						
			}
			
			array_canv[z] = CraPacrAxx;	
			
			
		}					
		CraPacrAxx = array_canv[id_obj_sel];			
	}
	
	
	function create_magnetic_grille(reinit) {
		var w_c = CraPacrAxx.width;
		var h_c = CraPacrAxx.height;  
		
		if (reinit) {
			var item = CraPacrAxx.getObjects('line');
			
			if (item) {			
				for(t=0;t<item.length;t++){
					item[t].remove();
				}
			}
		}
		left_magnetic = [w_c/2,w_c/4,(3*w_c)/4];
		top_magnetic = [h_c/2,h_c/4,(3*h_c)/4];
			
		for (i=0 ; i < left_magnetic.length; i++) {		
			CraPacrAxx.add(new fabric.Line([left_magnetic[i],0,left_magnetic[i],h_c],{idLine : 'w_'+i,visible:false,fill: 'red',  stroke: 'red',  strokeWidth: 2,   selectable: false}));
		}
		for (i=0 ; i < top_magnetic.length; i++) {		
			CraPacrAxx.add(new fabric.Line([0,top_magnetic[i],w_c,top_magnetic[i]],{idLine : 'h_'+i,visible:false,fill: 'red',  stroke: 'red',  strokeWidth: 2,   selectable: false}));
		}
	}
	
	function tuClick(options) {
		close_colorpicker();
		if (!options.target) {
			desactivate();	
		} else {
			block_slide = true;
			
			var obj = CraPacrAxx.getActiveObject();
			if (is_mobile!=1) {
				$('#object_active').slideDown("normal");	
						
			}	else {
				$('.color_list_div').css('display','none');	
			}
			
			$('#slider-opac').val(obj.get("opacity")).change();					
			
			if (obj["type"] == "text") {				
				simule_click("texte_par"); 
				
				if (is_mobile!=0) $('#color_list_txt').css('display','block');		
				
				$('.txt_menu').css('display','block');				
				
				change_bouton('bt-arc',obj["CraArcPacrA"]);
				
				 if (obj["CraArcPacrA"] != "plat") {
					
					$(".menu-arc").css("display","block");
					$('#slider-opac').val(obj.get("opacity")).change();	
					$('#slider-CraArCPacrA').val(obj["CraArCPacrA"]).change();
					$('#slider-CraARCPacrA').val(obj["CraARCPacrA"]).change();					
					
				} else {
					$(".menu-arc").css("display","none");
					$('#slider-CraArCPacrA').val($('#slider-CraArCPacrA').attr("val-dft")).change();
					$('#slider-CraARCPacrA').val($('#slider-CraARCPacrA').attr("val-dft")).change();			
				}
				
				$("#text").val(obj.get("text"));
			
				$('#slider-CraPaX').val(obj.get("lineHeight")).change();
				$('#slider-crapx').val(obj.get("strokeWidth")).change();
				change_bouton('bt-align',obj.get("textAlign"));		
				value = obj.get("fontFamily");
				$(".fontFamil.ftActive").toggleClass("ftActive");
				$("#font_" + value.replace(/ /g, "_")).toggleClass("ftActive");
				
				if (obj.get("stroke")) {					  
				   change_color("colorbox-crapX", obj.get("stroke"))
				} else {						
					change_color("colorbox-crapX",  "#"+color_base)
				}
				
				if (obj.get("fill")) {					   
				   change_color("colorbox-craPxXxXx", obj.get("fill"))
				} else {						
					change_color("colorbox-craPxXxXx",  "#"+color_base)
				}
			} else {
				// $('.div_par_image').addClass('option_visible');	
				
				if (obj["type"] == "imagepattern") {
					simule_click("image_par");
					
					$('#img_menu').css('display','block');
					$('#canv_menu').css('display','none');
					
					if (is_mobile==1) {
						$('#retour_2_img').css('display','block');
						$('#color_list_img').css('display','block');	
					} else $('#retour_image').css('display','block');
					
					$('#upload_menu').css('display','none');
					
					change_bouton('bt_edge',obj["masque"]); 
										
					if (obj.get("stroke")) {							
						change_color("colorbox-bord-img", obj.get("stroke"))
					} else {						  
					   change_color("colorbox-bord-img", "#"+color_base)
					}
					
					$('#slider-crapx-2').val(obj.get("borderSize")).change();		
					$('#slider-taille-zoom').val(obj.get("scaleImg")).change();							
			
				} else {
									
					simule_click("clipart_par");					
					
					if (obj["type"] == "group") {					  
					    $("#couleur_svg").show();
						
						if (obj.get("fill")) {								
							change_color("colorbox-fill-svg", obj.get("fill"))
						} else {
						   change_color("colorbox-fill-svg", "#"+color_base)
						}
					} else {						
						$("#couleur_svg").hide();
					}
				}
			}			
			block_slide = false;
		}
	};
	
	function display(id){
		if (id=='magnify' && is_zoom) id= 'image';
		$('.color_list_div').css('display','none');		
		if (id=='magnify') {
			$(".div_zoom").addClass("zoom");
			change_bouton('bt-menu-header',id);
			resize_canv(false);	
			is_zoom=true;
		} else {
			if (is_zoom==true){
				$(".div_zoom").removeClass("zoom");
				resize_canv(false);	
				is_zoom=false;
			}
			
			change_bouton('bt-menu-header',id); 
			desactivate();
		//	$(".sous-menu").removeClass("photo-tools");
			$(".sous-menu").addClass("cache");
		//	$("."+id).addClass("photo-tools");
			$("#"+id+"_par").removeClass("cache");
		}
		
	}