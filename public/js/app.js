$(document).ready(function () {
    <!--Cuando alguien haga click e votar y acepta como parametro un evento -->
    $('.btn-vote').click(function (e){
        <!-- con esto prevenismo el comportamiento del botn -->
        e.preventDefault();

        var button=$(this);
        <!-- con esto obtengo lA clase mas cercana al boton -->
        var ticket=button.closest('.ticket');
        var id=ticket.data('id');

    })
    
});