


$(document).ready(function() {

  
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
      



});





