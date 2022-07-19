

 var all_dossiers = [];
 
 var type_btn = 'btn_dossier';


 function fill_treeview() {

  check_have_parent();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "/fill_drop_down",
    method:"POST",
    data:{
      organigramme_id : id_organigramme,
      type_btn : type_btn,
    },
    success: function(data) {
      
     
          
       $('#select_block').html(data)
       $('#select_tree').treeselect();

      
    }
  })

  $.ajax({
      url: "/array_organigramme",
      method:"POST",
      data:{
   
        organigramme_id : id_organigramme
      },
      dataType: "json",
      success: function(data) {
    


        
 
        $('#treeview').treeview({
          data: data,

        });




      }
  })

  $.ajax({
      url: "/array_organigramme_simple",
      dataType: "json",
      data:{
        organigramme_id : id_organigramme
      },
      success: function(data) {
        all_dossiers =data
      }
  })





}


function check_have_parent(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
        });
      $.ajax({
        url: "/check_have_parent",
        method:"POST",
        data:{
          organigramme_id : id_organigramme
        },
        dataType: "json",
        success: function(data) {
          console.log(data.etat)
          if(data.etat){
            $('.btn_add_champs_click').removeClass("hidden");

          }else{
            $(".btn_add_champs_click").addClass("hidden");

          }
        }
    })
}


$(document).ready(function() {

        var id_get = 1;

        var tableLength = 1;
        var count = 1;

      

      fill_treeview();

      $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');  
        
        if ($(this).find('.btn-primary').length>0) {
          $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').length>0) {
          $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').length>0) {
          $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').length>0) {
          $(this).find('.btn').toggleClass('btn-info');
        }
        
   
              
        });

        $('.btn_dossier').click(function() {

          
           type_btn = "btn_dossier" ;
        
           $('#type_dossier').val(type_btn);

           fill_treeview()

   
                
          });


          $('.btn_sous_dossier').click(function() {

          
            type_btn = 'btn_sous_dossier';

            $('#type_dossier').val(type_btn);

            fill_treeview()

                 
           });
  
      


      $('.btn_add_oranigramme').on('click', function(event){
        event.preventDefault();
       

            count++;


        
            var add_row = '<tr id=row_' + count + '  >';

      


            add_row += '<td><input class="form-control" type="text"   required></td>';

      
          

            add_row += '<td>  <select class="form-control" name="" id="" required> ';
            add_row += '  <option>sélectionner le type</option>      <option value="1">Date</option> <option value="1">Text</option>';
            add_row += '   </select></td>';
            add_row += '<td>  <div class="block_action_organigramme"> ';
            add_row += '<button type="button" class="btn btn-success" onclick="click_edit(event,1 )">Validé</button>';
            add_row += '      </div> </td></tr>';
          
                



            if (tableLength > 0) {

                $(".table_champs_add tbody tr:last").after(add_row);
            }
            if (tableLength == 0) {

                $(".table_champs_add tbody ").append(add_row);
            }
            tableLength++;



       });






        


      

            $('#treeview_form').on('submit', function(event){
              event.preventDefault();
                $.ajax({
                 url:"/store_dossier",
                 method:"POST",
                 data:$(this).serialize(),
                 success:function(data){
                  if(data.etat){
                    fill_treeview();
                 
                    $('#treeview_form')[0].reset();
                    alert('ajouter aves succes');
                  }
           
                 }
                })
             });










});




function removeRow(e,row) {


  e.preventDefault();

  
  array_id =[];







                        const
              getChildren = id => (relations[id] || []).flatMap(o => [o, ...getChildren(o.id)]),
            
              relations = all_dossiers.reduce((r, o) => {
                  (r[o.parent_id] ??= []).push(o);
                  return r;
              }, {});

              array_child= getChildren(row)

              for (var i = 0; i < array_child.length; i++) {       
                array_id.push( array_child[i].id)
                }
                array_id.push(row)
             



                $.ajax({
                  url:"/delete_dossier",
                  method:"POST",
                  data:{
                    items_delete : array_id
                  },
                  success:function(data){

                    if(data.etat){
                        fill_treeview();
                        alert('supprimer avec succes');

                     }
                
            
                  }
                 })




}


