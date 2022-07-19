function remove_organigramme(e,row) {


                e.preventDefault();

       
  

  
                  $.ajax({
                    url:"/delete_organigramme",
                    method:"POST",
                    data:{
                      items_delete : row
                    },
                    success:function(data){

                      

                        console.log(data.data)
  
                      if(data.etat){

                         

                            $('#organigramme_table').DataTable().destroy();
                            fill_organigramme()
                            

                       
                                                
                         
                            alert('supprimer avec succes');
                          
  
                       }
                  
              
                    }
                   })
  
  
  
  
  }


  function click_edit(e,row) {
             
    e.preventDefault();
    var id =row

    location.href='/organigramme/' + row + '/edit';





}

  function fill_organigramme(){

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        'url': "/table_organigramme",
        'method': "GET",
        'contentType': 'application/json'
    }).done( function(data) {
        $('#organigramme_table').dataTable( {
            "aaData": data,
            "bInfo" : false,
            "lengthChange": false,
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    defaultContent: '<button>Click!</button>',
                },
            ],
            
            "paginate": {
                "first": "PremiÃ¨re",
                "last": "DerniÃ¨re",
                "next": "Suivante",
                "previous": "PrÃ©cÃ©dente"
            },
            "oLanguage": {
                "sUrl": "/assets/fr-FR.json"
              },
    
            "columns": [
                { "data": "id"  },
                { "data": "nom"  },
          
                { "data": "id"  , render: function(data, type, row) {
                    return '<button type="button" class="btn btn-danger mr-3 " onclick="remove_organigramme(event,' + data + ' )"  >Supprimer</button><button type="button" class="btn btn-primary"   onclick="click_edit(event,' + data + ' )" >Modifier</button>' } 
                }

                 
                ]

		


        })
   
    })

}


$(document).ready(function() {
     
    fill_organigramme();

 } );