var j=1;
$(function(){
    // $('#idprod').on('change', selectprod);
 // $('.btn btn-danger').on('click',Eliminarfila);
  $('#empresa').on('change',obtenerProducto);
  $('#selectproducto').on('change',selectproductos);
  $('#selectservicio').on('change',selectservicios);
 // $('#selectRol').on('change',datosRol);
  
 });
 
  
  function obtenerProducto(){
    id_empresa=$(this).val();
    var html_select ='';
   console.log(id_empresa);
    $.get('/api/productosEmpresa/get/'+id_empresa, function(dato) {
        console.log(dato);
    
       html_select +='<label for="Producto">Productos : </label>';  
        html_select +=' <select  class="form-control" id="selectproducto" name="selectproducto" onchange="selectproductos()" >'; 
      for(var i=0 ;i<dato.length;i++){  
           
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
        html_select +='<td><button type="button" name="Eliminar" class="btn btn-danger" value="Delete" onclick="deleteRow(this)">X</button></td>';
        html_select +='</tr>';
        $('#TbodyProductos').append(html_select);   
           j++; 
           $('#j').val(j);
     });  
}

function selectservicios(){
    
  id_servicio=$('#selectservicio').val();
   
var   html_select =' '; 
  $.get('/api/servicio/get/'+id_servicio, function(dato) {

      html_select +='<tr>';
      html_select +=' <th scope="row">'+dato.id+'</th> '; 
      html_select +='<td>'+dato.Nombre+'<input type="hidden" name="servicio'+j+'" value="'+dato.id+'" /></td>';
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
 