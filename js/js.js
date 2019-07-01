$(document).ready(function(){ 
    $("#boursier").click(function(){
      $("#type_bourse").show();
      $("#pas_de_bourse").hide();
      $("#type_boursier").show();
  
    }); 
    $("#non_boursier").click(function(){
        $("#type_bourse").hide();
        $("#type_boursier").hide();
        $("#logement").hide();
      $("#pas_de_bourse").show();

  });   
    $("#logé").click(function(){
        $("#logement").show();
        $("#pas_de_bourse").hide();
  });
    $("#non_logé").click(function(){
        $("#logement").hide();
        $("#pas_de_bourse").hide();

    }); 
    
    $("#nav > li").mouseover(function(e) {
      $(this).children("div").show();
    });
    $("#nav > li").mouseout(function(e) {
      $(this).children("div").hide();
    });

    $(function() {
      $('#table').pagination({
          items: 3,
          itemsOnPage: 7,
          cssStyle: 'light-theme'
      });
  });

  $(document).ready(function() {
    $('#example').DataTable();
} );
$('#example').DataTable({
  language: {
      processing: "Traitement en cours...",
      search: "Rechercher&nbsp;:",
      lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ments",
      info: "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
      infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
      infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
      infoPostFix: "",
      loadingRecords: "Chargement en cours...",
      zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
      emptyTable: "Aucune donnée disponible dans le tableau",
      paginate: { first: "Premier", previous: "Pr&eacute;c&eacute;dent", next: "Suivant", last: "Dernier" },
      aria: { sortAscending: ": activer pour trier la colonne par ordre croissant", sortDescending: ": activer pour trier la colonne par ordre décroissant" }
  }
});

});
