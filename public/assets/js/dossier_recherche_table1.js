function click_show(e, row) {

  e.preventDefault();
  var id = row

  var url = '/show_dossier/' + row;

  window.open(url, '_blank');




}





$(document).ready(function() {


        // function searchByColumn(table) {
        //   var defaultSearch = 1 //Name
        //   $(document).on('change', '#select-column', function() {
        //     defaultSearch = this.value;
        //   });
        //   $(document).on('change', '#search-by-column', function() {
        //     table.search('').columns().search('').draw();
        //     table.column(defaultSearch).search(this.value).draw();
        //   });
        // }


        //   var table = $('#organigramme_table').DataTable({

        //     "aaData": data,
        //     "bInfo": false,
        //     "lengthChange": false,
    
    
        //     "paginate": {
        //         "first": "PremiÃ¨re",
        //         "last": "DerniÃ¨re",
        //         "next": "Suivante",
        //         "previous": "PrÃ©cÃ©dente"
        //     },
        //     "oLanguage": {
        //         "sUrl": "/assets/fr-FR.json"
        //     },
    
    
    
    
    
        // });
       
        //   var rows = table
        //   .rows()
        //   .remove()
        //   .draw();


        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
        });
  
      $.ajax({
          'url': "/api_all_dossier",
          'method': "GET",
          'contentType': 'application/json'
      }).done( function(data) {
          $('#organigramme_table').dataTable( {
              "aaData": data,
              "searching" : false,
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
                  { "data": "date"  },
                  { "data": "titre"  },
                  { "data": "user"  },
                  { "data": "id"  , render: function(data, type, row) {
                      return '<button class="btn btn-warning" style="padding: 3px 5px;" type="button"  onclick="click_show(event,' + data + ' )"  >'+button_show+'</button>' } 
                  }
  
                   
                  ]
  
      
  
  
          })
     
      })
  
  






      $(".btn_search").click(function() {


      });



      $(".set").click(function() {

     
        

      });






});