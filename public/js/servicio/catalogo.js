var j=1;
$(function(){
    // $('#idprod').on('change', selectprod);
  $('#prueba').on('click',pruebas);
  $('.cargarServicio').on('click',obtenerPaquetes);
  //$('#selectproducto').on('change',selectproductos);
 // $('#selectRol').on('change',datosRol);
  
 });
 
 function pruebas(){
    console.log('hola');   
  }
    
 
 function obtenerPaquetes(){
    id_servicio=$(this).parent().val();
  var html_select ='';
  html_select +=' <div class="catalogo" id="catalogo">';  
  $('#catalogo').remove();
  var user_id= $('#user_id').val();
 // console.log(user_id);
  $.get('/api/Serviciopaquetes/get/'+id_servicio+'/'+user_id, function(dato) {
     //  console.log(dato);
      html_select = obtenerhtml(dato,html_select);
      $('#contenedorCatalogo').html(html_select);
 });  
 $.get('/api/Servicioproductos/get/'+id_servicio, function(dato) {
  html_select = obtenerhtmlProductosServicio(dato,html_select);
  $('#contenedorCatalogo').html(html_select);
});  
 // $('#contenedorCatalogo').append(html_select);
}


  
  function obtenerProducto(){
    id_categoria=$(this).val();
    var html_select ='';
    $.get('/api/productos/get/'+id_categoria, function(dato) {
       html_select +='<label for="Producto">Productos : </label>';  
        html_select +=' <select  class="form-control" id="selectproducto" name="selectproducto" onchange="selectproductos()" >'; 
      for(var i=1 ;i<dato.length;i++){  
           
        html_select +=' <option value="'+dato[i].id+'">'+dato[i].Nombre+'</option>';
          }
        html_select +='  </select>';
            $('#divprod').html(html_select);
    });  
  }
  
  function selectproductos(){
    
    id_producto=$('#selectproducto').val();
     
  var   html_select =' '; 
    $.get('/api/producto/get/'+id_producto, function(dato) {

        html_select +='<tr>';
        html_select +=' <th scope="row">'+dato.id+'</th> '; 
        html_select +='<td>'+dato.Nombre+'<input type="hidden" name="producto'+j+'" value="'+dato.id+'" /></td>';
        html_select +='<td>'+dato.Precio+'</td>';
        html_select +='<td><input tipe="number" name="Cantidad'+j+'" value="0" /></td>';
        
        html_select +='<td><button type="button" name="Eliminar" class="btn btn-danger" value="Delete" onclick="deleteRow(this)">X</button></td>';
        html_select +='</tr>';
        $('#TbodyProductos').append(html_select);   
           j++; 
           $('#j').val(j);
     });  
}
function deleteRow(btn){
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}
function AñadirCarritoPaquete(btn){
var paquete_id = btn.value;
var html_select ='';
var user_id= $('#user_id').val();
  $.get('/api/carritoAñadir/get/'+paquete_id+'/'+user_id, function(dato) {
      console.log(dato);
       html_select = obtenerhtmlCarrito(dato,html_select);
      $('#carrito').append(html_select);
      html_select =''
      html_select = obtenerhtmlCarta(dato,html_select);
      $('#carta').html(html_select);
      
 });
}
function AñadirCarritoProducto(btn){
  var producto_id = btn.value;
  var html_select ='';
  var user_id= $('#user_id').val();
  var cant= $('#cantidad'+producto_id).val();
  
    $.get('/api/carritoAñadirProd/get/'+producto_id+'/'+user_id+'/'+cant, function(dato) {
      html_select = obtenerhtmlCarritoprod(dato,html_select,cant);
        $('#carrito').append(html_select);
        html_select =''
        html_select = obtenerhtmlCartaprod(dato,html_select,cant);
        $('#carta').html(html_select);
        
   });
  }
  

//funciones de mostrar catalogo en html
function obtenerhtml(dato,html_select){
 
  html_select +='<div class="container">';
  html_select +='<div class="row">';  
  html_select +='<div class="col-md-12">';
  html_select +='<div class="section-title text-center">';
  html_select +='<h3 class="title">Lista de Paquetes</h3>';
  html_select +='</div>';
  html_select +='</div>';
   for(var i=0 ;i<dato.length;i++){  
    html_select +=' <div class="col-md-3 col-xs-6">';
    html_select +='<div class="product">';
    html_select +='<div class="product-img">';
            
    html_select +='<img src="'+dato[i].Imagen+'" alt="">';
          html_select +='</div>';
          html_select +='<div class="product-body">';
            html_select +='<p class="product-category">Category</p>';
            html_select +='<h3 class="product-name"><a href="#">'+dato[i].Nombre+'</a></h3>';
            html_select +='<h4 class="product-price">Bs.'+dato[i].Total+'</h4>';
            html_select +='<div class="product-rating">';
            html_select +='</div>';
          html_select +='</div>';
          html_select +='<div class="add-to-cart">';
            html_select +='<button class="add-to-cart-btn" name="Agregar"  value="'+dato[i].id+'" onclick="AñadirCarritoPaquete(this)"><i class="fa fa-shopping-cart"></i>Agregar</button>';
          html_select +='</div>';
        html_select +='</div>';
      html_select +='</div>'; 
  }
     html_select +='</div>';
     html_select +='</div>';
     html_select +=' </div>';  
 return html_select;
}

