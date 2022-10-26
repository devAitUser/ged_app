function remove_organigramme(e,row) {


                e.preventDefault();

       
  

  
                  $.ajax({
                    url:APP_URL+"/delete_organigramme",
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

    location.href=APP_URL+'/organigramme_view/' + row + '/edit';





}

  function fill_organigramme(){

        var button = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">';

        button += '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>';

        button += '<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>';
        button += '</svg>';


    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
      });

    $.ajax({
        'url': APP_URL+"/table_organigramme_view",
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
              "sUrl": APP_URL+"/assets/fr-FR.json"
            },
    
            "columns": [
                { "data": "id"  },
                { "data": "nom"  },
          
                { "data": "id"  , render: function(data, type, row) {
                    return '<button type="button" class="btn btn-primary"   onclick="click_edit(event,' + data + ' )" >'+button+'</button>' } 
                }

                 
                ]

		


        })
   
    })

}


$(document).ready(function() {
     
    fill_organigramme();

 } );