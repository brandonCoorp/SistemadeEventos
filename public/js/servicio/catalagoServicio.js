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
    id3=$(this).parent().val();
    //id3=$(this).val();   
  console.log(id3);
  var html_select ='';
  html_select +='<label for="Producto">Productos : </label>';  
  $('#catalogo').remove();
 
  $('#contenedorCatalogo').append(html_select);
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
 