function obtenerhtmlProductosServicio(dato,html_select){
  html_select +='<hr>';
  html_select +='<div class="container">';
  html_select +='<div class="row">';  
  html_select +='<div class="col-md-12">';
  html_select +='<div class="section-title text-center">';
  html_select +='<h3 class="title">Lista de Productos</h3>';
  html_select +='</div>';
  html_select +='</div>';
   for(var i=0 ;i<dato.length;i++){  
    html_select +=' <div class="col-md-3 col-xs-6">';
    html_select +='<div class="product">';
    html_select +='<div class="product-img">';
            
    html_select +='<img src="'+dato[i].Imagen+'" style="width:250px; height:150px; alt="">';
          html_select +='</div>';
          html_select +='<div class="product-body">';
            html_select +='<p class="product-category">Category</p>';
            html_select +='<h3 class="product-name"><a href="#">'+dato[i].Nombre+'</a></h3>';
            html_select +='<h4 class="product-price">Bs.'+dato[i].Precio+'</h4>';
            html_select +='<div class="product-rating">';

            html_select +='<div class="h-25 d-inline-block " style="width: 100px; ">';
            html_select +='<div class="qty-label">';
            html_select +='Cantidad :';
            html_select +='<div class="input-number">';
            html_select +='<input type="number" name="cantidad" id="cantidad'+dato[i].id+'" value="1">';
            html_select +='<span class="qty-up">+</span>';
            html_select +='<span class="qty-down">-</span>';
            html_select +='</div>';
            html_select +='</div>';
            html_select +='</div>';
           
            html_select +='</div>';
            html_select +='<hr>';
            html_select +='<hr>';
          html_select +='</div>';
        
          html_select +='<div class="add-to-cart">';
            html_select +='<button class="add-to-cart-btn" value="'+dato[i].id+'" name="agregarproducto" onclick="AñadirCarritoProducto(this)"><i class="fa fa-shopping-cart"></i> Agregar a Carrito</button>';
          html_select +='</div>';
        html_select +='</div>';
      html_select +='</div>'; 
  }
     html_select +='</div>';
     html_select +='</div>';
     html_select +=' </div>';  
 return html_select;
}

///funcio cargar carrito en html

function obtenerhtmlCarrito(dato,html_select){ 
    html_select +='<div class="product-widget">';
                 html_select +='<div class="product-img">';
                 html_select +='<img src="'+dato.Imagen+'" alt="">';
                 html_select +='</div>';
                        html_select +='<div class="product-body">';
                        html_select +='<h3 class="product-name"><a href="#">'+dato.Nombre+'</a></h3>';
                        html_select +='<h4 class="product-price"><span class="qty">1x</span>Bs.'+dato.Total+'</h4>';
                        html_select +='</div>';
                        html_select +='<button class="delete"><i class="fa fa-close"></i></button>';
                        html_select +='</div>';
 
 return html_select;
}
function obtenerhtmlCarritoprod(dato,html_select,cant){ 
  var total = dato.Precio * Number(cant);
  console.log(total);
  html_select +='<div class="product-widget">';
               html_select +='<div class="product-img">';
               html_select +='<img src="'+dato.Imagen+'" alt="">';
               html_select +='</div>';
                      html_select +='<div class="product-body">';
                      html_select +='<h3 class="product-name"><a href="#">'+dato.Nombre+'</a></h3>';
                      html_select +='<h4 class="product-price"><span class="qty">'+cant+'x</span>Bs.'+total+'</h4>';
                      html_select +='</div>';
                      html_select +='<button class="delete"><i class="fa fa-close"></i></button>';
                      html_select +='</div>';

return html_select;
}

function obtenerhtmlCarta(dato,html_select){ 
  
  var totalitem=$('#totalitem').val();
 var  total=$('#total').val();
total = dato.Total + Number(total);

totalitem= 1+ Number(totalitem);
  html_select +='<small>'+totalitem+' Item(s) Seleccionado</small>';
  html_select +='<h5>SUBTOTAL: Bs.'+total+'</h5>';

 var  html2=totalitem;
  $('#itemrojo').html(html2);

  $('#totalitem').val(totalitem);
  $('#total').val(total);
return html_select;
}

function obtenerhtmlCartaprod(dato,html_select,cant){ 
  var totalprod = dato.Precio * Number(cant);
  var totalitem=$('#totalitem').val();
 var  total=$('#total').val();
total = Number(total) + totalprod;

totalitem= 1+ Number(totalitem);
  html_select +='<small>'+totalitem+' Item(s) Seleccionado</small>';
  html_select +='<h5>SUBTOTAL: Bs.'+total+'</h5>';

 var  html2=totalitem;
  $('#itemrojo').html(html2);

  $('#totalitem').val(totalitem);
  $('#total').val(total);
return html_select;
}