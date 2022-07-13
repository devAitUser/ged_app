

 var all_dossiers = [];


 function fill_treeview() {
             
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: "/fill_drop_down",

    success: function(data) {
          
       $('#select_block').html(data)
       $('#select_tree').treeselect();

      
    }
  })

  $.ajax({
      url: "/array_organigramme",
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
      success: function(data) {
        all_dossiers =data
      }
  })





}


$(document).ready(function() {

        var id_get = 1;

      

      fill_treeview();


          



             $(".btn_delete").click(function(){


              


            });


             $(".btn_link").click(function(){
              
              console.log(all_dossiers)

              //           const
              // getChildren = id => (relations[id] || []).flatMap(o => [o, ...getChildren(o.id)]),
            
              // relations = all_dossiers.reduce((r, o) => {
              //     (r[o.parent_id] ??= []).push(o);
              //     return r;
              // }, {});

              // console.log(getChildren(3)); // 4 5
            
          
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
